<?php
namespace Backend\Controller;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;

 class UsermanageController extends AbstractActionController
 {
     public function __construct() {
        $userSessionAdmin 	= 	new Container('username');
		$sessionidAdmin 	= 	$userSessionAdmin->offsetGet('adminID');
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol.$_SERVER['HTTP_HOST'];
        if($sessionidAdmin == "")
		{
		header("Location:".$dynamicPath."/adminlogin/login");
			exit;
		}
     }
     public function userdetailsAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              //$data = array();
              $userdata = $modelPlugin->getuserTable()->fetchallnew(); //fetchall();
		      return new ViewModel(array('userdata'=>$userdata));

     }
     public function usereditAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $userid = $this->getEvent()->getRouteMatch()->getParam('id');
              $userdata = $modelPlugin->getuserTable()->fetchall(array('userid'=>$userid));
		      return new ViewModel(array('userdata'=>$userdata));

     }
     public function usereditsubmitAction(){
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
              $dynamicPath = $plugin->dynamicPath();
              $userid = $_POST['userid'];
              $userfName = $_POST['userfName'];
              $userlName = $_POST['userlName'];
              $userEmail = $_POST['userEmail'];
              $activation = $_POST['activation'];
              $fileupload = $_POST['fileupload'];
              $where = array('userid'=>$userid);
              $data = array('emailid'=>$userEmail,'firstname'=>$userfName,'lastname'=>$userlName,'profileimage'=>$fileupload,'activation'=>$activation);
              $updatedata = $modelPlugin->getuserTable()->updateuser($data,$where);
              return $this->redirect()->toRoute('usermanage', array(
				'controller' => 'usermanage',
				'action' => 'userdetails'));

     }
     public function adduserAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
              $currentPageURL = $plugin->curPageURL();
              $href = explode("/", $currentPageURL);
              $controller = @$href[3];
              $action = @$href[4];
              $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              return new ViewModel();

     }
     public function saveuserAction(){
              $plugin = $this->routeplugin();
              $modelPlugin = $this->modelplugin();
              $mailplugin = $this->mailplugin();
              $jsonArray = $plugin->jsondynamic();
              $phpprenevt = $this->phpinjectionpreventplugin();
              $email =  $phpprenevt->stringReplace(trim($_POST['email']));
              $password = $phpprenevt->stringReplace(trim($_POST['password']));
              $password = password_hash($password,PASSWORD_BCRYPT);
              $usermailArray = array('email' => $email);
              $chekmail = $modelPlugin->getpublisherTable()->selectEmail($usermailArray);
              if (count($chekmail) == 0){
                   $startDate = date('Y-m-d');
                   $date = strtotime($startDate);
                   $endDate = date("Y-m-d", strtotime("+14 days", $date));
                   $datapub=array('email'=>$email, 'password'=>$password, 'fname'=>'Emmortaluser', 'sfpuser'=>"1",'regTime'=>date('Y-m-d h:i:s'), 'Walkthrough'=>"0", 'mailSendFlag'=>"1");
                   $lastinsertid = $modelPlugin->getpublisherTable()->saveAll($datapub);
                   $datasub=array('PID'=>$lastinsertid,'licensePlan'=>'Free Trial','subscriptionType'=>'Monthly','status'=>"Activated", 'Subscriptiondate'=>$startDate,'Subscriptiontime'=>date('h:i:s'),'expireDate'=>$endDate);
                   $insertsub = $modelPlugin->getsubscriptionDetailsTable()->saveAll($datasub);
                  $coockievalue = password_hash($lastinsertid, PASSWORD_BCRYPT);
                  $cookieArray = array('cookievalue' => $coockievalue,"chkcookie"=> strrev($coockievalue));
                  $updateId = array('publisherId' => $lastinsertid);
                  $contentone = $modelPlugin->getpublisherTable()->updateuser($cookieArray, $updateId);
                   $dynamicPath = "http://" . $jsonArray['domain']['domain_name'];
                   $from = $jsonArray['sendgridaccount']['addfrom'];
                   $checknewmail = $modelPlugin->getpublisherTable()->selectEmail($usermailArray);
                   if (count($checknewmail) == 1){
                      $encryptedPassword = base64_encode("#$#" . base64_encode(base64_encode($lastinsertid . rand(10, 100)) . "###" . base64_encode($lastinsertid) . "###" . base64_encode($userid . rand(10, 100)) . "###" . base64_encode(base64_encode($lastinsertid . rand(10, 100)))) . "#$#");
                      $buttonclick = $dynamicPath . "/Gallery/galleryview/" . $encryptedPassword;
                      $activationLink = "<a href='".$buttonclick."' style='margin: 0; outline: none; padding: 15px; color: #ffffff; background-color: #04ad6a; border: 0px solid #919191; border-radius: 6px; font-family: Arial; font-size: 16px; display: inline-block; line-height: 1.1; text-align: center; text-decoration: none;'>Click here to activate</a>";
                      $keyArray = array('mailCatagory' => 'R_MAIL');
                      $getMailStructure = $modelPlugin->getconfirmMailTable()->fetchall($keyArray);
                      $getmailbodyFromTable = $getMailStructure[0]['mailTemplate'];
                      $activationLinkreplace = str_replace("|ACTIVATIONLINK|", $activationLink, $getmailbodyFromTable);
                      $mailBody = str_replace("|DYNAMICPATH|", $dynamicPath, $activationLinkreplace);
                      $subject = "Confirm your email address";
                      $mailfunction = $mailplugin->confirmationmail($email, $from, $subject, $mailBody);
                    }
              }
              else{
                      echo "error";
              }
              exit;
     public function userbackupAction(){
              $modelPlugin = $this->modelplugin();
              $userid = $_POST['hidden_id'];
              $where = array('userid'=>$userid);

              $fetchdata = $modelPlugin->getuserTable()->fetchall($where);
              if(empty($fetchdata[0]['content'])){
                 $fetchdata[0]['content'] = "0";
              }
              if(empty($fetchdata[0]['keepmelogin'])){
                 $fetchdata[0]['keepmelogin'] = "0";
              }
              if(empty($fetchdata[0]['activation'])){
                 $fetchdata[0]['activation'] = "0";
              }
              $data = array('userid'=>$fetchdata[0]['userid'],'emailid'=>$fetchdata[0]['emailid'],'password'=>$fetchdata[0]['password'],'forgetpassword'=>$fetchdata[0]['forgetpassword'],'firstname'=>$fetchdata[0]['firstname'],'lastname'=>$fetchdata[0]['lastname'],'dateofbirth'=>$fetchdata[0]['dateofbirth'],'profileimage'=>$fetchdata[0]['profileimage'],'backgroundimage'=>$fetchdata[0]['backgroundimage'],'signindate'=>$fetchdata[0]['signindate'],'login'=>$fetchdata[0]['login'],'lastlogout'=>$fetchdata[0]['lastlogout'],'keepmelogin'=>$fetchdata[0]['keepmelogin'],'seeme'=>$fetchdata[0]['seeme'],'findme'=>$fetchdata[0]['findme'],'content'=>$fetchdata[0]['content'],'activation'=>$fetchdata[0]['activation'],'flag'=>'deleted by Admin');
              $savedetails = $modelPlugin->getuserbackupTable()->insertdata($data);

              $deleteuser = $modelPlugin->getuserTable()->deleteuser($where);
              return $this->redirect()->toRoute('usermanage', array(
				      'controller' => 'usermanage',
				      'action'     => 'userdetails'));

     }
     public function userbackupdetAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
              $currentPageURL = $plugin->curPageURL();
              $href = explode("/", $currentPageURL);
              $controller = @$href[3];
              $action = @$href[4];
              $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $backupdata = $modelPlugin->getuserbackupTable()->fetchallnew();
              return new ViewModel(array('backupdata'=>$backupdata));

     }
     public function restoreuserAction(){
              $plugin = $this->routeplugin();
              $modelPlugin = $this->modelplugin();
              $id = $this->getEvent()->getRouteMatch()->getParam('id');

              $data=array('deleteId'=>$id);
              $fetchuserdata = $modelPlugin->getuserbackupTable()->fetchall($data);
              $userid = $fetchuserdata[0]['userid'];

              $datainsert=array('emailid'=>$fetchuserdata[0]['emailid'],'password'=>$fetchuserdata[0]['password'],'forgetpassword'=>$fetchuserdata[0]['forgetpassword'],'firstname'=>$fetchuserdata[0]['firstname'],'lastname'=>$fetchuserdata[0]['lastname'],'dateofbirth'=>$fetchuserdata[0]['dateofbirth'],'profileimage'=>$fetchuserdata[0]['profileimage'],'signindate'=>date('Y-m-d h:i:s'));

              $insertuser = $modelPlugin->getuserTable()->saverestore($datainsert);
              $delbackup = $modelPlugin->getuserbackupTable()->deleteuser($data);

              return $this->redirect()->toRoute('usermanage', array(
				      'controller' => 'usermanage',
				      'action'     => 'userdetails'));

     }
     public function emailcheckAction(){
              $plugin = $this->routeplugin();
              $modelPlugin = $this->modelplugin();
              $id = $_POST['deleteId'];
              $data=array('deleteId'=>$id);
              //check if email already exists(start)
              $fetchuserdata = $modelPlugin->getuserbackupTable()->fetchall($data);
              $email = array('emailid'=>$fetchuserdata[0]['emailid']);
              $chkemail = $modelPlugin->getuserTable()->fetchall($email);
              if(empty($chkemail)){
              //check if email already exists(end)
                  echo "success";
              }
              else{
                  echo "error";
              }
              exit;
     }


 }
?>

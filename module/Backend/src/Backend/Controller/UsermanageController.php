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
//              $phpprenevt = $this->phpinjectionpreventplugin();
//              $userid = $phpprenevt->stringReplace($_POST['userid']);
//              $userEmail = $phpprenevt->stringReplace($_POST['userEmail']);
//              $userStatus = $phpprenevt->stringReplace($_POST['userStatus']);
//              $checkbox = $phpprenevt->stringReplace($_POST['checkbox']);
              $userid = $_POST['userid'];
              $userfName = $_POST['userfName'];
              $userlName = $_POST['userlName'];
              $userEmail = $_POST['userEmail'];
              $activation = $_POST['activation'];
              $fileupload = $_POST['fileupload'];
              $where = array('userid'=>$userid);
              $fname = array('firstname'=>$userfName);
              $lname = array('lastname'=>$userlName);
              $fetchUserData = $modelPlugin->getuserTable()->fetchall($fname);
              $chekid = $fetchUserData[0]['userid'];
                  if ($chekid == $id || empty($chekname)){

              
              //print_r($fetchUserData); exit;
              if(empty($fetchuserdet)){
             // $fetchquery= $modelPlugin->getsubscriptionDetailsTable()->fetchall($query);
                  $data = array('emailid'=>$userEmail,'firstname'=>$userfName,'lastname'=>$userlName,'profileimage'=>$fileupload,'activation'=>$activation);
                  $updatedata = $modelPlugin->getuserTable()->updateuser($data,$where);
                  echo "ok";
              }else{
                  echo "error";
              }
         exit;

     }

 }
?>

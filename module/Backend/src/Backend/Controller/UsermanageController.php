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

     public function userbackupAction(){
              $modelPlugin = $this->modelplugin();
              $userid = $_POST['hidden_id'];
              $where = array('userid'=>$userid);

              $fetchdata = $modelPlugin->getuserTable()->fetchall($where);
              print_r($fetchdata); exit;
              if(empty($fetchdata[0]['content'])){
                 $fetchdata[0]['content'] = "0";
              }else if(empty($fetchdata[0]['keepmelogin'])){
                 $fetchdata[0]['keepmelogin'] = "0";
              }else if(empty($fetchdata[0]['activation'])){
                 $fetchdata[0]['activation'] = "0";
              }
              $data = array('userid'=>$fetchpubdetails[0]['userid'],'emailid'=>$fetchpubdetails[0]['emailid'],'password'=>$fetchpubdetails[0]['password'],'forgetpassword'=>$fetchpubdetails[0]['forgetpassword'],'firstname'=>$fetchpubdetails[0]['firstname'],'lastname'=>$fetchpubdetails[0]['lastname'],'dateofbirth'=>$fetchpubdetails[0]['dateofbirth'],'profileimage'=>$fetchpubdetails[0]['profileimage'],'backgroundimage'=>$fetchpubdetails[0]['backgroundimage'],'signindate'=>$fetchpubdetails[0]['signindate'],'login'=>$fetchpubdetails[0]['login'],'lastlogout'=>$fetchpubdetails[0]['lastlogout'],'keepmelogin'=>$fetchpubdetails[0]['keepmelogin'],'seeme'=>$fetchpubdetails[0]['seeme'],'findme'=>$fetchpubdetails[0]['findme'],'content'=>$fetchpubdetails[0]['content'],'activation'=>$fetchpubdetails[0]['activation'],'flag'=>'deleted by Admin');
              $savedeldetails = $modelPlugin->getpublisherbackupTable()->insertdeluser($publisherdet);

              $deleteuser = $modelPlugin->getpublisherTable()->deletePublisher(array('publisherId'=>$userid));
              return $this->redirect()->toRoute('userregistration', array(
				      'controller' => 'userregistration',
				      'action'     => 'userdetails'));
     }


 }
?>

<?php
namespace Backend\Controller;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;

 class UploadsController extends AbstractActionController
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

     public function viewAction(){
         $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $uploaddata = $modelPlugin->getuploadDetailsTable()->fetchall();
		      return new ViewModel(array('uploaddata'=>$uploaddata));
     }
     public function deluploadAction(){
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $uploadId = $_POST['hidden_upid'];
              $where = array('uploadId'=>$uploadId);
              $fetch = $modelPlugin->getuploadDetailsTable()->fetchall($where);

              $data = array('uploadid'=>$fetch[0]['uploadId'],'userid'=>$fetch[0]['UID'],'uploadTitle'=>$fetch[0]['uploadTitle'],'uploadDescription'=>$fetch[0]['uploadDescription'],'uploadPath'=>$fetch[0]['uploadPath'],'uploadType'=>$fetch[0]['uploadType'],'filestatus'=>$fetch[0]['filestatus'],'AID'=>$fetch[0]['AID'],'FID'=>$fetch[0]['FID'],'PID'=>$fetch[0]['PID']);
              $savedetails = $modelPlugin->getuploadBackupTable()->insertdata($data);
              $delupload = $modelPlugin->getuploadDetailsTable()->deleteData($where);

		      return $this->redirect()->toRoute('uploads', array(
				'controller' => 'uploads',
				'action' => 'view'));
     }

 }


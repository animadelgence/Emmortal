<?php
namespace Backend\Controller;
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Zend\Session\Container;

 class SeomanageController extends AbstractActionController
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

     public function seoviewAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $seodata = $modelPlugin->getseoTable()->fetchall();
		      return new ViewModel(array('seodata'=>$seodata));
     }
     public function editseoAction(){
              $this->layout('layout/backendlayout');
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
		      $href = explode("/", $currentPageURL);
		      $controller = @$href[3];
              $action = @$href[4];
		      $this->layout()->setVariables(array('controller'=>$controller,'action'=>$action));
              $id = $this->getEvent()->getRouteMatch()->getParam('id');
              $seodata = $modelPlugin->getseoTable()->fetchall(array('seoid'=>$id));
		      return new ViewModel(array('seodata'=>$seodata));
     }
     public function editseosubmitAction(){
              $modelPlugin = $this->modelplugin();
              $plugin = $this->routeplugin();
		      $currentPageURL = $plugin->curPageURL();
              $seoId = $_POST['seoId'];
              $seoTitle = $_POST['seoTitle'];
              $metaDesc = $_POST['metaDesc'];
              $imgPath = $_POST['imgPath'];
              $favicon = $_POST['favicon'];
              $where = array('seoid'=>$seoId);
              $data = array('seopagetitle'=>$seoTitle,'seometadescription'=>$metaDesc,'seoOGimagepath'=>$imgPath,'seoFaviconimagepath'=>$favicon);
              $seodata = $modelPlugin->getseoTable()->updateData($data,$where);
		      return $this->redirect()->toRoute('seomanage', array(
				      'controller' => 'seomanage',
				      'action'     => 'seoview'));

     }
     public function bgeditAction(){
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

 }


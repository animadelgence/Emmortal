<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class AlbumController extends AbstractActionController {

    //protected $albumdetailsTable;
    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        /*$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath. "/album/showalbum");
            exit;
        }*/
    }
    public function indexAction() {
       // echo "welcome from album module";exit;
    	$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $dashboardFolder = $modelPlugin->getalbumdetailsTable()->fetchall();
        $this->layout()->setVariables(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
        return new ViewModel();
        //print_r($dashboardFolder);exit;
    }
    public function showalbumAction(){
    	$this->layout('layout/albumlayout.phtml');
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action));
        //exit;
        if($this->sessionid == "")
        {
            return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
        }
        else{
            return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
        }
    }
    /*public function allalbumAction(){
    	$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
    	$dynamicPath = $plugin->dynamicPath();
    	$jsonArray = $plugin->jsondynamic(); 
    	//echo $dynamicPath;
    	//print_r($jsonArray);exit;
    	//$this->layout()->setVariables(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
    	//echo "hi";exit;
    	return new ViewModel();
    	//exit;
    }*/
    public function termsandconditionsAction(){
    	$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action));
        return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
    }
    public function aboutusAction(){
    	$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action));
        return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
    }
    public function decrypt($data, $key) {
        $decode = base64_decode($data);
        return mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128, $key, $decode, MCRYPT_MODE_CBC, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
        );
    }
    
}
?>
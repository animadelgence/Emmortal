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
        $controller = 'album';
		$action = $this->params('action');
        $uploadQuery = array();
        $uploadDetails = $modelPlugin->getuploadDetailsTable()->fetchall($uploadQuery);
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();

        if($this->sessionid == "")
        {

            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'bgimg'=>$bgimg[0]['bgimgpath'],'sessn'=>0));
            return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails' =>$uploadDetails));

        }
        else{
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));

            if(!empty($userDetails[0]['backgroundimage'])){

                $this->layout()->setVariables(array('sessionid'=> $this->sessionid,'controller' => $controller,'dynamicPath' => $dynamicPath, 'userDetails'=>$userDetails, 'action' => $action,'jsonArray'=>$jsonArray,'userDetails'=>$userDetails,'sessn'=>1));
            }
            else{

                $this->layout()->setVariables(array('sessionid'=> $this->sessionid,'controller' => $controller,'dynamicPath' => $dynamicPath, 'userDetails'=>$userDetails, 'action' => $action,'jsonArray'=>$jsonArray,'userDetails'=>$userDetails,'bgimg'=>$bgimg[0]['bgimgpath'],'sessn'=>1));
            }

           return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails' =>$uploadDetails));
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
        if($this->sessionid != ""){
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        } else {
            $userDetails = "";
        }
        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'userDetails'=>$userDetails));
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
        if($this->sessionid != ""){
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        } else {
            $userDetails = "";
        }
        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'userDetails'=>$userDetails));
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

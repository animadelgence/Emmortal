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
        $this->layout()->setVariables(array('controller' => $controller, 'action' => $action));
        return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
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

    
}

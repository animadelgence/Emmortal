<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class ProfileController extends AbstractActionController {

    
    public function indexAction() {
        echo "work in progress";exit;

       }
    public function showprofileAction(){
    	$this->layout('layout/profilelayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $query = array('UID'=>1);
        $albumDetails = $modelPlugin->getalbumdetailsTable()->fetchall($query);
        $this->layout()->setVariables(array('controller' => $controller, 'action' => $action));
        return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'albumDetails'=>$albumDetails));
    }
    public function newsfeedAction(){
    	$this->layout('layout/profilelayout.phtml');
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
    public function getalbumAction(){
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $query = array('UID'=>1);
        $albumDetails = $modelPlugin->getalbumdetailsTable()->fetchall($query);
        echo '<option value="">My chronicles</option>';
        if(!empty($albumDetails)){
            foreach($albumDetails as $aResult){
            $albumeid = $aResult['albumeid'];
            $title = $aResult['title'];
            echo '<option value="'.$albumeid.'">'.$title.'</option>';
            }
        }
        exit;
     }
    public function getfriendsAction(){
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $query = 1;
        $friendDetails = $modelPlugin->getfriendsTable()->joinquery($query);
        $array = array();
        foreach ($friendDetails as $rSet) {
            $array[] = array(
                'friendsid' => $rSet['friendsid'],
                'friendsname' => $rSet['firstname']." ".$rSet['lastname']
            );
          }
        $res['friendDetails'] = $array;
        echo json_encode($res);
        exit;
     }
     public function publishtextAction(){
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $title = $_POST['textTitle'];
        $description = $_POST['textDescription'];
        $AID = $_POST['AID'];
        $frndId = $_POST['frndId'];
        $ct = count($frndId);
        $friendsid= '';
        for($i=0;$i<$ct;$i++){
          $friendsid = $friendsid.$frndId[$i].',';
        }
        $UID = 1;
        $addeddate = date('Y-m-d H:i:s');
        $data =  array('UID'=>$UID,
                      'uploadTitle'=>$title,
                      'uploadDescription'=>$description,
                      'AID'=>$AID,
                      'FID'=>$friendsid,
                      'TimeStamp'=>$addeddate
                      );
        $albumDetails = $modelPlugin->getuploadDetailsTable()->insertData($data);
        return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
    }

}

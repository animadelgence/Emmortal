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
        $actionChecker = $this->getEvent()->getRouteMatch()->getParam('id');
        $useridentifier = $this->getEvent()->getRouteMatch()->getParam('pId');
        //echo $actionChecker;exit;
        $key = '1234547890183420';
        if($actionChecker != "resetpassword")
        {
            //echo "inside if";
            $decrypteduserId = $this->decrypt($actionChecker, $key);
            $searchkayarray = array('userid'=>$decrypteduserId);
            $updateArray = array(
                'activation' => '1'
            );
            $updatedValues = $modelPlugin->getuserTable()->updateuser($updateArray, $searchkayarray);
            $user_session = new Container('userloginId');
            $user_session->userloginId = $decrypteduserId;
            

        }else{

            echo $actionChecker;

        }
        return new ViewModel(array('session_id'=>$decrypteduserId,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'albumDetails'=>$albumDetails));
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
        $query = array('userid'=>1);
        //$like = $_POST['like'];
        $like = 'user';
        $friendDetails = $modelPlugin->getfriendsTable()->fetchall($query);
        $array = array();
        foreach ($friendDetails as $rSet) {
            $array[] = array(
                'friendsid' => $rSet['friendsid']
            );
          }
          $res['friendDetails'] = $array;
          echo json_encode($res);
          exit;
        /*if(!empty($albumDetails)){
            foreach($albumDetails as $result){
                echo '<li class="frndlist-click" style="background: #aaa897;margin-bottom: 2px;" data-id="'.$result['friendsid'].'">'.$result['friendsid'].'</li>';
            }
        } else{
            echo "";
        }
        //$albumDetails = $modelPlugin->getfriendsTable()->joinquery($query,$like);
        exit;*/
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
        $data =  array('title'=>$title,
                      'description'=>$description,
                      'UID'=>$UID,
                      'AID'=>$AID,
                      'friendsid'=>$friendsid,
                      'addeddate'=>$addeddate
                      );
        $albumDetails = $modelPlugin->gettextdetailsTable()->insertText($data);
        return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
    }
    public function decrypt($data, $key) {
        $decode = base64_decode($data);
        return mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128, $key, $decode, MCRYPT_MODE_CBC, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
        );
    }

}

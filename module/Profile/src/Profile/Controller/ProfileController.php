<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class ProfileController extends AbstractActionController {

    
    public function __construct() {
        $userSession     = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        $userSessionTemp     = new Container('tempStoreName');
        $this->sessionidtemp = $userSessionTemp->offsetGet('tempStoreName');
        $protocol        = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath     = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath);
            exit;
        }
    }
    public function indexAction() {
        echo "work in progress";exit;
    }
    public function showprofileAction(){
       
    	$this->layout('layout/profilelayout.phtml');

    	$modelPlugin    = $this->modelplugin();
        $dynamicPath    = $modelPlugin->dynamicPath();
        $jsonArray      = $modelPlugin->jsondynamic();
        $currentPageURL = $modelPlugin->curPageURL();

        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $pageQuery = array('UID'=>$this->sessionid);
        $pageDetails = $modelPlugin->getpagedetailsTable()->fetchall($pageQuery);
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $uploadQuery = array('UID'=>$this->sessionid,'PID'=>$pageDetails[0]['pageid']);
        $uploadDetails = $modelPlugin->getuploadDetailsTable()->fetchall($uploadQuery);
         
        foreach ($uploadDetails as $upload) {
            $likeDetailsArrays = array();
            $uploadId = $upload['uploadId'];
            $uploadIdquery = array('uploadId' =>$uploadId);
            $likeDetails = $modelPlugin->getlikesdetailsTable()->countLike($uploadIdquery);
            
            $likeDetailsArray[$uploadId] = $likeDetails;
             array_push($likeDetailsArrays,$likeDetailsArray);


           
        }
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();
        if(@getimagesize($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
             $bgimgSend = $bgimg[0]['bgimgpath'];
            }
        $this->layout()->setVariables(array('controller' => $controller, 'action' => $action, 'dynamicPath' => $dynamicPath,'sessionid'=>$this->sessionid, 'userDetails'=>$userDetails,'bgimg'=>$bgimgSend));
        if(empty($likeDetailsArrays)){
             return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails'=>$uploadDetails , 'pageDetails'=>$pageDetails , 'userDetails'=>$userDetails));

        } else{
        return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails'=>$uploadDetails , 'pageDetails'=>$pageDetails , 'userDetails'=>$userDetails,'likeDetailsArrays' =>$likeDetailsArrays));
    }
    }
    public function newsfeedAction(){
       //echo $this->sessionidtemp;exit;
    	$this->layout('layout/profilelayout.phtml');

    	$modelPlugin      = $this->modelplugin();
        $dynamicPath      = $modelPlugin->dynamicPath();
        $jsonArray        = $modelPlugin->jsondynamic();
        $currentPageURL   = $modelPlugin->curPageURL();
        $href             = explode("/", $currentPageURL);
        $controller       = @$href[3];
        $action           = @$href[4];
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();
       if(@getimagesize($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
             $bgimgSend = $bgimg[0]['bgimgpath'];
            }
        $tempstore = 'blank';
        if($this->sessionidtemp) {
            $tempstore = $this->sessionidtemp;
            $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath, 'sessionid'=>$this->sessionid,'tempsessionid'=>$tempstore,'userDetails' => $userDetails,'bgimg'=>$bgimgSend));
            /*$user_session_temp->loginId = ($_SESSION['tempStore']);
            $user_session_temp = new \Zend\Session\Container('tempStore');
            unset($user_session_temp->tempStore);*/
        }
        else {
            $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath, 'sessionid'=>$this->sessionid,'tempsessionid'=>$tempstore,'userDetails' => $userDetails,'bgimg'=>$bgimgSend));
        }
        if($this->sessionidtemp){
            $user_session_temp->tempStore = ($_SESSION['tempStoreName']);
            $user_session_temp = new \Zend\Session\Container('tempStoreName');
            unset($user_session_temp->tempStoreName);
            
            /*$user_session->loginId  = ($_SESSION['userloginId']);
        $user_session           = new \Zend\Session\Container('userloginId');
        unset($user_session->userloginId);*/
        }
       
        return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
    }
    public function getalbumAction(){
        
    	$plugin         = $this->routeplugin();
        $modelPlugin    = $this->modelplugin();
        $dynamicPath    = $plugin->dynamicPath();
        $jsonArray      = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href           = explode("/", $currentPageURL);
        $controller     = @$href[3];
        $action         = @$href[4];

        $query          = array('UID'=>$this->sessionid);
        $albumDetails   = $modelPlugin->getalbumdetailsTable()->fetchall($query);

        echo '<option value="">My chronicles</option>';

        if(!empty($albumDetails)){
            foreach($albumDetails as $aResult){
            $albumeid   = $aResult['albumeid'];
            $title      = $aResult['title'];
            echo '<option value="'.$albumeid.'">'.$title.'</option>';
            }
        }
        exit;
     }
    public function getfriendsAction(){

    	$plugin          = $this->routeplugin();
        $modelPlugin     = $this->modelplugin();
        $dynamicPath     = $plugin->dynamicPath();
        $jsonArray       = $plugin->jsondynamic();
        $currentPageURL  = $plugin->curPageURL();
        $href            = explode("/", $currentPageURL);
        $controller      = @$href[3];
        $action          = @$href[4];
        $userid          = $this->sessionid;
        $sendfrndCon     = array('friends.userid'=>$userid,'friends.requestaccept'=>1);
        $sendfrndJoin    = "friends.friendsid = user.userid";
        $sendfrndDetails = $modelPlugin->getfriendsTable()->joinquery($sendfrndCon,$sendfrndJoin);
        $recfrndCon      = array('friends.friendsid'=>$userid,'friends.requestaccept'=>1);
        $recfrndJoin     = "friends.userid = user.userid";
        $recfrndDetails  = $modelPlugin->getfriendsTable()->joinquery($recfrndCon,$recfrndJoin);
        $array           = array();
        foreach ($sendfrndDetails as $rSet) {
            $array[] = array(
                'friendsid'     => $rSet['friendsid'],
                'friendsname'   => $rSet['firstname']." ".$rSet['lastname'],
                'profileimage'  => $rSet['profileimage']
            );
        }
        foreach ($recfrndDetails as $rset) {
            $array[] = array(
                'friendsid'     => $rset['userid'],
                'friendsname'   => $rset['firstname']." ".$rset['lastname'],
                'profileimage'  => $rset['profileimage']
            );
        }
        $res['friendDetails'] = $array;
        echo json_encode($res);
        exit;
     }
     public function publishtextAction(){

    	$plugin             = $this->routeplugin();
        $modelPlugin        = $this->modelplugin();
        $dynamicPath        = $plugin->dynamicPath();
        $jsonArray          = $plugin->jsondynamic();
        $currentPageURL     = $plugin->curPageURL();
        $href               = explode("/", $currentPageURL);
        $controller         = @$href[3];
        $action             = @$href[4];
        $title              = $_POST['textTitle'];
        $description        = $_POST['textDescription'];
        $AID                = @$_POST['AID'];
        $friendsid          = '';

        $frndIdValue               = $_POST['friendsId'];
        if($frndIdValue){
        $friendId             =  implode(",",$frndIdValue);
        } else{
          $friendId = "";
        }

        $UID                = $this->sessionid;
        $currentPageIdValue = $_POST['currentPage'];

        if(!$currentPageIdValue) {
            $where          = array('UID'=>$UID);
            $pageDetails    = $modelPlugin->getpagedetailsTable()->fetchall($where);
            $currentPageId  = $pageDetails[0]['pageid'];
        } else {
            $currentPageId  = $currentPageIdValue;
        }

        $addeddate          = date('Y-m-d H:i:s');
        $data               =  array('UID'=>$UID,
                                      'uploadTitle'=>$title,
                                      'uploadDescription'=>$description,
                                      'AID'=>$AID,
                                      'PID'=>$currentPageId,
                                      'FID'=>$friendId,
                                      'uploadType'=>'text',
                                      'TimeStamp'=>$addeddate
                              );
        $albumDetails       = $modelPlugin->getuploadDetailsTable()->insertData($data);
         
        $notificationData   = array(
                                    'UID'=>$uid,
                                    'notified_by'=>$UID,
                                    'notify_id'=>$likeInsert,
                                    'notify_type'=>'like',
                                    'notify_seen'=>0,
                                    'notificationdate'=>date("Y-m-d H:i:s")
                                );
        $notificationInsert = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData);
         
         echo $albumDetails;exit;
        //return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
    }
    public function savefilestatusAction(){
        $plugin             = $this->routeplugin();
        $modelPlugin        = $this->modelplugin();
        $dynamicPath        = $plugin->dynamicPath();
        $sizeX = $_POST['sizeX'];
        $sizeY = $_POST['sizeY'];
        $uploadId = $_POST['uploadId'];

        $data = array('sizeX'=>$sizeX ,'sizeY'=>$sizeY
                              );
        $where = array('uploadId'=>$uploadId
                              );


        $savefilestatus       = $modelPlugin->getuploadDetailsTable()->updateData($data,$where);
        echo $savefilestatus;exit;



    }

    public function logoutuserAction() {

        $user_session->loginId  = ($_SESSION['userloginId']);
        $user_session           = new \Zend\Session\Container('userloginId');
        unset($user_session->userloginId);
        
        $plugin                 = $this->routeplugin();
        $dynamicPath            = $plugin->dynamicPath();
        return $this->redirect()->toUrl($dynamicPath);
       
    }

    public function decrypt($data, $key) {
        $decode = base64_decode($data);
        return mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128, $key, $decode, MCRYPT_MODE_CBC, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
        );
    }

}

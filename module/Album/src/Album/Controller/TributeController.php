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

class TributeController extends AbstractActionController {
   public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     header("Location:" . $dynamicPath. "/profile/showprofile");
        //     exit;
        // }
    }
    public function tributesubmitAction(){
        $plugin                     = $this->routeplugin();
        $modelPlugin                = $this->modelplugin();
        $dynamicPath                = $plugin->dynamicPath();
        $currentPageURL             = $plugin->curPageURL();
        $href                       = explode("/", $currentPageURL);
        $controller                 = @$href[3];
        $action                     = @$href[4];
        $tributeDescription         = $_POST['tributeDescription'];
        $frndIdValue                = $_POST['frndId'];
        if($frndIdValue){
            $friendId               =  implode(",",$frndIdValue);
        } else{
            $friendId               = "";
        }
        $UID                        = $this->sessionid;
        $this->layout()->setVariables(array(
                                        'sessionid'=> $UID,
                                        'controller' => $controller,
                                        'action' => $action));
        $addeddate                  = date('Y-m-d H:i:s');
        $data                       =  array('UID'=>$UID,
                      'description'=>$tributeDescription,
                      'friendsid'=>$friendId,
                      'addeddate'=>$addeddate

                      );
        $tributeDetails             = $modelPlugin->gettributedetailsTable()->insertData($data);
        if($friendId != ''){
            $frndId                 = explode(",",$friendId);
            $ct                     = count($frndId);
            for($i=0;$i<$ct;$i++){
                $notificationData   = array(
                                            'UID'=>$frndId[$i],
                                            'notified_by'=>$UID,
                                            'notify_id'=>$tributeDetails,
                                            'notify_type'=>'tribute',
                                            'notify_seen'=>0,
                                            'notificationdate'=>date("Y-m-d H:i:s")
                                        );
                $notificationInsert = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData);
            }
        }
        $userDetails                = $modelPlugin->getuserTable()->fetchall(array('userid'=>$UID));
        $recfrndCon                 = array(
                                        'friends.friendsid'=>$friendId,
                                        'friends.requestaccept'=>1,
                                        'friends.userid'=>$UID
                                    );
        $recfrndJoin                = "friends.friendsid = user.userid";
        $recfrndDetailscheck        = $modelPlugin->getfriendsTable()->joinquery($recfrndCon,$recfrndJoin);
        if(empty($recfrndDetailscheck)){
            $recfrndCon             = array(
                                        'friends.friendsid'=>$UID,
                                        'friends.requestaccept'=>1,
                                        'friends.userid'=>$friendId
                                    );
            $recfrndJoin            = "friends.userid = user.userid";
            $recfrndDetails         = $modelPlugin->getfriendsTable()->joinquery($recfrndCon,$recfrndJoin);
        } else {
            $recfrndDetails         = $recfrndDetailscheck ;
        }


        if($tributeDetails != 0){
            return new ViewModel(array('sessionid'=>$UID,'dynamicPath' => $dynamicPath,'tributeDescription'=>$tributeDescription,'recfrndDetails'=>$recfrndDetails,'userDetails'=>$userDetails,'friendId'=>$friendId));
        }
    
    }
    public function tributeupdateAction(){
         $plugin                     = $this->routeplugin();
         $modelPlugin                = $this->modelplugin();
         $dynamicPath                = $plugin->dynamicPath();
         $currentPageURL             = $plugin->curPageURL();
         $href                       = explode("/", $currentPageURL);
         $controller                 = @$href[3];
         $action                     = @$href[4];
         $UID                        = $this->sessionid;
         $this->layout()->setVariables(array('sessionid'=> $UID,'controller' => $controller, 'action' => $action));
         $tributeDescription         = $_POST['tributeDescriptionUpdate'];
         $frndIdValue                = $_POST['frndId'];
        if($frndIdValue){
           $friendId                 =  implode(",",$frndIdValue);
            } else{
              $friendId              = "";
            }
         $userDetails                = $modelPlugin->getuserTable()->fetchall(array('userid'=>$UID));

         $data                       =  array('description'=>$tributeDescription);
         $where                      =  array('UID'=>$UID);
         $tributeDetails             = $modelPlugin->gettributedetailsTable()->updateData($data,$where);
         return new ViewModel(array(
                                'sessionid'=>$UID,
                                'dynamicPath' => $dynamicPath,
                                'tributeDescription'=>$tributeDescription,
                                'userDetails'=>$userDetails,
                                'friendId'=>$friendId));
    }

    public function gettributeAction(){
    	$plugin                     = $this->routeplugin();
        $modelPlugin                = $this->modelplugin();
        $dynamicPath                = $plugin->dynamicPath();
        $jsonArray                  = $plugin->jsondynamic();
        $currentPageURL             = $plugin->curPageURL();
        $href                       = explode("/", $currentPageURL);
        $controller                 = @$href[3];
        $action                     = @$href[4];
        $userid                     = $this->sessionid;
        $friendId                   = "";  
        $uploadId                   = "";
        $tribute_type               = "";
        $notify_type                = "comment";
        $tributeType                = @$_POST['tributeType'];
        if($tributeType == 'friend'){
            $friendId               = @$_POST['frndId'];  
            $uploadId               = "";
            $tribute_type           = 'friend';
            $notify_type            ="tribute";
        } else if($tributeType == 'relationship'){
            $friendId               = @$_POST['frndId'];  
            $uploadId               = "";
            $tribute_type           = 'relationship';
        } else if($tributeType == 'upload'){
            $uploadId               = @$_POST['frndId'];
            //$uploadDetails          = $modelPlugin->getuploadDetailsTable()->fetchall(array('uploadId'=>$uploadId));
            $friendId               = "";
            $tribute_type           = 'upload';
        } else if($tributeType == 'album'){
            $uploadId               = @$_POST['frndId'];
            //$albumDetails           = $modelPlugin->getalbumdetailsTable()->fetchall(array('albumeid'=>$uploadId));
            $friendId               = "";
            $tribute_type           = 'album';
        }
        $description = $_POST['description'];
        if(!empty($description)){
            $value                  = array(
                                        'UID'=>$userid,
                                        'description'=>$description,
                                        'friendsid'=>$friendId,
                                        'uploadId'=>$uploadId,
                                        'tribute_type'=>$tribute_type,
                                        'addeddate'=>date("Y-m-d H:i:s")
                                    );
            $tributeId              = $modelPlugin->gettributedetailsTable()->insertData($value);
            if($tributeType == 'upload' || $tributeType == 'album'){
                $fndDetails          = $modelPlugin->getfriendsTable()->fetchall(array('requestaccept'=>1));
                foreach($fndDetails as $fRes ){
                    if($fRes['userid'] == $userid){
                       $notificationData     = array(
                                                    'UID'=>$fRes['friendsid'],
                                                    'notified_by'=>$userid,
                                                    'notify_id'=>$tributeId,
                                                    'notify_type'=>$notify_type,
                                                    'notify_seen'=>0,
                                                    'notificationdate'=>date("Y-m-d H:i:s")
                                                );
                    $notificationInsert     = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData); 
                    } else if($fRes['friendsid'] == $userid){
                    $notificationData       = array(
                                                'UID'=>$fRes['userid'],
                                                'notified_by'=>$userid,
                                                'notify_id'=>$tributeId,
                                                'notify_type'=>$notify_type,
                                                'notify_seen'=>0,
                                                'notificationdate'=>date("Y-m-d H:i:s")
                                            );
                    $notificationInsert     = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData);
                    }
                }
                
            } else{
                $notificationData       = array(
                                            'UID'=>$friendId,
                                            'notified_by'=>$userid,
                                            'notify_id'=>$tributeId,
                                            'notify_type'=>$notify_type,
                                            'notify_seen'=>0,
                                            'notificationdate'=>date("Y-m-d H:i:s")
                                        );
                $notificationInsert     = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData);
            }
        }
        $query                      = array();
        $tributeDetails             = $modelPlugin->gettributedetailsTable()->fetchall($query);
        $array                      = array();
        foreach ($tributeDetails as $rSet) {
            if(($userid == $rSet['UID']) && ($friendId == $rSet['friendsid'])){
                if ($friendId == $rSet['friendsid'] && $tributeType == $rSet['tribute_type'])
                {
                    $where          = array('TID'=>$rSet['tributesid']);
                    $likeDetails    = $modelPlugin->getlikesdetailsTable()->fetchall($where);
                    $join           = 'tributedetails.UID = user.userid';
                    $condition      = array('tributedetails.tributesid'=>$rSet['tributesid']);
                    $tribute        = $modelPlugin->gettributedetailsTable()->joinquery($condition,$join);
                    $like           = count($likeDetails);
                    $array[]        = array(
                                        'tributesid' => $tribute[0]['tributesid'],
                                        'UID' => $tribute[0]['UID'],
                                        'friendsname' => $tribute[0]['firstname']." ".$tribute[0]['lastname'],
                                        'profileimage'=>$tribute[0]['profileimage'],
                                        'description'=>$tribute[0]['description'],
                                        'shortDescription'=>substr($tribute[0]['description'],0,20).'...',
                                        'friendsid'=>$tribute[0]['friendsid'],
                                        'like'=>$like,
                                        'addeddate'=>date("m/d/Y",strtotime($tribute[0]['addeddate']))
                                    );
                }
            } else if($friendId == $rSet['UID'] && $userid == $rSet['friendsid']){
                if ($friendId == $rSet['friendsid'] && $tributeType == $rSet['tribute_type'])
                {
                    $where          = array('TID'=>$rSet['tributesid']);
                    $likeDetails    = $modelPlugin->getlikesdetailsTable()->fetchall($where);
                    $join           = 'tributedetails.UID = user.userid';
                    $condition      = array('tributedetails.tributesid'=>$rSet['tributesid']);
                    $tribute        = $modelPlugin->gettributedetailsTable()->joinquery($condition,$join);
                    $like = count($likeDetails);
                    $array[]        = array(
                                        'tributesid' => $tribute[0]['tributesid'],
                                        'UID' => $tribute[0]['UID'],
                                        'friendsname' => $tribute[0]['firstname']." ".$tribute[0]['lastname'],
                                        'profileimage'=>$tribute[0]['profileimage'],
                                        'description'=>$rSet['description'],
                                        'shortDescription'=>substr($tribute[0]['description'],0,20).'...',
                                        'friendsid'=>$tribute[0]['friendsid'],
                                        'like'=>$like,
                                        'addeddate'=>date("m/d/Y",strtotime($tribute[0]['addeddate']))
                                    );
                }
            }
        }
        $res['tributeDetails']      = $array;
        echo json_encode($res);
        exit;
     }

    
    
}
?>

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

class NotificationController extends AbstractActionController {
    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     //header("Location:" . $dynamicPath. "/album/showalbum");
        //     header("Location:" . $dynamicPath);
        //     exit;
        // }
    }
    public function notificationupdateAction(){
        $plugin                     = $this->routeplugin();
        $modelPlugin                = $this->modelplugin();
        $dynamicPath                = $plugin->dynamicPath();
        $jsonArray                  = $plugin->jsondynamic();
        $notificationid             = @$_POST['notificationid'];
        $notificationupdate         = @$_POST['notificationupdate'];
        $UID                        = $this->sessionid;
        $data                       = array('notify_seen'=>1);
        if($notificationupdate == 'single'){
            $where                  = array('notificationid'=>$notificationid);   
        } else{
            $where                  = array('UID'=>$this->sessionid);
        }
        $notificationDetails        = $modelPlugin->getnotificationdetailsTable()->updateNotification($data,$where);
        $condition                  = array('UID'=>$UID,'notify_seen'=>0);
        $off                        = 0;
        $limit                      = 100;
        $notificationDetails        = $modelPlugin->getnotificationdetailsTable()->fetchall($condition,$off,$limit);
        echo count($notificationDetails); exit;
    }
    public function getnotificationAction(){
        $plugin                     = $this->routeplugin();
        $modelPlugin                = $this->modelplugin();
        $dynamicPath                = $plugin->dynamicPath();
        $jsonArray                  = $plugin->jsondynamic();
        $UID                        = $this->sessionid;
        if($this->sessionid !=''){
        $condition                  = array('UID'=>$UID,'notify_seen'=>0);
        $off                        = 0;
        $limit                      = 100;
        $notificationDetails        = $modelPlugin->getnotificationdetailsTable()->fetchall($condition,$off,$limit);
        $unreadNotification         = count($notificationDetails);
        if(count($notificationDetails)<7){
            $off                    = 0;
            $limit                  = 7;
            $condition              = array('UID'=>$UID);
            $notificationDetails    = $modelPlugin->getnotificationdetailsTable()->fetchall($condition,$off,$limit);
        }
        $userCondition              = array('userid'=>$UID);
        $userDetails                = $modelPlugin->getuserTable()->fetchall($userCondition);
        $array                      = array();
        foreach ($notificationDetails as $rSet) {
            $notificationid         = $rSet['notificationid'];
            $notified_by            = $rSet['notified_by'];
            $notify_id              = $rSet['notify_id'];
            $notify_type            = $rSet['notify_type'];
            $notify_seen            = $rSet['notify_seen'];
            $html                   = "";
            if($notify_type == 'like'){
                $likecon            = array('likeid'=>$notify_id);
                $likeDetails        = $modelPlugin->getlikesdetailsTable()->fetchall($likecon);
                $likedBy            = $likeDetails[0]['UID'];
                $likedByDetails     = $modelPlugin->getuserTable()->fetchall(array('userid'=>$likedBy));
                if($notify_seen == 1){
                    $html .='<div class="e-notification like seen">';
                } else{
                    $html .='<div class="e-notification like not-seen" data-id="'.$notificationid.'">';
                }
                $html .='<div class="avatar-wrapper pull-left">';
                $html .='<img class="img-responsive img-rounded"src="'.@$likedByDetails[0]['profileimage'].'" onerror="this.src=\'/image/profile-deafult-avatar.jpg\'">';
                $html .='</div>';
                $html .='<div class="pull-right e-notification-icon">';
                $html .='<div class="fa e-red fa-heart"></div>';
                $html .='</div>';
                $html .='<div class="e-notification-info">';
                $html .='<div class="user-name">';
                $html .='<a class="e-link" href="/users/62/profile">';
                $html .='<strong>'.@$likedByDetails[0]['firstname'].' '.@$likedByDetails[0]['lastname'].'</strong>';
                $html .='</a>';
                $html .='</div>';
                $html .='<div class="action">';
                $html .='<span>liked your</span>';
                if($likeDetails[0]['FID']){
                    $html .='<a class="e-link e-brown pointer">Relationship</a>';
                } else if($likeDetails[0]['TID']){
                    $html .='<a class="e-link e-brown pointer">Comment</a>';
                } else if($likeDetails[0]['AID']){
                    $html .='<a class="e-link e-brown pointer">Album</a>';
                } else if($likeDetails[0]['uploadId']){
                    $uploadDetails = $modelPlugin->getuploadDetailsTable()->fetchall(array('uploadId'=>$likeDetails[0]['uploadId']));
                    $html .='<a class="e-link e-brown pointer">';
                    if($uploadDetails[0]['uploadType']=='text'){
                        $html .='Text';  
                    } else if($uploadDetails[0]['uploadType']=='image'){
                        $html .='Image';
                    } else if($uploadDetails[0]['uploadType']=='video'){
                        $html .='Video';
                    }
                    $html .='</a>';
                }
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            } else if($notify_type == 'friendrequest'){
                $friendcon              = array('id'=>$notify_id);
                $friendDetails          = $modelPlugin->getfriendsTable()->fetchall($friendcon);
                $friendId               = $friendDetails[0]['friendsid'];
                $friendPersonalDetails  = $modelPlugin->getuserTable()->fetchall(array('userid'=>$friendId));
                if($notify_seen == 1){
                    $html .='<div class="e-notification relationship_accepted seen">';
                } else{
                    $html .='<div class="e-notification relationship_accepted not-seen" data-id="'.$notificationid.'">';
                }
                $html .='<div class="avatar-wrapper pull-left">';
                $html .='<img class="img-responsive img-rounded"src="'.@$friendPersonalDetails[0]['profileimage'].'" onerror="this.src=\'/image/profile-deafult-avatar.jpg\'">';
                $html .='</div>';
                $html .='<div class="pull-right e-notification-icon">';
                if($friendDetails[0]['relationshipstatus']=='accepted'){
                    $html .='<div class="fa e-green fa-user-plus"></div>';
                } else if($friendDetails[0]['relationshipstatus']=='	
declined'){
                    $html .='<div class="fa e-red fa-user-minus"></div>';
                } else{
                    $html .='<div class="fa e-green fa-user-plus"></div>';
                }
                $html .='</div>';
                $html .='<div class="e-notification-info">';
                $html .='<div class="user-name">';
                $html .='<a class="e-link" href="">';
                $html .='<strong>'.@$friendPersonalDetails[0]['firstname'].' '.@$friendPersonalDetails[0]['lastname'].'</strong>';
                $html .='</a>';
                $html .='</div>';
                $html .='<div class="action">';
                if($friendDetails[0]['relationshipstatus']=='accepted'){
                    $html .='<strong class="e-green">accepted </strong>';
                    $html .='<span class="e-brown">your request </span>';
                } else if($friendDetails[0]['relationshipstatus']=='	
declined'){
                    $html .='<strong class="e-red">declined </strong>';
                    $html .='<span class="e-brown">your request </span>';
                } else{
                    $html .='<strong class="e-red">Wants to </strong>';
                    $html .='<span class="e-brown">your friend</span>';
                }
                
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            } else if($notify_type == 'album'){
                $albumDetails           = $modelPlugin->getalbumdetailsTable()->fetchall(array('albumeid'=>$notify_id));
                $uploadBy               = $albumDetails[0]['UID'];
                $taggedByDetails        = $modelPlugin->getuserTable()->fetchall(array('userid'=>$uploadBy));
                if($notify_seen == 1){
                    $html .='<div class="e-notification tag seen">';
                } else{
                    $html .='<div class="e-notification tag not-seen" data-id="'.$notificationid.'">';
                }
                $html .='<div class="avatar-wrapper pull-left">';
                $html .='<img class="img-responsive img-rounded"src="'.@$taggedByDetails[0]['profileimage'].'" onerror="this.src=\'/image/profile-deafult-avatar.jpg\'">';
                $html .='</div>';
                $html .='<div class="pull-right e-notification-icon">';
                $html .='<div class="fa e-green fa-tag"></div>';
                $html .='</div>';
                $html .='<div class="e-notification-info">';
                $html .='<div class="user-name">';
                $html .='<a class="e-link" href="">';
                $html .='<strong>'.@$taggedByDetails[0]['firstname'].' '.@$taggedByDetails[0]['lastname'].'</strong>';
                $html .='</a>';
                $html .='</div>';
                $html .='<div class="action">';
                $html .='<span>tagged you on</span>';
                $html .='<a class="e-link e-brown pointer">Album</a>';
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            } else if($notify_type == 'upload'){
                $uploadDetails          = $modelPlugin->getuploadDetailsTable()->fetchall(array('uploadId'=>$notify_id));
                $uploadBy               = $uploadDetails[0]['UID'];
                $taggedByDetails        = $modelPlugin->getuserTable()->fetchall(array('userid'=>$uploadBy));
                if($notify_seen == 1){
                    $html .='<div class="e-notification tag seen">';
                } else{
                    $html .='<div class="e-notification tag not-seen" data-id="'.$notificationid.'">';
                }
                $html .='<div class="avatar-wrapper pull-left">';
                $html .='<img class="img-responsive img-rounded"src="'.@$taggedByDetails[0]['profileimage'].'" onerror="this.src=\'/image/profile-deafult-avatar.jpg\'">';
                $html .='</div>';
                $html .='<div class="pull-right e-notification-icon">';
                $html .='<div class="fa e-green fa-tag"></div>';
                $html .='</div>';
                $html .='<div class="e-notification-info">';
                $html .='<div class="user-name">';
                $html .='<a class="e-link" href="">';
                $html .='<strong>'.@$taggedByDetails[0]['firstname'].' '.@$taggedByDetails[0]['lastname'].'</strong>';
                $html .='</a>';
                $html .='</div>';
                $html .='<div class="action">';
                $html .='<span>tagged you on</span>';
                
                $html .='<a class="e-link e-brown pointer">';
                if($uploadDetails[0]['uploadType']=='text'){
                        $html .='Text';  
                    } else if($uploadDetails[0]['uploadType']=='image'){
                        $html .='Image';
                    } else if($uploadDetails[0]['uploadType']=='video'){
                        $html .='Video';
                    }
                $html .='</a>';
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            } else if($notify_type == 'tribute'){
                $where                  = array('tributedetails.tributesid'=>$notify_id);
                $join                   = 'tributedetails.friendsid=user.userid';
                $friendDetails          = $modelPlugin->gettributedetailsTable()->joinquery($where,$join);
                if($notify_seen == 1){
                    $html .='<div class="e-notification tribute seen">';
                } else{
                    $html .='<div class="e-notification tribute not-seen" data-id="'.$notificationid.'">';
                }
                $html .='<div class="avatar-wrapper pull-left">';
                $html .='<img class="img-responsive img-rounded"src="'.@$friendDetails[0]['profileimage'].'" onerror="this.src=\'/image/profile-deafult-avatar.jpg\'">';
                $html .='</div>';
                $html .='<div class="pull-right e-notification-icon">';
                $html .='<div class="fa e-yellow fa-envelope"></div>';
                $html .='</div>';
                $html .='<div class="e-notification-info">';
                $html .='<div class="user-name">';
                $html .='<a class="e-link" href="">';
                $html .='<strong>'.@$friendDetails[0]['firstname'].' '.@$friendDetails[0]['lastname'].'</strong>';
                $html .='</a>';
                $html .='</div>';
                $html .='<div class="action">';
                $html .='<span>wrote</span>';
                $html .='<a class="e-link e-brown pointer" href="">Tribute</a>';
                $html .='<span>for you</span>';
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            } else if($notify_type == 'comment'){
                $status                 = "";
                $where                  = array('tributedetails.tributesid'=>$notify_id);
                $join                   = 'tributedetails.UID=user.userid';
                $friendDetails          = $modelPlugin->gettributedetailsTable()->joinquery($where,$join);
                if($friendDetails[0]['tribute_type'] == 'album'){
                    $albumDetails       = $modelPlugin->getalbumdetailsTable()->fetchall(array('albumeid'=>$friendDetails[0]['uploadId']));
                    $status='<a class="e-link e-brown pointer" href="">Album</a>';
                } else if($friendDetails[0]['tribute_type'] == 'relationship'){
                    $status='<a class="e-link e-brown pointer" href="">Relationship</a>';
                } else if($friendDetails[0]['tribute_type'] == 'upload'){
                    $uploadDetails      = $modelPlugin->getuploadDetailsTable()->fetchall(array('uploadId'=>$friendDetails[0]['uploadId']));
                    if($friendDetails[0]['uploadType'] == 'text'){
                        $status='<a class="e-link e-brown pointer" href="">Text</a>';
                    } else if($friendDetails[0]['uploadType'] == 'image'){
                        $status='<a class="e-link e-brown pointer" href="">Image</a>';
                    } else if($friendDetails[0]['uploadType'] == 'video'){
                        $status='<a class="e-link e-brown pointer" href="">Video</a>';
                    }
                }
                if($notify_seen == 1){
                    $html .='<div class="e-notification comment seen">';
                } else{
                    $html .='<div class="e-notification comment not-seen" data-id="'.$notificationid.'">';
                }
                $html .='<div class="avatar-wrapper pull-left">';
                $html .='<img class="img-responsive img-rounded"src="'.@$friendDetails[0]['profileimage'].'" onerror="this.src=\'/image/profile-deafult-avatar.jpg\'">';
                $html .='</div>';
                $html .='<div class="pull-right e-notification-icon">';
                $html .='<div class="fa e-blue fa-comment"></div>';
                $html .='</div>';
                $html .='<div class="e-notification-info">';
                $html .='<div class="user-name">';
                $html .='<a class="e-link" href="">';
                $html .='<strong>'.@$friendDetails[0]['firstname'].' '.@$friendDetails[0]['lastname'].'</strong>';
                $html .='</a>';
                $html .='</div>';
                $html .='<div class="action">';
                $html .='<span>commented your</span>';
                $html .=$status;
                $html .='</div>';
                $html .='</div>';
                $html .='</div>';
            }
            
            $array[] = array(
                'notificationid' => $notificationid,
                'notified_by' => $notified_by,
                'notify_id' => $notify_id,
                'notify_type'=>$notify_type,
                'html'=>$html,
                'unread'=>$unreadNotification
            );
          }
        $res['notificationDetails'] = $array;
        } else{
            $array                      = array();
            $res['notificationDetails'] = $array;
        }
        echo json_encode($res);
        exit;
    }
}
?>

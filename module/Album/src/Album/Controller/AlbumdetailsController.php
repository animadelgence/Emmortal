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

class AlbumdetailsController extends AbstractActionController {
    public function __construct() {
        $userSession        = new Container('userloginId');
        $this->sessionid    = $userSession->offsetGet('userloginId');
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     //header("Location:" . $dynamicPath. "/album/showalbum");
        //     header("Location:" . $dynamicPath);
        //     exit;
        // }
    }
    public function albumpageAction(){
    	$this->layout('layout/albumlayout.phtml');
        $plugin             = $this->routeplugin();
        $modelPlugin        = $this->modelplugin();
        $dynamicPath        = $plugin->dynamicPath();
        $jsonArray          = $plugin->jsondynamic();
        $currentPageURL     = $plugin->curPageURL();
        $href               = explode("/", $currentPageURL);
        $controller         = @$href[3];
        $action             = @$href[4];
        
        $idOfUSer    = $this->getEvent()->getRouteMatch()->getParam('id');
        $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $loggedInUserUniqueId = $LoggedInUserDetails[0]['uniqueUser'];
        
        
        $this->layout()->setVariables(array('controller' => $controller,
                                            'action' => $action,
                                            'loggedInUserUniqueId'=>$loggedInUserUniqueId,
                                            'sessionid'=>$this->sessionid)
                                     );
        $query              = array('albumeid'=>1);
        $albumDetails       = $modelPlugin->getalbumdetailsTable()->fetchall($query);
        $where              = array('AID'=>1);
        $likeDetails        = $modelPlugin->getlikesdetailsTable()->fetchall($where);
        $uploadDetails      = $modelPlugin->getuploadDetailsTable()->fetchall($where);
        $likeCount          = count($likeDetails);
        return new ViewModel(array('sessionid'=>$this->sessionid,
                                   'dynamicPath' => $dynamicPath,
                                   'jsonArray'=>$jsonArray,
                                   'albumDetails'=>$albumDetails,
                                   'likeCount'=>$likeCount,
                                   'uploadDetails'=>$uploadDetails
                                )
                            );
    }
    public function likesaveAction(){
        $plugin         = $this->routeplugin();
        $modelPlugin    = $this->modelplugin();
        $dynamicPath    = $plugin->dynamicPath();
        $jsonArray      = $plugin->jsondynamic();
        $UID            = $this->sessionid;
        $type           = $_POST['datacmd'];
        $id             = $_POST['id'];
        /*$type           = 'album';
        $id             = 21;*/
        if($type == 'album'){
            $where      = array('AID'=>$id,'UID'=>$UID);
            $data       = array(
                            'AID'=>$id,
                            'UID'=>$UID,
                            'likedate'=> date("Y-m-d H:i:s")
                        );
            $query      = array('AID'=>$id);
            $albumDet   = $modelPlugin->getalbumdetailsTable()->fetchall(array('albumeid'=>$id));
            $uid = $albumDet[0]['UID'];
        } else if($type == 'tribute'){
            $where      = array('TID'=>$id,'UID'=>$UID);
            $data       = array(
                            'TID'=>$id,
                            'UID'=>$UID,
                            'likedate'=> date("Y-m-d H:i:s")
                        );
            $query      = array('TID'=>$id);
            $tributeDet = $modelPlugin->gettributedetailsTable()->fetchall(array('tributesid'=>$id));
            $uid        = $tributeDet[0]['UID'];
        } else if($type == 'friend'){
            $where      = array('FID'=>$id,'UID'=>$UID);
            $data       = array(
                            'FID'=>$id,
                            'UID'=>$UID,
                            'likedate'=> date("Y-m-d H:i:s")
                        );
            $query      = array('FID'=>$id);
            $uid        = $id;
        } else{
            $where      = array('uploadId'=>$id,'UID'=>$UID);
            $data       = array(
                            'uploadId'=>$id,
                            'UID'=>$UID,
                            'likedate'=> date("Y-m-d H:i:s")
                        );
            $query      = array('uploadId'=>$id);
            $uploadDet  = $modelPlugin->getuploadDetailsTable->fetchall($query);
            $uid        = $uploadDet[0]['UID'];
        }
        $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($where);
        if(count($likeDetails)>0){
            $likeDelete         = $modelPlugin->getlikesdetailsTable()->deleteLike($where);
            $notiDElCon         = array(
                                    'notify_id'=>$likeDetails[0]['likeid'],
                                    'notified_by'=>$UID,
                                    'notify_type'=>'like'
                                );
            $notificationDelete = $modelPlugin->getnotificationdetailsTable()->deleteNotification($notiDElCon);
        } else{
            $likeInsert         = $modelPlugin->getlikesdetailsTable()->insertLike($data); 
            
            if($uid == $UID){
                $fndDetails          = $modelPlugin->getfriendsTable()->fetchall(array('requestaccept'=>1));
                foreach($fndDetails as $fRes ){
                    if($fRes['userid'] == $UID){
                        $notificationData   = array(
                                                'UID'=>$fRes['friendsid'],
                                                'notified_by'=>$UID,
                                                'notify_id'=>$likeInsert,
                                                'notify_type'=>'like',
                                                'notify_seen'=>0,
                                                'notificationdate'=>date("Y-m-d H:i:s")
                                            );
                    $notificationInsert     = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData); 
                    } else if($fRes['friendsid'] == $UID){
                        $notificationData   = array(
                                                'UID'=>$fRes['userid'],
                                                'notified_by'=>$UID,
                                                'notify_id'=>$likeInsert,
                                                'notify_type'=>'like',
                                                'notify_seen'=>0,
                                                'notificationdate'=>date("Y-m-d H:i:s")
                                            );
                        $notificationInsert     = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData);
                    }
                }
                
            } else{
                $notificationData   = array(
                                        'UID'=>$uid,
                                        'notified_by'=>$UID,
                                        'notify_id'=>$likeInsert,
                                        'notify_type'=>'like',
                                        'notify_seen'=>0,
                                        'notificationdate'=>date("Y-m-d H:i:s")
                                    );
                $notificationInsert     = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData);
            }
        }
        $likeDetails    = $modelPlugin->getlikesdetailsTable()->fetchall($query);
        echo $likeCount = count($likeDetails);
        exit;
    }
    public function getuploadAction(){
        $plugin             = $this->routeplugin();
        $modelPlugin        = $this->modelplugin();
        $dynamicPath        = $plugin->dynamicPath();
        $jsonArray          = $plugin->jsondynamic();
        $uploadId           = $_POST['uploadId'];
        $where              = array("uploadId"=>$uploadId);
        $uploadDetails      = $modelPlugin->getuploadDetailsTable()->joinquery($uploadId);
        $likeDetails        = $modelPlugin->getlikesdetailsTable()->fetchall($where);
        $likeCount          = count($likeDetails);
        $array              = array();
        foreach ($uploadDetails as $rSet) {
            $hr             = date("H",strtotime($rSet['TimeStamp']));
            $min            = date("i",strtotime($rSet['TimeStamp']));
            if($hr>=12){
                $hr         = $hr - 12;
                $time       = $hr.":".$min."PM";
            } else{
                $time       = date("H:i",strtotime($rSet['TimeStamp']))."AM";
            }
            $join           = 'tributedetails.UID = user.userid';
            $condition      = array('tributedetails.uploadId'=>$rSet['uploadId']);
            $tribute        = $modelPlugin->gettributedetailsTable()->joinquery($condition,$join);
            $tributeDetails = array();
            foreach($tribute as $result){
                $where              = array('TID'=>$result['tributesid']);
                $likeDetails        = $modelPlugin->getlikesdetailsTable()->fetchall($where);
                $like               = count($likeDetails);
                $tributeDetails[]   = array(
                                        'tributesid' => $result['tributesid'],
                                        'UID' => $result['UID'],
                                        'profileName' => $result['firstname']." ".$result['lastname'],
                                        'profileImage'=>$result['profileimage'],
                                        'uniqueUser'=>$result['uniqueUser'],
                                        'tributeDescription'=>$result['description'],
                                        'shortDescription'=>substr($result['description'],0,20).'...',
                                        'friendsid'=>$result['friendsid'],
                                        'like'=>$like,
                                        'addeddate'=>date("m/d/Y",strtotime($result['addeddate']))
                                    );
            }
                $array[]             = array(
                                        'uploadTitle' => $rSet['uploadTitle'],
                                        'uploadDescription' => $rSet['uploadDescription'],
                                        'uploadPath' => $rSet['uploadPath'],
                                        'dateTime' => date("m/d/Y",strtotime($rSet['TimeStamp']))." ".$time,
                                        'username' => $rSet['firstname']." ".$rSet['lastname'],
                                        'userimage' => $rSet['profileimage'],
                                        'uniqueUser' => $rSet['uniqueUser'],
                                        'userid'=>$rSet['userid'],
                                        'likeCount'=>$likeCount,
                                        'tributeDetails'=>$tributeDetails,
                                        'sessionId'=>$this->sessionid
                                    );
        }
        $res['uploadDetails']       = $array;
        echo json_encode($res);
        exit;
    }
}
?>

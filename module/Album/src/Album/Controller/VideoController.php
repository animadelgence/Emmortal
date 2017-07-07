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

class VideoController extends AbstractActionController {
   public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        
    }

    public function videosubmitAction(){
        $request1           =    $this->getRequest()->getPost();
        $filename           =    $request1['file'];
        $request            =    $this->getRequest();
        $files              =    $request->getFiles()->toArray();
        $plugin             =    $this->routeplugin();
        $videouploadplugin  =    $this->videouploadplugin();
        $folderName         =    '/upload/video/';
        $tmp_name           =    $files ['file']['tmp_name'];
        $uploadfilename     =    $files ['file']['name'];
        $videoupload        =    $videouploadplugin->videoupload($tmp_name,$uploadfilename,$folderName);
        echo $videoupload;exit;

        
}
    public function videodetailssubmitAction(){
           $plugin               = $this->routeplugin();
           $modelPlugin          = $this->modelplugin();
           $dynamicPath          = $plugin->dynamicPath();
           $title                = $_POST['title'];
           $videoDescription     = $_POST['videoDescription'];
           $uploadedvideo        = $_POST['uploadedvideo'];
           $frndIdValue          = $_POST['friendsId'];
           if($frndIdValue){
           $friendId             =  implode(",",$frndIdValue);
            } else{
              $friendId = "";
            }
           $albumId              = $_POST['albumId'];
           $UID                  = $this->sessionid;
           $currentPageIdValue = $_POST['currentPageId'];
           if(!$currentPageIdValue){
            $where              = array('UID'=>$UID);
            $pageDetails        = $modelPlugin->getpagedetailsTable()->fetchall($where);
            $currentPageId      = $pageDetails[0]['pageid'];
           } else{
            $currentPageId = $currentPageIdValue;
           }
           $addeddate             = date('Y-m-d H:i:s');
           $data                  =  array('UID'=>$UID,
                      'uploadTitle'=>$title,
                      'uploadDescription'=>$videoDescription,
                      'AID'=>$albumId,
                      'FID'=>$friendId,
                      'TimeStamp'=>$addeddate,
                      'uploadPath'=> $dynamicPath.'/upload/video/'.$uploadedvideo,
                      'uploadType'=>'video',
                      'PID'=>$currentPageId,

                      );
            $albumDetails         = $modelPlugin->getuploadDetailsTable()->insertData($data);
            if($friendId != ''){
            $frndId = explode(",",$friendId);
            $ct = count($frndId);
                for($i=0;$i<$ct;$i++){
                    $notificationData   = array(
                                                'UID'=>$frndId[$i],
                                                'notified_by'=>$UID,
                                                'notify_id'=>$albumDetails,
                                                'notify_type'=>'upload',
                                                'notify_seen'=>0,
                                                'notificationdate'=>date("Y-m-d H:i:s")
                                            );
                    $notificationInsert = $modelPlugin->getnotificationdetailsTable()->insertNotification($notificationData);
                }
            }
           
           echo $albumDetails;exit;
           
    }
}

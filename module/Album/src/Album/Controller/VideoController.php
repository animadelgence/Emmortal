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
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     header("Location:" . $dynamicPath. "/profile/showprofile");
        //     exit;
        // }
    }

    public function videosubmitAction(){
        $request1           =    $this->getRequest()->getPost();
        $filename           =    $request1['file'];
        $request            =    $this->getRequest();
        $files              =    $request->getFiles()->toArray();
        $plugin             =    $this->routeplugin();
        $videouploadplugin  =    $this->videouploadplugin();
        $folderName         =    '/video/';
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
           $frndIdValue               = $_POST['friendsId'];
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
                      'uploadPath'=>'/video/'.$uploadedvideo,
                      'uploadType'=>'video',
                      'PID'=>$currentPageId,

                      );
           $albumDetails         = $modelPlugin->getuploadDetailsTable()->insertData($data);
           echo $albumDetails;exit;
           
    }
}
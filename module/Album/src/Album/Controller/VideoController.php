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
           $modelPlugin        =    $this->modelplugin();
           $plugin = $this->routeplugin();
           $modelPlugin = $this->modelplugin();
           $dynamicPath = $plugin->dynamicPath();
           $title                = $_POST['title'];
           $videoDescription     = $_POST['videoDescription'];
           $uploadedvideo        = $_POST['uploadedvideo'];
           $frndId               = $_POST['friendsId'];
           $friendId             =  implode(",",$frndId);
           $albumId                  = $_POST['albumId'];
           $currentPageId = $_POST['currentPageId'];
           $UID = 1;
           $addeddate = date('Y-m-d H:i:s');
           $data =  array('UID'=>$UID,
                      'uploadTitle'=>$title,
                      'uploadDescription'=>$videoDescription,
                      'AID'=>$albumId,
                      'FID'=>$friendId,
                      'TimeStamp'=>$addeddate,
                      'uploadPath'=>'/video/'.$uploadedvideo,
                      'uploadType'=>'video',
                      'PID'=>$currentPageId,

                      );
           $albumDetails = $modelPlugin->getuploadDetailsTable()->insertData($data);
            echo $albumDetails;
           
    }
}
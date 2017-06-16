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
        $request1 = $this->getRequest()->getPost();
        $filename = $request1['file'];
        $request = $this->getRequest();
        $files = $request->getFiles()->toArray();
        $plugin = $this->routeplugin();
        $videouploadplugin = $this->videouploadplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $folderName = '/video/';
        $tmp_name =$files ['file']['tmp_name'];
        $uploadfilename = $files ['file']['name'];
        $videoupload = $videouploadplugin->videoupload($tmp_name,$uploadfilename,$folderName);
        echo $videoupload;exit;

        
}
    public function videodetailssubmitAction(){
          $title = $_POST['title'];
          $videoDescription = $_POST['videoDescription'];
          $uploadedvideo = $_POST['uploadedvideo'];

    }
}
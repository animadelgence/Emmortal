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

class ImageController extends AbstractActionController {
    
    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath. "/profile/showprofile");
            exit;
        }
    }

    public function indexAction() {
        echo "hello from album ,work under progress";exit;
        
    }
    public function saveimageAction() {
        $request1 = $this->getRequest()->getPost();
        $filename = $request1['filename'];
        $request = $this->getRequest();
        $files = $request->getFiles()->toArray();
        $imageName = $files['file']['name'];
        $temp_name = $files['file']['tmp_name'];
        $filename = date("Y-m-d h:i:sa").' image'.$imageName;
        $newfilename = $_SERVER['DOCUMENT_ROOT'].'/image/'.$filename;

        if(move_uploaded_file($temp_name, $newfilename))
        {
            echo '/image/'.$filename;
            exit;
        }  
    }
    public function removeimageAction() {
        //echo 1; exit;
        $imagePath = $_POST['removeimage'];
        $path = $_SERVER['DOCUMENT_ROOT'].$imagePath;
        unlink($path);
        echo $imagePath ;
        exit;
    }
  public function saveImageDetailsAction() {
        echo $this->sessionid;exit;
        //print_r($_POST); exit;
        $imageTitle = $_POST['imageTitle'];
        $imagePath = $_POST['imagePath'];
        $imagefriendsId = $_POST['imagefriendsId'];
        $imageDescription = $_POST['imageDescription'];
        $currentPageId = $_POST['pageId'];
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
      //echo $action;exit;
        $ct = count($imagefriendsId);
        $friendsid= '';
        for($i=0;$i<$ct;$i++){
          $friendsid = $friendsid.$imagefriendsId[$i].',';
        }
        if($action == 'showprofile')
        {
            $uploadQuery = array(
                            'UID'=>2,
                            'PID'=>$currentPageId,
                            'uploadTitle'=>$imageTitle,
                            'uploadDescription'=>$imageDescription,
                            'uploadPath'=>$imagePath,
                            'uploadType'=>'image',
                            'AID'=>1,
                            'FID'=>$friendsid,
                            'TimeStamp'=>$addeddate
                            );
            $albumDetails = $modelPlugin->getuploadDetailsTable()->insertData($uploadQuery);
            echo $albumDetails;exit;
            return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
        }
  }

}

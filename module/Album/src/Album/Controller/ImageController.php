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
       /* $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath. "/profile/showprofile");
            exit;
        }*/
    }

    public function indexAction() {
        echo "hello from album ,work under progress";exit;
        
    }
    public function saveimageAction() {
        //echo 1; exit;
        $plugin = $this->routeplugin();
        $dynamicPath = $plugin->dynamicPath();
        $request1 = $this->getRequest()->getPost();
        $filename = $request1['filename'];
        $request = $this->getRequest();
        $files = $request->getFiles()->toArray();
        $imageName = $files['file']['name'];
        $temp_name = $files['file']['tmp_name'];
        $filename = date("Y-m-d h:i:sa").' image'.$imageName;
        $filename = str_replace(' ', '_', $filename);
        $newfilename = $_SERVER['DOCUMENT_ROOT'].'/upload/uploadimage/'.$filename;
        $res['imgFilename'] = $filename;
        $res['imgFolder'] = '/upload/uploadimage/';
        
    
        if(move_uploaded_file($temp_name, $newfilename))
        {
            /*echo '/upload/uploadimage/'.$filename;
            exit;*/
            //$folderName = $_SERVER['DOCUMENT_ROOT'].'/upload/uploadimage/';
            //$pathThumb = $this->resizeImage($folderName, $filename);
            $res['imgFullName'] = '/upload/uploadimage/'.$filename; 
            //exit;
            
        }  
        echo json_encode($res);
        exit;
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
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $imageTitle = $_POST['imageTitle'];
        $imagePath = $_POST['imagePath'];
        
        /*$imageFolder = $_POST['imageFolder'];
        $imageName = $_POST['imageName'];
        $pathThumb = $this->resizeImage($imageFolder, $imageName);*/
        
        $imagefriendsId = '';
        $friendsid= '';
        if($_POST['imagefriendsId'])
        {
            $imagefriendsId = $_POST['imagefriendsId'];
            $ct = count($imagefriendsId);
            for($i=0;$i<$ct;$i++){
                $friendsid = $friendsid.$imagefriendsId[$i].',';
            }
        }
        $imageDescription = $_POST['imageDescription'];
        $currentPageId = '';
        if($_POST['pageId'])
        {
            $currentPageId = $_POST['pageId'];
        }

      //echo $action;exit;
        $addeddate = date('Y-m-d H:i:s');
        if(!$currentPageId)
        {
            $where              = array('UID'=>$this->sessionid);
            $pageDetails        = $modelPlugin->getpagedetailsTable()->fetchall($where);
            //print_r($pageDetails);exit;
            $currentPageId      = $pageDetails[0]['pageid'];
            //echo $currentPageId;
            //exit;
        }
        $uploadQuery = array(
                            'UID'=>$this->sessionid,
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
        if($albumDetails)
        {
            $result = 1;
        }
        echo $result; exit;
            //return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
    }
    /*public function resizeImage($updir, $img)
    {
        $thumbnail_width = 352;             //resizing image
     	$thumbnail_height = 352;
     	
     	$arr_image_details = getimagesize("$updir"."$img"); // pass id to thumb name
     	$original_width = $arr_image_details[0];
     	$original_height = $arr_image_details[1];
     	if ($original_width > $original_height) {
     		$new_width = $thumbnail_width;
     		$new_height = intval($original_height * $new_width / $original_width);
     	} else {
     		$new_height = $thumbnail_height;
     		$new_width = intval($original_width * $new_height / $original_height);
     	}
     	$dest_x = intval(($thumbnail_width - $new_width) / 2);
     	$dest_y = intval(($thumbnail_height - $new_height) / 2);
     	if ($arr_image_details[2] == 1) {
     		$imgt = "ImageGIF";
     		$imgcreatefrom = "ImageCreateFromGIF";
     	}
     	if ($arr_image_details[2] == 2) {
     		$imgt = "ImageJPEG";
     		$imgcreatefrom = "ImageCreateFromJPEG";
     	}
     	if ($arr_image_details[2] == 3) {
     		$imgt = "ImagePNG";
     		$imgcreatefrom = "ImageCreateFromPNG";
     	}
     	if ($imgt) {
     		$old_image = $imgcreatefrom("$updir"."$img");
     		$new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height);
     		imagecopyresized($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
     		$imgt($new_image, "$updir"."$img");
     		return "$img";
     	}
    }*/

}

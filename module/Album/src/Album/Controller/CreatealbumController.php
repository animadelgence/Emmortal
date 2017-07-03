<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *  created by: Maitrayee
 */

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class CreatealbumController extends AbstractActionController {

    //protected $albumdetailsTable;
    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
       
    }
    public function indexAction() {
        echo "welcome from album module23";exit;
    	
    }
   public function savealbumAction() {
        $plugin = $this->routeplugin();
        $dynamicPath = $plugin->dynamicPath();
        $uploadPlugin      = $this->imageuploadplugin();
        $request1 = $this->getRequest()->getPost();
        $filename = $request1['filename'];
        //$filename          = $request1['filename'];
        $request = $this->getRequest();
        $files = $request->getFiles()->toArray();
        $imageName = $files[$filename]['name'];
        $temp_name = $files[$filename]['tmp_name'];
        $filename = date("Y-m-d").$imageName;
        $fileName = str_replace(' ', '_', $filename);
        $userID = $this->sessionid;
        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/uploadimage/' . $userID)) {
                @mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/uploadimage/' . $userID, 0777, true);
                chmod($_SERVER['DOCUMENT_ROOT'] . '/upload/uploadimage/' . $userID, 0777);
        }
        $newfilename = $_SERVER['DOCUMENT_ROOT'].'/upload/uploadimage/'.$fileName;
        $res['imgFilename'] = $filename;
        $res['imgFolder'] = $_SERVER['SERVER_NAME'] . '/upload/uploadimage/'.$fileName;
        
       
    
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
    public function removealbumAction() {
        //echo 1; exit;
        $imagePath = $_POST['removeimage'];
        $path = $_SERVER['DOCUMENT_ROOT'].$imagePath;
        unlink($path);
        echo $imagePath ;
        exit;
    }
   
    
}
?>

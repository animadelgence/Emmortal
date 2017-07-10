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

class LazyloadController extends AbstractActionController {

	  public function __construct() {
        $userSession     = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
       
    }
    public function loadAction(){
    	 $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = 'album';
		    $action = $this->params('action');
		    $galleryStruct = "";
        $t = intval($_POST["counter"]);
        $uploadAll = $modelPlugin->getuploadDetailsTable()->fetchAllData($t);
        foreach ($uploadAll as $upload) {
            $likeDetailsArrays = array();
            $uploadId = $upload['uploadId'];
            $uploadIdquery = array('uploadId' =>$uploadId);
            $likeDetails = $modelPlugin->getlikesdetailsTable()->countLike($uploadIdquery);
            $likeDetailsArray[$uploadId] = $likeDetails;
            array_push($likeDetailsArrays,$likeDetailsArray);
    
        }
         $totalcount = count($uploadAll);
        if ($totalcount > 0) {
            $res['checker'] = 1;
            for ($i = 0; $i < $totalcount; $i++) {
              $uploadId = $uploadAll[$i]['uploadId'];
              $uploadAlbumId = $uploadAll[$i]['AID'];
              $encodeUploadId = base64_encode($uploadAlbumId);
            	if($uploadAll[$i]['uploadType'] == "text"){

                                             $galleryStruct .= '<li class="gs-w previewUploadedFile dynamic" data-sizey="'.$uploadAll[$i]['sizeY'].'" data-sizex="'.$uploadAll[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="text" data-id="'.$uploadAll[$i]['uploadId'].'">
                                             <div class="uploadtext"><label name="text Name">'.$uploadAll[$i]['uploadTitle'].'<p>'.$uploadAll[$i]['uploadDescription'].'</p></label></div><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].' </div> </li>';
                                           }


                                           else if($uploadAll[$i]['uploadType'] == "image"){
                                                if (@getimagesize($uploadAll[$i]['uploadPath'])) {
                                                  $uploadedImage = $uploadAll[$i]['uploadPath'];
                                              }else{
                                                  $uploadedImage = $dynamicPath."/image/NoPhotoDefault.png";
                                              }

                                              $galleryStruct .= ' <li class="gs-w previewUploadedFile dynamic" data-sizey="'.$uploadAll[$i]['sizeY'].'" data-sizex="'.$uploadAll[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="image" data-id="'.$uploadAll[$i]['uploadId'].'">
                                              <span><img name="Image Name" id="" src="'.$uploadedImage.'" style="width:100%;height:100%;"></span><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].'</div></li>';

                                          }
                                             else if($uploadAll[$i]['uploadType'] == "album"){
                                                if (@getimagesize($uploadAll[$i]['uploadPath'])) {
                                                  $uploadedImage = $uploadAll[$i]['uploadPath'];
                                              }else{
                                                  $uploadedImage = $dynamicPath."/image/NoPhotoDefault.png";
                                              }

                                              $galleryStruct .= ' <li class="gs-w albumid dynamic" data-sizey="'.$uploadAll[$i]['sizeY'].'" data-sizex="'.$uploadAll[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="album" id="'.$uploadAll[$i]['AID'].'" data-id="'.$uploadAll[$i]['uploadId'].'">
                                              <span><img name="Image Name" id="" src="'.$uploadedImage.'" style="width:100%;height:100%;"></span><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].'</div></li>';

                                          }
                                           else if($uploadAll[$i]['uploadType'] == "video"){
                                                $galleryStruct .=  ' <li class="gs-w previewUploadedFile dynamic" data-sizey="'.$uploadAll[$i]['sizeY'].'" data-sizex="'.$uploadAll[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="video" data-id="'.$uploadAll[$i]['uploadId'].'">
                                                <span><video controls="controls" name="Video Name" id="" src="'.$uploadAll[$i]['uploadPath'].'" style="width:100%;height:100%;"></video></span><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].'</div></li>';



                                           }
                                           else{

                                           }
                                           if (($totalcount - 1) == $i)
                    						break;
            }
        }
         else {
            $res['checker'] = 0;
        }
        $res['galleryStruct'] = $galleryStruct;
        echo json_encode($res);
        exit;

    }
}

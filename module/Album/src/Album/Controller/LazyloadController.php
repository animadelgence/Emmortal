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
        $uploadQuery = "uploadPath IS NOT NULL";
        $uploadDetailstemp = $modelPlugin->getuploadDetailsTable()->fetchAllData($uploadQuery,$t);
        $uploadDetails = array();
        foreach ($uploadDetailstemp as $upload) {
            $likeDetailsArrays = array();
            $uploadId = $upload['uploadId'];
            $uploadIdquery = array('uploadId' =>$uploadId);
            $likeDetails = $modelPlugin->getlikesdetailsTable()->countLike($uploadIdquery);
            if($upload['sizeX']=="H") {
                $sizeX = 1;$Height = "172px";
            } else {
                $sizeX = 2;$Height = "364px";
            }
            if($upload['sizeY']=="W") {
                 $sizeY = 2;$Width = "364px";
            } else {
                 $sizeY = 1;$Width = "172px";
            }
            $albumUploadDetails = array();
            if($upload['uploadType'] == 'album') {
                $queryForAlbum =  array('AID' => $upload['AID']);
                $uploadDetailstemporary = $modelPlugin->getuploadDetailsTable()->fetchalldatas($queryForAlbum);
                $i = 0;
                foreach($uploadDetailstemporary as $upDetTemp) {
                    if($i<=2) {
                        if($upDetTemp['uploadType'] != 'album'){
                        if($upDetTemp['sizeX']=="H") {
                            $sizeXTemp = 1;$HeightTemp = "172px";
                        } else {
                            $sizeXTemp = 2;$HeightTemp = "364px";
                        }
                        if($upDetTemp['sizeY']=="W") {
                             $sizeYTemp = 2;$WidthTemp = "364px";
                        } else {
                             $sizeYTemp = 1;$WidthTemp = "172px";
                        }
                        $albumUploadDetails[] = array(
                                                    'uploadId' => $upDetTemp['uploadId'],
                                                    'UID' => $upDetTemp['UID'],
                                                    'uploadPath'=>$upDetTemp['uploadPath'],
                                                    'uploadTitle' => $upDetTemp['uploadTitle'],
                                                    'uploadDescription' => $upDetTemp['uploadDescription'],
                                                    'uploadType' => $upDetTemp['uploadType'],
                                                    'albumcolor' => $upDetTemp['albumcolor'],
                                                    'sizeX' => $sizeXTemp,
                                                    'sizeY' => $sizeYTemp,
                                                    'height'=>$HeightTemp,
                                                    'width'=>$WidthTemp,
                                                    'AID' => $upDetTemp['AID'],
                                                    'FID' => $upDetTemp['FID'],
                                                    'PID' => $upDetTemp['PID'],
                                                    'TimeStamp' => $upDetTemp['TimeStamp']
                                                    );
                        }
                    }
                    $i++;
                }
            }
            $uploadDetails[] = array(
                                'uploadId' => $upload['uploadId'],
                                'UID' => $upload['UID'],
                                'uploadPath'=>$upload['uploadPath'],
                                'uploadTitle' => $upload['uploadTitle'],
                                'uploadDescription' => $upload['uploadDescription'],
                                'uploadType' => $upload['uploadType'],
                                'albumcolor' => $upload['albumcolor'],
                                'sizeX' => $sizeX,
                                'sizeY' => $sizeY,
                                'height'=>$Height,
                                'width'=>$Width,
                                'AID' => $upload['AID'],
                                'FID' => $upload['FID'],
                                'PID' => $upload['PID'],
                                'TimeStamp' => $upload['TimeStamp'],
                                'albumUploadDetails' => $albumUploadDetails
                                );
            
            $likeDetailsArray[$uploadId] = $likeDetails;
             array_push($likeDetailsArrays,$likeDetailsArray);
    
        }
         $totalcount = count($uploadDetails);
        if ($totalcount > 0) {
            $res['checker'] = 1;
            for ($i = 0; $i < $totalcount; $i++) {
              $uploadId = $uploadDetails[$i]['uploadId'];
              $uploadAlbumId = $uploadDetails[$i]['AID'];
              $encodeUploadId = base64_encode($uploadAlbumId);
            	if($uploadDetails[$i]['uploadType'] == "text"){

                                             $galleryStruct .= '<li class="gs-w previewUploadedFile dynamic" data-sizey="'.$uploadDetails[$i]['sizeY'].'" data-sizex="'.$uploadDetails[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="text" data-id="'.$uploadDetails[$i]['uploadId'].'">
                                             <div class="uploadtext"><label name="text Name">'.$uploadDetails[$i]['uploadTitle'].'<p>'.$uploadDetails[$i]['uploadDescription'].'</p></label></div><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].' </div> </li>';
                                           }


                                           else if($uploadDetails[$i]['uploadType'] == "image"){
                                                if (@getimagesize($uploadDetails[$i]['uploadPath'])) {
                                                  $uploadedImage = $uploadDetails[$i]['uploadPath'];
                                              }else{
                                                  $uploadedImage = $dynamicPath."/image/NoPhotoDefault.png";
                                              }

                                              $galleryStruct .= ' <li class="gs-w previewUploadedFile dynamic" data-sizey="'.$uploadDetails[$i]['sizeY'].'" data-sizex="'.$uploadDetails[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="image" data-id="'.$uploadDetails[$i]['uploadId'].'">
                                              <span><img name="Image Name" id="" src="'.$uploadedImage.'" style="width:100%;height:100%;"></span><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].'</div></li>';

                                          }
                                             else if($uploadDetails[$i]['uploadType'] == "album"){
                                                /*if (@getimagesize($uploadDetails[$i]['uploadPath'])) {
                                                  $uploadedImage = $uploadDetails[$i]['uploadPath'];
                                              }else{
                                                  $uploadedImage = $dynamicPath."/image/NoPhotoDefault.png";
                                              }

                                              $galleryStruct .= ' <li class="gs-w albumid dynamic" data-sizey="'.$uploadDetails[$i]['sizeY'].'" data-sizex="'.$uploadDetails[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="album" id="'.$uploadDetails[$i]['AID'].'" data-id="'.$uploadDetails[$i]['uploadId'].'">
                                              <span><img name="Image Name" id="" src="'.$uploadedImage.'" style="width:100%;height:100%;"></span><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].'</div></li>';*/
                                                 
                                                 
                                                 
                                              if (@getimagesize($uploadDetails[$i]['uploadPath'])) {
                                                  $uploadedImage = $uploadDetails[$i]['uploadPath'];
                                              }else{
                                                  $uploadedImage = $dynamicPath."/image/NoPhotoDefault.png";
                                              }

                                              $galleryStruct .= ' <li class="gs-w albumid" data-sizey="'.$uploadDetails[$i]['sizeY'].'" data-sizex="'.$uploadDetails[$i]['sizeX'].'" data-col="1" data-row="1" data-cmd="album" albumid="'.$uploadAlbumId.'" data-id="'.$uploadDetails[$i]['uploadId'].'">
                                              <span><img name="ImageName" src="'.$uploadedImage.'" ';
                                                if(count($uploadDetails[$i]['albumUploadDetails']) > 0) {
                                                    $galleryStruct .= 'style="width:100%;height:50%;"></span><div class="inner-box" style="top:141px;"> '.$likeDetailsArrays[0][$uploadId].' </div><h4 style= "color: #579942;">'.$uploadDetails[$i]['uploadTitle'].'</h4><div style="height:38%">';
                                                } else {
                                                    $galleryStruct .= 'style="width:100%;height:100%;"></span><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].' </div>';
                                                }
                                              foreach($uploadDetails[$i]['albumUploadDetails'] as $upload) {
                                                  $galleryStruct .= '<span><img name="ImageName" src="'.$upload['uploadPath'].'"style="border-radius:15px !important; height:100%; width:33%; padding:3px;"></span>';
                                              }
                                              if(count($uploadDetails[$i]['albumUploadDetails']) > 0) {
                                                  $galleryStruct .= '</div>';
                                              }

              $galleryStruct .= '</li>';

                                          }
                                           else if($uploadDetails[$i]['uploadType'] == "video"){
                                                $galleryStruct .=  ' <li class="gs-w previewUploadedFile dynamic" data-sizey="'.$uploadDetails[$i]['sizeY'].'" data-sizex="'.$uploadDetails[$i]['sizeX'].'" data-col="1" data-row="1"  data-cmd="video" data-id="'.$uploadDetails[$i]['uploadId'].'">
                                                <span><video controls="controls" name="Video Name" id="" src="'.$uploadDetails[$i]['uploadPath'].'" style="width:100%;height:100%;"></video></span><div class="inner-box"> '.$likeDetailsArrays[0][$uploadId].'</div></li>';



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

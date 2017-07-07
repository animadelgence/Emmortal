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

class AlbumController extends AbstractActionController {

    //protected $albumdetailsTable;
    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
     }
    public function indexAction() {
       // echo "welcome from album module";exit;
    	$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $dashboardFolder = $modelPlugin->getalbumdetailsTable()->fetchall();
        $this->layout()->setVariables(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));
        return new ViewModel();
        //print_r($dashboardFolder);exit;
    }
    public function showalbumAction(){
    	$this->layout('layout/albumlayout.phtml');
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        //print_r($jsonArray); exit;
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = 'album';
		$action = $this->params('action');
        $uploadQuery = array();
        $uploadDetails = $modelPlugin->getuploadDetailsTable()->fetchall($uploadQuery);
        
        foreach ($uploadDetails as $upload) {
            $likeDetailsArrays = array();
            $uploadId = $upload['uploadId'];
            $uploadIdquery = array('uploadId' =>$uploadId);
            $likeDetails = $modelPlugin->getlikesdetailsTable()->countLike($uploadIdquery);
            
            $likeDetailsArray[$uploadId] = $likeDetails;
             array_push($likeDetailsArrays,$likeDetailsArray);


           
        }
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();
        if($this->sessionid == "")
        {
            $bgimgSend = $bgimg[0]['bgimgpath'];
            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));
            return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails' =>$uploadDetails,'likeDetailsArrays' =>$likeDetailsArrays));

        }
        else{
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));

            if(@getimagesize($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
             $bgimgSend = $bgimg[0]['bgimgpath'];
            }

                $this->layout()->setVariables(array('sessionid'=> $this->sessionid,'controller' => $controller,'dynamicPath' => $dynamicPath, 'userDetails'=>$userDetails, 'action' => $action,'jsonArray'=>$jsonArray,'userDetails'=>$userDetails,'bgimg'=>$bgimgSend));
            return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails' =>$uploadDetails,'likeDetailsArrays' => $likeDetailsArrays));
        }
    }
    public function fetchallalbumAction(){
        //echo 1;exit;
    	//$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
    	$dynamicPath = $plugin->dynamicPath();
    	$jsonArray = $plugin->jsondynamic(); 
        $uploadQuery = array('UID'=> $this->sessionid);
       // $uploadQuery = array('UID'=> 27);
        $albumValue = $modelPlugin->getalbumdetailsTable()->fetchall($uploadQuery);
       // print_r($albumValue);exit;
        $finalArray = array();
        $finalArrayStatic = array();
        foreach ($albumValue as $albumValueData) {
            $array =  array();
            $albumId = $albumValueData['albumeid'];
            $title = $albumValueData['title'];
            $albumimagepath = $albumValueData['albumimagepath'];
            $uploadQueryUploadTable = array('UID'=> $this->sessionid,'AID'=>$albumId);
            
            $uploadDetails = $modelPlugin->getuploadDetailsTable()->fetchall($uploadQueryUploadTable);
           

            foreach ($uploadDetails as $upload) {

                $array[] = array('uploadId'=>$upload['uploadId'],
                    'UID'=>$upload['UID'],
                    'uploadTitle'=>$upload['uploadTitle'],
                    'uploadType'=>$upload['uploadType'],
                    'uploadPath'=>$upload['uploadPath'],
                    'uploadDescription'=>$upload['uploadDescription']);
            }
            $finalArray[] = array('AID'=>$albumId,
                'title'=>$title,
                'albumimagepath'=>$albumimagepath,
                    'uploadDetails'=>$array);
              
    }
    $uploadQueryUploadTableStaic = array('UID'=> $this->sessionid,'AID'=>1);
    $uploadDetailsforstaticvalue = $modelPlugin->getuploadDetailsTable()->fetchall($uploadQueryUploadTableStaic);
    foreach ($uploadDetailsforstaticvalue as $uploadstatic) {
                $arrayfprstatic = array();

                $arrayfprstatic[] = array('uploadId'=>$uploadstatic['uploadId'],
                    'UID'=>$uploadstatic['UID'],
                    'uploadTitle'=>$uploadstatic['uploadTitle'],
                    'uploadType'=>$uploadstatic['uploadType'],
                    'uploadPath'=>$uploadstatic['uploadPath'],
                    'uploadDescription'=>$uploadstatic['uploadDescription']);
                $finalArrayStatic[] = array('AID'=>1,
                    'uploadDetails'=>$arrayfprstatic);
            }
            

     $res['albumValue'] = $finalArray;
     $res['uploadDetails'] = $finalArrayStatic;
    // print_r($res);exit;
     echo json_encode($res);

        exit;
    }

    public function termsandconditionsAction(){
    	$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();

        if($this->sessionid == ""){

            $bgimgSend = $bgimg[0]['bgimgpath'];
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));

        } else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));

            if(($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
                $bgimgSend = $bgimg[0]['bgimgpath'];
            }
        }

        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath, 'jsonArray'=>$jsonArray, 'userDetails'=>$userDetails, 'bgimg'=>$bgimgSend));
        return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));

    }
    public function aboutusAction(){
    	$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();

        if($this->sessionid == ""){

            $bgimgSend = $bgimg[0]['bgimgpath'];
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));

        } else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));

            if(!empty($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
                $bgimgSend = $bgimg[0]['bgimgpath'];
            }
        }

        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath, 'jsonArray'=>$jsonArray, 'userDetails'=>$userDetails, 'bgimg'=>$bgimgSend));
        return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));

    }
    public function decrypt($data, $key) {
        $decode = base64_decode($data);
        return mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128, $key, $decode, MCRYPT_MODE_CBC, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
        );
    }
    
}
?>

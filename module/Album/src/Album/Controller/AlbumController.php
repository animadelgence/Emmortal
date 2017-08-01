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
        //$value = 'album';
        //$uploadQuery = "uploadType != '$value' && uploadPath IS NOT NULL";
        $uploadQuery = "uploadPath IS NOT NULL";
        //$uploadQuery = array();
        $uploadDetailstemp = $modelPlugin->getuploadDetailsTable()->fetchalldatas($uploadQuery);
        //print_r($uploadDetails);exit;
        $uploadDetails = array();
        $userDetails = '';
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
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();
        
        $idOfUSer    = $this->getEvent()->getRouteMatch()->getParam('id');
        $pidOfUSer    = $this->getEvent()->getRouteMatch()->getParam('pId');
        $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $loggedInUserUniqueId = '';
        if($LoggedInUserDetails) {
            $loggedInUserUniqueId = $LoggedInUserDetails[0]['uniqueUser'];
        }
        if($pidOfUSer) {
            $userDetailsFetch = $modelPlugin->getuserTable()->fetchall(array('forgetpassword'=>$idOfUSer));
           // print_r($userDetailsFetch);exit;
        }
        
        if($idOfUSer && ($userDetailsFetch == ''))
        {
            $bgimgSend = $bgimg[0]['bgimgpath'];
            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'bgimg'=>$bgimgSend));
            return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails' =>$uploadDetails,'likeDetailsArrays' =>$likeDetailsArrays));

        } else if (($idOfUSer != '') && ($userDetailsFetch != '')) {
            $bgimgSend = $bgimg[0]['bgimgpath'];
            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath, 'jsonArray'=>$jsonArray, 'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'bgimg'=>$bgimgSend));
            return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails' =>$uploadDetails,'likeDetailsArrays' =>$likeDetailsArrays));
            
        } else{
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));

            if(@getimagesize($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
             $bgimgSend = $bgimg[0]['bgimgpath'];
            }

                $this->layout()->setVariables(array('sessionid'=> $this->sessionid,'controller' => $controller,'dynamicPath' => $dynamicPath, 'userDetails'=>$userDetails, 'loggedInUserUniqueId'=>$loggedInUserUniqueId,'action' => $action,'jsonArray'=>$jsonArray,'userDetails'=>$userDetails,'bgimg'=>$bgimgSend));
            return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'uploadDetails' =>$uploadDetails,'likeDetailsArrays' => $likeDetailsArrays));
        }
    }
    public function fetchallalbumAction(){
        //echo 1;exit;
    	//$this->layout('layout/albumlayout.phtml');
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
    	$dynamicPath = $plugin->dynamicPath();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
    	$jsonArray = $plugin->jsondynamic(); 
        $idOfUSer    = $this->getEvent()->getRouteMatch()->getParam('id');
        //echo $idOfUSer; exit;
       
        if($idOfUSer == "user") {
            //echo "going inside blank"; exit;
            $uploadQuery = array('UID'=> $this->sessionid);
        } else {
            $Query = array('uniqueUser'=> $idOfUSer);
            $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall($Query);
            $uploadQuery =  array('UID'=> $LoggedInUserDetails[0]['userid']);
        }
         //print_r($uploadQuery);exit;
       // $uploadQuery = array('UID'=> 27);
        $albumValue = $modelPlugin->getalbumdetailsTable()->fetchall($uploadQuery);
        //print_r($albumValue);exit;
        $finalArray = array();
        $finalArrayStatic = array();
        foreach ($albumValue as $albumValueData) {
            $array =  array();
            $albumId = $albumValueData['albumeid'];
            $title = $albumValueData['title'];
            $albumimagepath = $albumValueData['albumimagepath'];
            if($idOfUSer == 'user') {
               $uploadQueryUploadTable = array('UID'=> $this->sessionid,'AID'=>$albumId); 
            } else {
                $Query = array('uniqueUser'=> $idOfUSer);
            $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall($Query);
                $uploadQueryUploadTable = array('UID'=> $LoggedInUserDetails[0]['userid'],'AID'=>$albumId); 
            }
            
            
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
         if($idOfUSer == 'user') {
    $uploadQueryUploadTableStaic = array('UID'=> $this->sessionid,'AID'=>1);
         } else  {
             $Query = array('uniqueUser'=> $idOfUSer);
            $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall($Query);
             $uploadQueryUploadTableStaic = array('UID'=> $LoggedInUserDetails[0]['userid'],'AID'=>1);
         }
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
     //print_r($res);exit;
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

        $idOfUSer    = $this->getEvent()->getRouteMatch()->getParam('id');
        $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $loggedInUserUniqueId = $LoggedInUserDetails[0]['uniqueUser'];
        
        if($idOfUSer){

            $bgimgSend = $bgimg[0]['bgimgpath'];
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));

        } else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));

            if(($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
                $bgimgSend = $bgimg[0]['bgimgpath'];
            }
        }

        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath, 'jsonArray'=>$jsonArray, 'userDetails'=>$userDetails, 'loggedInUserUniqueId'=>$loggedInUserUniqueId,'bgimg'=>$bgimgSend));
        return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray));

    }

    public function redirectuseraccountAction(){
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $albumid =$_POST['albumid'];
        $uploadQuery = array('albumeid'=>$albumid);
        $albumValue = $modelPlugin->getalbumdetailsTable()->fetchall($uploadQuery);
        $idOfUSer = $albumValue[0]['UID'];
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$idOfUSer));
        $loggedInUserUniqueId = $userDetails[0]['uniqueUser'];
        echo $loggedInUserUniqueId;exit;
        

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

        $idOfUSer    = $this->getEvent()->getRouteMatch()->getParam('id');
        $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $loggedInUserUniqueId = $LoggedInUserDetails[0]['uniqueUser'];
        
        if($idOfUSer){

            $bgimgSend = $bgimg[0]['bgimgpath'];
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
            $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));

        } else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));

            if(!empty($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
                $bgimgSend = $bgimg[0]['bgimgpath'];
            }
        }

        $this->layout()->setVariables(array( 'sessionid'=>$this->sessionid,'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'loggedInUserUniqueId'=>$loggedInUserUniqueId, 'jsonArray'=>$jsonArray, 'userDetails'=>$userDetails, 'bgimg'=>$bgimgSend));
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

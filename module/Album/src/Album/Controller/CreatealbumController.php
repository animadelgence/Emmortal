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
    public function saveAlbumDetailsAction() {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $albumTitle = $_POST['albumTitle'];
        $albumPath = $_POST['albumPath'];
        $albumName = $_POST['albumName'];
        $colorselected = $_POST['colorselected'];
        $show = $_POST['show'];
        //echo $albumPath;exit;
        /*$imageFolder = $_POST['imageFolder'];
        $imageName = $_POST['imageName'];
        $pathThumb = $this->resizeImage($imageFolder, $imageName);*/
        if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/uploadimage/' )) {
            @mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/uploadimage/', 0777, true);
            chmod($_SERVER['DOCUMENT_ROOT'] . '/upload/uploadimage/', 0777);
        }
        //chmod($_SERVER['DOCUMENT_ROOT'] . '/public/upload/uploadimage/'.$_POST['imageName'], 0777);
        $imageNewPath = $_SERVER['DOCUMENT_ROOT'] . '/upload/uploadimage/'.$albumName; 
        $imageContent = file_get_contents($albumPath);
        file_put_contents($imageNewPath, $imageContent);
        //print_r($imageContent);
        //exit;
        $imageNewPath1 = $dynamicPath. '/upload/uploadimage/'.$albumName; 
        $imagefriendsId = '';
        $friendsid= '';
        if($_POST['albumfriendsId'])
        {
            $imagefriendsId = $_POST['albumfriendsId'];
            $ct = count($imagefriendsId);
            for($i=0;$i<$ct;$i++){
                $friendsid = $friendsid.$imagefriendsId[$i].',';
            }
        }
        $albumDescription = $_POST['albumDescription'];
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
                            'title'=>$albumTitle,
                            'description'=>$albumDescription,
                            'albumimagepath'=>$imageNewPath1,
                            'color'=>$colorselected,
                            'viewstatus'=>$show,
                            'friendsid' => $friendsid,
                            'creationdate'=>$addeddate
                           
                            );
        $albumDetails = $modelPlugin->getalbumdetailsTable()->insertalbumGetId($uploadQuery);
         $data                  =  array('UID'=>$this->sessionid,
                      'uploadTitle'=>$albumTitle,
                      'uploadDescription'=>$albumDescription,
                      'albumcolor' => $colorselected,
                      'AID'=>$albumDetails,
                      'FID'=>$friendsid,
                      'TimeStamp'=>$addeddate,
                      'uploadPath'=> $imageNewPath1,
                      'uploadType'=>'album',
                      'PID'=>$currentPageId,

                      );
           $albumDetailsforupload         = $modelPlugin->getuploadDetailsTable()->insertData($data);
        if($albumDetails)
        {
            $result = base64_encode($albumDetails);
        }
        echo $result; exit;
    }
    public function showafterpublishAction(){
        $this->layout('layout/albumlayout.phtml');
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $controller = 'createalbum';
        $action = $this->params('action');
        $geturlid = $this->params('id');
        $getid = base64_decode($geturlid);
        $LoggedInUserDetails = $this->params('pid');
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();
        if($LoggedInUserDetails != ""){
            $uploadQuery =  array('albumeid' =>$getid );
        }else{
            $uploadQuery =  array('UID'=> $this->sessionid,'albumeid' =>$getid );
        }
        
        $albumDetails = $modelPlugin->getalbumdetailsTable()->fetchall($uploadQuery);
        //print_r($albumDetails);exit;
        $friendsArray = explode(',',$albumDetails[0]['friendsid']);
        $userid = $this->sessionid;
        $friendsDetails = array();
        //$userDetails = '';
        if($LoggedInUserDetails==""){
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        } else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$LoggedInUserDetails));
        }
         
         $loggedInUserUniqueId = $userDetails[0]['userid'];
        for ($i=0; $i < count($friendsArray)-1; $i++) { 
            
            $frndid = $friendsArray[$i];
             if($LoggedInUserDetails != ""){
                $condition     = array('friends.userid'=>$loggedInUserUniqueId,'friends.friendsid'=>$frndid);
            } else{
            $condition     = array('friends.userid'=>$userid,'friends.friendsid'=>$frndid);
        }
            $join    = "friends.friendsid = user.userid";
            //$getfriendsdetails = $modelPlugin->getfriendsTable()->joinquery($condition,$join);
            $getfriendsdetails = $modelPlugin->getfriendsTable()->joinquery($condition,$join);
           // print_r($getfriendsdetails);
             $array = array(
                    'friendsid'     => $getfriendsdetails[0]['friendsid'],
                    'friendsname'   => $getfriendsdetails[0]['firstname']." ".$getfriendsdetails[0]['lastname'],
                    'profileimage'  => $getfriendsdetails[0]['profileimage']
                    
                );
             $friendsDetailsArray = $array;
             //print_r($friendsDetailsArray);
             array_push($friendsDetails, $friendsDetailsArray);
        }
        //print_r($friendsDetails);
//exit;
        $idOfUSer    = $this->getEvent()->getRouteMatch()->getParam('id');
        $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $loggedInUserUniqueId = '';
        if($LoggedInUserDetails) {
            $loggedInUserUniqueId = $LoggedInUserDetails[0]['uniqueUser'];
        }
        
        if($idOfUSer) {
             $bgimgSend = $bgimg[0]['bgimgpath'];
            //  $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));
            // return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'userDetails' =>$userDetails));

             $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend,'sessionid'=>$this->sessionid));

            return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'albumDetails' =>$albumDetails,'friendsDetails'=>$friendsDetails,'getid'=>$getid));

        } else {
              if($LoggedInUserDetails != ""){
                $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$idOfUSer));

             }
                else{
                    $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
                }

            if(@getimagesize($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
             $bgimgSend = $bgimg[0]['bgimgpath'];
            }
            if(empty($this->sessionid)){
                $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));
                
            }
            else {
                 $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend,'sessionid'=>$this->sessionid));
            }
             
            return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'albumDetails' =>$albumDetails,'friendsDetails'=>$friendsDetails,'getid'=>$getid));
        }
       
    }

    public function showafterpublishforstaticAction(){
       $this->layout('layout/albumlayout.phtml');
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $controller = 'createalbum';
        $action = $this->params('action');
        $geturlid = $this->params('id');
        $getid = base64_decode($geturlid);
        $LoggedInUserDetails = $this->params('pid');
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();
        if($LoggedInUserDetails != ""){
            $uploadQuery =  array('albumeid' =>1 );
        }else{
            $uploadQuery =  array('albumeid' =>1 );
        }
        
        $albumDetails = $modelPlugin->getalbumdetailsTable()->fetchall($uploadQuery);
        //print_r($albumDetails);exit;
        $friendsArray = explode(',',$albumDetails[0]['friendsid']);
        $userid = $this->sessionid;
        $friendsDetails = array();
        //$userDetails = '';
        if($LoggedInUserDetails==""){
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        } else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$LoggedInUserDetails));
        }
         
         $loggedInUserUniqueId = $userDetails[0]['userid'];
        for ($i=0; $i < count($friendsArray)-1; $i++) { 
            
            $frndid = $friendsArray[$i];
             if($LoggedInUserDetails != ""){
                $condition     = array('friends.userid'=>$loggedInUserUniqueId,'friends.friendsid'=>$frndid);
            } else{
            $condition     = array('friends.userid'=>$userid,'friends.friendsid'=>$frndid);
        }
            $join    = "friends.friendsid = user.userid";
            //$getfriendsdetails = $modelPlugin->getfriendsTable()->joinquery($condition,$join);
            $getfriendsdetails = $modelPlugin->getfriendsTable()->joinquery($condition,$join);
           // print_r($getfriendsdetails);
             $array = array(
                    'friendsid'     => $getfriendsdetails[0]['friendsid'],
                    'friendsname'   => $getfriendsdetails[0]['firstname']." ".$getfriendsdetails[0]['lastname'],
                    'profileimage'  => $getfriendsdetails[0]['profileimage']
                    
                );
             $friendsDetailsArray = $array;
             //print_r($friendsDetailsArray);
             array_push($friendsDetails, $friendsDetailsArray);
        }
        //print_r($friendsDetails);
//exit;
        $idOfUSer    = $this->getEvent()->getRouteMatch()->getParam('id');
        $LoggedInUserDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $loggedInUserUniqueId = '';
        if($LoggedInUserDetails) {
            $loggedInUserUniqueId = $LoggedInUserDetails[0]['uniqueUser'];
        }
        
        if($idOfUSer) {
             $bgimgSend = $bgimg[0]['bgimgpath'];
            //  $this->layout()->setVariables(array('sessionid'=> "",'controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));
            // return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'userDetails' =>$userDetails));

             $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend,'sessionid'=>$this->sessionid));

            return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'albumDetails' =>$albumDetails,'friendsDetails'=>$friendsDetails,'getid'=>$getid));

        } else {
              if($LoggedInUserDetails != ""){
                $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$idOfUSer));

             }
                else{
                    $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
                }

            if(@getimagesize($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
             $bgimgSend = $bgimg[0]['bgimgpath'];
            }
            if(empty($this->sessionid)){
                $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend));
                
            }
            else {
                 $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath,'userDetails'=>$userDetails,'loggedInUserUniqueId'=>$loggedInUserUniqueId,'jsonArray'=>$jsonArray,'bgimg'=>$bgimgSend,'sessionid'=>$this->sessionid));
            }
             
            return new ViewModel(array('sessionid'=>$this->sessionid,'dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'albumDetails' =>$albumDetails,'friendsDetails'=>$friendsDetails,'getid'=>$getid));
        }
       
    }
   
    
}
?>

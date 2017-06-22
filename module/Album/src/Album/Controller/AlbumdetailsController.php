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

class AlbumdetailsController extends AbstractActionController {
    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath. "/album/showalbum");
            exit;
        }
    }
    public function albumpageAction(){
    	$this->layout('layout/albumlayout.phtml');
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $this->layout()->setVariables(array('controller' => $controller, 'action' => $action));
        $query = array('albumeid'=>1);
        $albumDetails = $modelPlugin->getalbumdetailsTable()->fetchall($query);
        $where = array('AID'=>1);
        $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($where);
        $uploadDetails = $modelPlugin->getuploadDetailsTable()->fetchall($where);
        //print_r($uploadDetails); exit;
        $likeCount = count($likeDetails);
        return new ViewModel(array('dynamicPath' => $dynamicPath,'jsonArray'=>$jsonArray,'albumDetails'=>$albumDetails,'likeCount'=>$likeCount,'uploadDetails'=>$uploadDetails));
    }
    public function likesaveAction(){
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $type = $_POST['datacmd'];
        $id = $_POST['id'];
        $UID = $this->sessionid;
        if($type == 'album'){
            $where = array('AID'=>$id,'UID'=>$UID);
            $data = array(
                'AID'=>$id,
                'UID'=>$UID,
                'likedate'=> date("Y-m-d H:i:s")
            );
            $query = array('AID'=>$id);
        } else if($type == 'tribute'){
            $where = array('TID'=>$id,'UID'=>$UID);
            $data = array(
                'TID'=>$id,
                'UID'=>$UID,
                'likedate'=> date("Y-m-d H:i:s")
            );
            $query = array('TID'=>$id);
        } else{
            $where = array('uploadId'=>$id,'UID'=>$UID);
            $data = array(
                'uploadId'=>$id,
                'UID'=>$UID,
                'likedate'=> date("Y-m-d H:i:s")
            );
            $query = array('uploadId'=>$id);
        }
        $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($where);
        if(count($likeDetails)>0){
            $likeDelete = $modelPlugin->getlikesdetailsTable()->deleteLike($where);
        } else{
            $likeInsert = $modelPlugin->getlikesdetailsTable()->insertLike($data);
        }
        $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($query);
        echo $likeCount = count($likeDetails);
        exit;
    }
    public function getuploadAction(){
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $uploadId = $_POST['uploadId'];
        $where = array("uploadId"=>$uploadId);
        $uploadDetails = $modelPlugin->getuploadDetailsTable()->joinquery($uploadId);
        $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($where);
        $likeCount = count($likeDetails);
        $array = array();
        foreach ($uploadDetails as $rSet) {
            $hr = date("H",strtotime($rSet['TimeStamp']));
            $min = date("i",strtotime($rSet['TimeStamp']));
            if($hr>=12){
                $hr = $hr - 12;
                $time = $hr.":".$min."PM";
            } else{
                $time = date("H:i",strtotime($rSet['TimeStamp']))."AM";
            }
            $array[] = array(
                'uploadTitle' => $rSet['uploadTitle'],
                'uploadDescription' => $rSet['uploadDescription'],
                'uploadPath' => $rSet['uploadPath'],
                'dateTime' => date("m/d/Y",strtotime($rSet['TimeStamp']))." ".$time,
                'username' => $rSet['firstname']." ".$rSet['lastname'],
                'userid'=>$rSet['userid'],
                'likeCount'=>$likeCount
            );
          }
        $res['uploadDetails'] = $array;
        echo json_encode($res);
        exit;
    }
}
?>

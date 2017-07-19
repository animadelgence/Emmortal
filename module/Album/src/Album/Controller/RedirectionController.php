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

class RedirectionController extends AbstractActionController {
    public function __construct() {
        $userSession        = new Container('userloginId');
        $this->sessionid    = $userSession->offsetGet('userloginId');
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     //header("Location:" . $dynamicPath. "/album/showalbum");
        //     header("Location:" . $dynamicPath);
        //     exit;
        // }
    }
    public function redirectuserdetailsAction(){
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $userId = $_POST['userid'];
        if(empty($userId)) {
            $userId = $this->sessionid;
                            $userDetailsTemp = $modelPlugin->getuserTable()->fetchall(array('userid'=>$userId));
            $userId = $userDetailsTemp[0]['uniqueUser'];
        }
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$userId));
        if($userId == 'user') {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=> $this->sessionid));
        }
        else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$userId));
        }
        $UserUniqueId = $userDetails[0]['userid'];
        $result['sessionid'] = $this->sessionid;
        $result['tempuserid'] = $UserUniqueId;
        echo json_encode($result);exit;

    }
    public function searchrelationshipAction(){
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $query = $_POST['tempuserid'];
        //echo $query; exit;
        $where = array('userid' => $query, 'requestaccept' => 1);
        $userdetails = $modelPlugin->getfriendsTable()->fetchall($where);
        $whereSecond = array('friendsid' => $query, 'requestaccept' => 1);
        $userdetailsSecond = $modelPlugin->getfriendsTable()->fetchall($whereSecond);
        //print_r($userdetailsSecond); exit;
        $array = array();
        $result = array_merge($userdetails,$userdetailsSecond);
        //print_r($result); exit;
        foreach ($result as $rSet) {
            if($rSet['userid'] == $query){
                $resultid = $rSet['friendsid'];
            } else {
                 $resultid = $rSet['userid'];
            }

            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$resultid));
            //print_r($userDetails);
            $where = array(
                    'UID' => $resultid
                );
            $friendlikes = count($modelPlugin->getlikesdetailsTable()->fetchall($where));
            $noOfTributes = count($modelPlugin->gettributedetailsTable()->fetchall($where));

            $array[] = array(
                'friendsid'     => $rSet['friendsid'],
                'friendsname'   => $userDetails[0]['firstname']." ".$userDetails[0]['lastname'],
                'profileimage'  => $userDetails[0]['profileimage'],
                'uniqueUser'  => $userDetails[0]['uniqueUser'],
                'friendslikes'  => $friendlikes,
                'noOfTributes'  => $noOfTributes
            );
           // print_r($array); exit;
        }//exit;
        $res['userDetails'] = $array;
        //print_r($res['userDetails']);exit;
        echo json_encode($res);
        exit;
    }

    public function tributesearchAction(){
        //echo 1; exit;
        $plugin                     = $this->routeplugin();
        $modelPlugin                = $this->modelplugin();
        $dynamicPath                = $plugin->dynamicPath();
        $jsonArray                  = $plugin->jsondynamic();
        $currentPageURL             = $plugin->curPageURL();
        $href                       = explode("/", $currentPageURL);
        $controller                 = @$href[3];
        $action                     = @$href[4];
//        $uniqueId                   = $_POST['uniqueUserId'];
        $uniqueId    = $this->getEvent()->getRouteMatch()->getParam('id');
        //echo $uniqueId; exit;
        $where       = array('uniqueUser' => $uniqueId);
        $fetchUserDetails = $modelPlugin->getuserTable()->fetchall($where);
        $userId = $fetchUserDetails[0]['userid'];
        //echo $userId ; exit;
        //$userid = $this->sessionid;
        $count = 0;
        $where = array();
        $condition = 'user.userid = tributedetails.UID';
        $fetchDetails = $modelPlugin->gettributedetailsTable()->joinquery($where,$condition);
        //print_r($fetchDetails); exit;
        $tributeType = $fetchDetails[0]['tribute_type'];
        //print_r($fetchDetails); exit;
        $array = array();
        foreach ($fetchDetails as $result){
            if($tributeType == 'friend'){
                count++;
                echo "going inside friend [1st condition]";
                if($fetchDetails[0]['friendsid'] == $uniqueId){
                    $where          = array('TID'=>$rSet['tributesid']);
                    $likeDetails    = $modelPlugin->getlikesdetailsTable()->fetchall($where);
                    $array[]     = array(
                                         'tributesid' => $fetchDetails[0]['tributesid'],
                                         'UID' => $fetchDetails[0]['UID'], // this is wrong...change it
                                         'friendsname' => $fetchDetails[0]['firstname']." ".$fetchDetails[0]['lastname'],
                                         'profileimage'=>$fetchDetails[0]['profileimage'],
                                         'description'=>$fetchDetails[0]['description'],
                                         'friendsid'=>$fetchDetails[0]['friendsid'],
                                         'like'=>$like,
                                         'addeddate'=>date("m/d/Y",strtotime($fetchDetails[0]['addeddate']))
                                    );

                }
            }

            else if($tributeType == 'album'){
                count++;

                //--LIKE COUNT (start)--//
//                $whereLike         = array('TID'=>$rSet['tributesid']);
//                $likeDetails    = $modelPlugin->getlikesdetailsTable()->fetchall($whereLike);
//                $like           = count($likeDetails);
                //--LIKE COUNT (end)--//

                    $whereAlbum = array('albumeid' => $result['uploadId']);
                    $AlbumDet = $modelPlugin->getalbumdetailsTable()->fetchall($whereAlbum);

                    if(($AlbumDet[0]['UID'] == $userId) && ($AlbumDet[0]['UID'] != $result['UID'])){

                        $array[]     = array(
                                         'tributesid' => $result['tributesid'],
                                         'friendsname' => $result['firstname']." ".$result['lastname'],
                                         'profileimage'=>$result['profileimage'],
                                         'description'=>$result['description'],
                                         'friendsid'=>$result['friendsid'],
                                         //'like'=>$like,
                                         'addeddate'=>date("m/d/Y",strtotime($result['addeddate']))
                                    );

                    } //if within elseif
             }//elseif
             else if($tributeType == 'relationship'){
                 count++;
                 if($result['friendsid'] == $userId){
                     $array[]     = array(
                                         'tributesid' => $result['tributesid'],
                                         'friendsname' => $result['firstname']." ".$result['lastname'],
                                         'profileimage'=>$result['profileimage'],
                                         'description'=>$result['description'],
                                         'friendsid'=>$result['friendsid'],
                                         //'like'=>$like,
                                         'addeddate'=>date("m/d/Y",strtotime($result['addeddate']))
                                    );

                 } //if within elseif
             }//elseif
             else if($tributeType == 'upload'){
                 count++;

                   //--LIKE COUNT (start)--//
//                $whereLike         = array('TID'=>$rSet['tributesid']);
//                $likeDetails    = $modelPlugin->getlikesdetailsTable()->fetchall($whereLike);
//                $like           = count($likeDetails);
                //--LIKE COUNT (end)--//

                 $whereUpload = array('uploadId' => $result['uploadId']);
                    $uploadDet = $modelPlugin->getuploadDetailsTable()->fetchall($whereUpload);

                    if(($uploadDet[0]['UID'] == $userId) && ($uploadDet[0]['UID'] != $result['UID'])){

                        $array[]     = array(
                                         'tributesid' => $result['tributesid'],
                                         'friendsname' => $result['firstname']." ".$result['lastname'],
                                         'profileimage'=>$result['profileimage'],
                                         'description'=>$result['description'],
                                         'friendsid'=>$result['friendsid'],
                                         //'like'=>$like,
                                         'addeddate'=>date("m/d/Y",strtotime($result['addeddate']))
                                    );


             }
        }//foreach


        $res['tributeDetails']      = $array;
        echo json_encode($res);
        echo json_encode($count);
        exit;
    }

}

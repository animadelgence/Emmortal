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
        $jsonArray   = $plugin->jsondynamic();
        $controller  = 'redirection';
        $action      = $this->params('action');
        $uniqueUser  = $this->getEvent()->getRouteMatch()->getParam('id');
        //echo $uniqueUser; exit;
        $bgimg       = $modelPlugin->getbgimageTable()->fetchall();
        //$sessionId   = $this->sessionid;
        $loggedInUserDetails    = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $loggedInUserId   = $loggedInUserDetails[0]['userid'];
        //$loggedInUserUniqueId   = $loggedInUserDetails[0]['uniqueUser'];

        //$user        = $modelPlugin->getuserTable()->fetchall(array('userid'=>$sessionId));
//        $firstname   = $user[0]['firstname'];
        //$userId = $_POST['userid'];

//        if($uniqueUser == $loggedInUserUniqueId) {
//            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=> $this->sessionid));
//        }
//        else {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$uniqueUser));
        //print_r($userDetails); exit;
//        }

        $uniqueUserId = $userDetails[0]['userid']; // $UserUniqueId tempuserid
        if(@getimagesize($userDetails[0]['backgroundimage'])){
            $bgimgSend          = $userDetails[0]['backgroundimage'];
        } else{
            $bgimgSend          = $bgimg[0]['bgimgpath'];
        }

        $where = array('userid' => $uniqueUserId, 'requestaccept' => 1);
        $userdetails = $modelPlugin->getfriendsTable()->fetchall($where);
        $whereSecond = array('friendsid' => $uniqueUserId, 'requestaccept' => 1);
        $userdetailsSecond = $modelPlugin->getfriendsTable()->fetchall($whereSecond);

        $array = array();
        $result = array_merge($userdetails,$userdetailsSecond);
        foreach ($result as $rSet) {
            if($rSet['userid'] == $uniqueUserId){
                $resultid = $rSet['friendsid'];
            } else {
                 $resultid = $rSet['userid'];
            }
//        foreach ($result as $rSet) {
//            if($rSet['userid'] == $sessionId){ //check here
//                $resultid = $rSet['userid'];
//            } else {
//                $resultid = $rSet['friendsid'];
//            }
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$resultid));

        $array[] = array(
                'friendsid'     => $rSet['friendsid'],
                'friendsname'   => $userDetails[0]['firstname']." ".$userDetails[0]['lastname'],
                'profileimage'  => $userDetails[0]['profileimage'],
                'uniqueUser'  => $userDetails[0]['uniqueUser']
            );

        }//exit;

        $relationships = $array;
        //print_r($relationships); exit;

        $this->layout()->setVariables(array(
                                            'controller' => $controller,
                                            'action' => $action,
                                            'dynamicPath' => $dynamicPath,
                                            'userDetails'=>$userDetails,
                                            'loggedInUserId'=>$loggedInUserId,
                                            'jsonArray'=>$jsonArray,
                                            'bgimg'=>$bgimgSend,
                                            'sessionid'=>$this->sessionid
                                        )
                                     );

        return new ViewModel(array(
                                'userDetails' => $userDetails,
                                'dynamicPath' => $dynamicPath,
                                'jsonArray'=>$jsonArray,
                                'relationships' =>$relationships,
                                )
                            );

        //$res['userDetails'] = $array;

//        $result['sessionid'] = $this->sessionid;
//        $result['tempuserid'] = $UserUniqueId;
//        echo json_encode($result);exit;
        
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
//    public function relationshipsAction(){
//        $this->layout('layout/albumlayout.phtml');
//        $plugin = $this->routeplugin();
//        $modelPlugin = $this->modelplugin();
//        $dynamicPath = $plugin->dynamicPath();
//        $uniqueUser  = $this->getEvent()->getRouteMatch()->getParam('id');
//        $bgimg                  = $modelPlugin->getbgimageTable()->fetchall();
//        $userDetails            = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$uniqueUser));
//        $loggedInUserDetails    = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
//        if(@getimagesize($userDetails[0]['backgroundimage'])){
//            $bgimgSend          = $userDetails[0]['backgroundimage'];
//        } else{
//            $bgimgSend          = $bgimg[0]['bgimgpath'];
//        }
//
//
//    }
//    public function myrelationsAction(){
//        $this->layout('layout/albumlayout.phtml');
//        $plugin = $this->routeplugin();
//        $modelPlugin = $this->modelplugin();
//        $dynamicPath = $plugin->dynamicPath();
//        $uniqueUser  = $this->getEvent()->getRouteMatch()->getParam('id');
//        $bgimg                  = $modelPlugin->getbgimageTable()->fetchall();
//        $userDetails            = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$uniqueUser));
//        $loggedInUserDetails    = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
//        if(@getimagesize($userDetails[0]['backgroundimage'])){
//            $bgimgSend          = $userDetails[0]['backgroundimage'];
//        } else{
//            $bgimgSend          = $bgimg[0]['bgimgpath'];
//        }
//
//
//    }

}

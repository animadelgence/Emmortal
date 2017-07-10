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
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$userId));
        $UserUniqueId = $userDetails[0]['userid'];
        $result['sessionid'] = $this->sessionid;
        $result['tempuserid'] = $UserUniqueId;
        echo json_encode($result);exit;
        
    }
    public function searchrelationshipAction(){
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $query = $_POST['tempuserid'];
        $where = array('userid' => $query, 'requestaccept' => 1);
        $userdetails = $modelPlugin->getfriendsTable()->fetchall($where);
        $whereSecond = array('friendsid' => $query, 'requestaccept' => 1);
        $userdetailsSecond = $modelPlugin->getfriendsTable()->fetchall($whereSecond);
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
            /*$where = array(
                    'UID' => $resultid
                );
            $friendlikes = count($modelPlugin->getlikesdetailsTable()->fetchall($where));
            $noOfTributes = count($modelPlugin->gettributedetailsTable()->fetchall($where));
*/
            $array[] = array(
                'friendsid'     => $rSet['friendsid'],
                'friendsname'   => $userDetails[0]['firstname']." ".$userDetails[0]['lastname'],
                'profileimage'  => $userDetails[0]['profileimage'],
                'uniqueUser'  => $userDetails[0]['uniqueUser']
                /*'friendslikes'  => $friendlikes,
                'noOfTributes'  => $noOfTributes,*/
            );
        }//exit;
        $res['userDetails'] = $array;
        //print_r($res);exit;
        echo json_encode($res);
        exit;
    }
}
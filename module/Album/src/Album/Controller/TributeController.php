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

class TributeController extends AbstractActionController {
   public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     header("Location:" . $dynamicPath. "/profile/showprofile");
        //     exit;
        // }
    }
    public function tributesubmitAction(){
        $plugin                     = $this->routeplugin();
        $modelPlugin                = $this->modelplugin();
        $dynamicPath                = $plugin->dynamicPath();
        $tributeDescription         = $_POST['tributeDescription'];
        $frndIdValue                = $_POST['frndId'];
        if($frndIdValue){
           $friendId                =  implode(",",$frndIdValue);
            } else{
              $friendId = "";
            }
           // echo $friendId;exit;
        $UID                        = $this->sessionid;
        $addeddate                  = date('Y-m-d H:i:s');
        $data                       =  array('UID'=>$UID,
                      'description'=>$tributeDescription,
                      'friendsid'=>$friendId,
                      'addeddate'=>$addeddate

                      );
        $tributeDetails             = $modelPlugin->gettributedetailsTable()->insertData($data);
        if($tributeDetails == 1){
            return $this->redirect()->toUrl($dynamicPath . "/album/showalbum");
        }


    }
}
?>
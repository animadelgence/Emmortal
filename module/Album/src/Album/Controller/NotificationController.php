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

class NotificationController extends AbstractActionController {
    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     //header("Location:" . $dynamicPath. "/album/showalbum");
        //     header("Location:" . $dynamicPath);
        //     exit;
        // }
    }
    public function getnotificationAction(){
        $plugin                 = $this->routeplugin();
        $modelPlugin            = $this->modelplugin();
        $dynamicPath            = $plugin->dynamicPath();
        $jsonArray              = $plugin->jsondynamic();
        $UID                    = $this->sessionid;
        $condition              = array('UID'=>$UID,'notify_seen'=>0);
        $notificationDetails    = $modelPlugin->getnotificationdetailsTable()->fetchall($condition);
        $array                  = array();
        echo "<pre/>";
        print_r($notificationDetails); exit();
        foreach ($notificationDetails as $rSet) {
            $notificationid = $rSet['notificationid'];
            $notified_by    = $rSet['notified_by'];
            $notify_id      = $rSet['notify_id'];
            $notify_type    = $rSet['notify_type'];
            $html           = "";
            if($notify_type == 'like'){
                $likecon                = array('likeid'=>$notify_id);
                $notificationDetails    = $modelPlugin->getlikesdetailsTable()->fetchall($condition);
                $html .="";
            } else if($notify_type == 'friendrequest'){
            } else if($notify_type == 'album'){
            } else if($notify_type == 'upload'){
            }
            $array[] = array(
                'notificationid' => $notificationid,
                'notified_by' => $notified_by,
                'notify_id' => $notify_id,
                'notify_type'=>$notify_type
            );
          }
        print_r($array); exit();
        $res['uploadDetails'] = $array;
        echo json_encode($res);
        exit;
    }
}
?>

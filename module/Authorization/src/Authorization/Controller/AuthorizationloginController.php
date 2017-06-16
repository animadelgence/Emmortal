<?php

/*
 * @Author: Maitrayee 
 * @Date:   2017-02-2 16:46:35
 * @Last Modified by: Maitrayee
 * @Last Modified time: 2017-04-25 12:52:26
 * @version : 1.0.0
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace Authorization\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\PhpEnvironment\Request;
use Zend\Session\Container;

class AuthorizationloginController extends AbstractActionController {

    
    public function loginAction() {
        echo "welcome from  authorization";exit;

    }
    public function mailsendAction(){
 //echo "welcome from  authorization fdghfdhfgh";exit;
    		$mailplugin = $this->mailplugin();
    		$plugin = $this->routeplugin();
    		$jsonArray = $plugin->jsondynamic();
            $dynamicPath = $plugin->dynamicPath();
            //echo $dynamicPath;exit;
    		//$email = 'maitrayeedelgence@gmail.com';
    		$email = 'anima.adhikary@delgence.com';
            $mailBody = '<div class="container" style="width: 50%; margin-left: auto; margin-right: auto; font-family: verdana;"><div class="header" style="background-color: #B2AA93; padding: 2px; text-align: center; color: #fff;"><h3 style="font-size: 13px;">Emmortal</h3></div><div class="text-content" style="padding: 15px;"><p style="font-size: 13px;">Welcome on Emmortal, <span style="font-weight: 600;">Anima Adhikary</span></p><p style="font-size: 13px;">Before you start using Emmortal , you need to confirm your email address.
                Click the link below: </p><a class="confirm-link" href="#" style="text-decoration: none;">
                <div class="btn" style="width: 125px; padding: 12px 11px; background-color: #579942; border-radius: 5px; color: #fff; font-size: 14px; margin-top: 46px !important;">Confirm Email</div></a><p style="font-size: 13px;">Best, your Emmortal Team</p></div></div>';
            $subject = "Confirm your email address";
            $from = $jsonArray['sendgridaccount']['addfrom'];
           // echo $from;exit;
        	$mailfunction = $mailplugin->confirmationmail($email, $from, $subject, $mailBody);
        	echo $mailfunction;exit;
        	
    }
    
}

?>

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

     protected $sessionid;

    public function __construct() {

        $userSession = new Container('loginId');
        $this->sessionid = $userSession->offsetGet('loginId');
        $userSessionTemp = new Container('tempStore');
        $this->sessionidtemp = $userSessionTemp->offsetGet('tempStore');
        /*$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath);
            exit;
        }*/
    }
    
    public function loginAction() {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
    	$loginemail = $_POST['loginemail'];
    	$loginpassword = $_POST['loginpassword'];
        $dataarrayforvalidation = array('emailid' => $loginemail);
        $contentDetails = $modelPlugin->getuserTable()->fetchall($dataarrayforvalidation);
        $usid = $contentDetails[0]['userid'];
        $value ='';

        $passcheck = password_verify($loginpassword, $contentDetails[0]['password']);

      	if($passcheck == 1 && $contentDetails[0]['activation'] == 1)
        {
        	$value['activationstatus'] = "live"; 
            $value['uniqueId'] = $contentDetails[0]['uniqueUser'];
            $user_session = new Container('userloginId');
            $user_session->userloginId = $usid;
            $user_session_temp = new Container('tempStoreName');
            $user_session_temp->tempStoreName = 'showMessage';
        }
        else if($passcheck == 1 && $contentDetails[0]['activation'] == 0)
        {
        	$value['activationstatus'] = "not activate";   
        	$value['uniqueId'] = $contentDetails[0]['uniqueUser'];
        }
        else if($passcheck == 0 && $contentDetails[0]['activation'] == 0)
        {
        	$value['activationstatus'] = "deactivate";  
        	$value['uniqueId'] = $contentDetails[0]['uniqueUser'];
        }
        	echo json_encode($value);
        	exit;

    }
    public function recoverAction(){
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $mailplugin = $this->mailplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();

        $recoveryemail = $_POST['recoveryemail'];
        $dataarrayforvalidation = array('emailid' => $recoveryemail);
        $contentDetails = $modelPlugin->getuserTable()->fetchall($dataarrayforvalidation);
        $id = $contentDetails[0]["userid"];
        //echo $id;exit;
        $fullname = $contentDetails[0]['firstname']." ".$contentDetails[0]['lastname'];
        $pass = password_hash($recoveryemail, PASSWORD_BCRYPT);
        $arraypass = str_replace('/', '', $pass);
        //echo $arraypass;exit;
        $buttonclick = $dynamicPath . "/album/showalbum/resetpassword/" . $arraypass;
        //echo $buttonclick;exit;
        $mail_link = "<a class='confirm-link' href='".$buttonclick."' style='text-decoration: none;'><div class='btn' style='width: 125px; padding: 12px 11px; background-color: #579942; border-radius: 5px; color: #fff; font-size: 14px; margin-top: 46px !important;'>Reset password</div></a>";
        $subject = "[Emmortal] Set your password";
        $from = $jsonArray['sendgridaccount']['addfrom'];
        $keyArray = array('mailCatagory' => 'F_MAIL');
        $getMailStructure = $modelPlugin->getmailconfirmationTable()->fetchall($keyArray);
        //print_r($getMailStructure);exit;
        $getmailbodyFromTable = $getMailStructure[0]['mailTemplate'];
        $mailLinkreplace = str_replace("|RECOVERYLINK|", $mail_link, $getmailbodyFromTable);
        $mailBody = str_replace("|FULLNAME|", $fullname, $mailLinkreplace);
        //print_r($mailBody);exit;
        $keyArray = array('userid' => $id);
        $dataForForget = array('forgetpassword' => $arraypass,'forgetPassloginTime' => date('Y-m-d'));
        //print_r($dataForForget);exit;
        $updateUser = $modelPlugin->getuserTable()->updateuser($dataForForget, $keyArray);
        $fogetPasswordMail = $mailplugin->confirmationmail($recoveryemail, $from, $subject, $mailBody);
       
        

        echo $updateUser;exit;
    }
    public function resetpasswordAction(){
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $encryptedmailid = $_POST['encryptedmailid'];
        //echo $encryptedmailid;exit;
        //echo $_POST['forgetpassword'];exit;
        $forgetpassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        ////$key = '1234547890183420';
       // $decryptedmail = $this->decrypt($encryptedmailid, $key);
        $dataarrayforvalidation = array('forgetpassword' => $encryptedmailid);
        $contentDetails = $modelPlugin->getuserTable()->fetchall($dataarrayforvalidation);
        $id = $contentDetails[0]["userid"];
        if($id) {
            $user_session = new Container('userloginId');
            $user_session->userloginId = $id;
            $user_session_temp = new Container('tempStoreName');
            $user_session_temp->tempStoreName = 'showMessage';
        }
        $keyArray = array('userid' => $id);
        $dataForForget = array('password' => $forgetpassword,'forgetpassword' => '');
        $updateUser = $modelPlugin->getuserTable()->updateuser($dataForForget, $keyArray);

        echo $updateUser;exit;

    }
     public function decrypt($data, $key) {
        $decode = base64_decode($data);
        return mcrypt_decrypt(
                MCRYPT_RIJNDAEL_128, $key, $decode, MCRYPT_MODE_CBC, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
        );
    }
    
    
}

?>

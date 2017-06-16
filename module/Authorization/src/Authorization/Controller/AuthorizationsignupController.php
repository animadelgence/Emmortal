<?php

/*
 * @Author: Maitrayee 
 * @Date:   2017-05-14 11:46:35
 * @Last Modified by: Maitrayee
 * @Last Modified time: 2017-05-15 12:11:26
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

class AuthorizationsignupController extends AbstractActionController {

    
    public function signupAction() {
        //echo "welcome from  authorizationsignup";exit;
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $getpassword =$_POST['password']; 
        $password = password_hash($getpassword, PASSWORD_BCRYPT); 
        $dob = $_POST['dob'];
        //echo $firstName ."||".$lastName."||".$email."||".$getpassword."||".$password."||".$dob;exit;
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $mailplugin = $this->mailplugin();
        $dynamicPath = $plugin->dynamicPath();
        //echo $dynamicPath;exit;
        $jsonArray = $plugin->jsondynamic();
      
        $keyArray = array('emailid'=>$email);

        $insertedArray = array('emailid' => $email, 'password' => $password, 'firstname' => $firstName, 'lastname' => $lastName,'signindate' => date('Y-m-d'));
        //print_r($insertedArray);exit;
        $albumFolder = $modelPlugin->getuserTable()->savedata($insertedArray,$keyArray);
        print_r($albumFolder);exit;
        $albumDetails = $modelPlugin->getuserTable()->fetchall($keyArray);
        $usid= $albumDetails[0]['userid'];
        if($albumFolder == 1)
        {
        	
        	$key = '1234547890183420';
            $encrypted = $this->encrypt($usid, $key);
        	$buttonclick = $dynamicPath . "/album/showalbum/" . $encrypted;
            //$activationLink = "<a href='".$buttonclick."' style='margin: 0; outline: none; padding: 15px; color: #ffffff; background-color: #04ad6a; border: 0px solid #919191; border-radius: 6px; font-family: Arial; font-size: 16px; display: inline-block; line-height: 1.1; text-align: center; text-decoration: none;'>Click here to activate</a>";
            $activationlink = "<a href='".$buttonclick."' style='font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;box-sizing:border-box;font-size:14px;color:#fff;text-decoration:none;line-height:2em;font-weight:bold;text-align:center;display:inline-block;border-radius:5px;text-transform:capitalize;background-color:#579942;margin:0;border-color:#579942;border-style:solid;border-width:10px 20px'>Confirm email</a>";
            $searchArray = array('mailCatagory' => 'C_MAIL');
            $getMailStructure = $modelPlugin->getmailconfirmationTable()->fetchall($searchArray);
            $getmailbodyFromTable = $getMailStructure[0]['mailTemplate'];
            $activationLinkreplace = str_replace("|ACTIVATIONLINK|", $activationLink, $getmailbodyFromTable);
            $mailBody = str_replace("|DYNAMICPATH|", $dynamicPath, $activationLinkreplace);
            $subject = "Confirm your email address";
            $from = $jsonArray['sendgridaccount']['addfrom'];
        	$mailfunction = $mailplugin->confirmationmail($email, $from, $subject, $mailBody);
        }
        $output = json_decode($mailfunction);
        if (trim($output->message) === 'success') {

            $updateArray = array(
                'activation' => '1'
            );
            $keyarray = array('userid' => $usid);
            $updatedValues = $modelPlugin->getuserTable()->updateuser($updateArray, $keyarray);
            //echo $updatedValues;
        }
        echo $albumFolder;exit;
    }
    public function encrypt($data, $key){
    return base64_encode(
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_128,
        $key,
        $data,
        MCRYPT_MODE_CBC,
        "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0"
    )
);
    }
    
}

?>

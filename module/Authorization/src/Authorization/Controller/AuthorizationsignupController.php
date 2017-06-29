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

class AuthorizationsignupController extends AbstractActionController {

    protected $sessionid;

    public function __construct() {

        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        /*$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath);
            exit;
        }*/
    }
    
    public function signupAction() {
        
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $getpassword =$_POST['password']; 
        $password = password_hash($getpassword, PASSWORD_BCRYPT); 
        $dob = $_POST['dob'];
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $mailplugin = $this->mailplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
      
        $keyArray = array('emailid'=>$email);
        $usercheck = $modelPlugin->getuserTable()->fetchall($keyArray);
        
            if(count($usercheck) == 0){
                $insertedArray = array('emailid' => $email, 'password' => $password, 'firstname' => $firstName, 'lastname' => $lastName,'dateofbirth'=>$dob,'signindate' => date('Y-m-d'));
                $albumFolder = $modelPlugin->getuserTable()->savedata($insertedArray,$keyArray);
                $insrtArrayforpagetable =array('UID'=>$albumFolder, 'createddate' =>date('Y-m-d'));
                //print_r($insrtArrayforpagetable);exit;
                $resultinsert = $modelPlugin->getpagedetailsTable()->insertData($insrtArrayforpagetable);
                
                $albumDetails = $modelPlugin->getuserTable()->fetchall($keyArray);
                $usid= $albumDetails[0]['userid'];
                if($resultinsert)
                {
                    
                    //$key = '1234547890183420';
                    //$encrypted = $this->encrypt($usid, $key);
                    $encrypted = base64_encode("#$#" . base64_encode(base64_encode($usid . rand(10, 100)) . "###" . base64_encode($usid) . "###" . base64_encode($usid . rand(10, 100)) . "###" . base64_encode(base64_encode($usid . rand(10, 100)))) . "#$#");
                    $buttonclick = $dynamicPath . "/authsignup/confirmmail/" . $encrypted;
                    $fullname = $albumDetails[0]['firstname']." ".$albumDetails[0]['lastname'];
                    
                    $activationLink = "<a class='confirm-link' href='".$buttonclick."' style='text-decoration: none;'><div class='btn' style='width: 125px; padding: 12px 11px; background-color: #579942; border-radius: 5px; color: #fff; font-size: 14px; margin-top: 46px !important;'>Confirm Email</div></a>";

                    

                    $searchArray = array('mailCatagory' => 'C_MAIL');
                    $getMailStructure = $modelPlugin->getmailconfirmationTable()->fetchall($searchArray);
                    $getmailbodyFromTable = $getMailStructure[0]['mailTemplate'];
                    $activationLinkreplace = str_replace("|ACTIVATIONLINK|", $activationLink, $getmailbodyFromTable);
                    $mailBody = str_replace("|FULLNAME|", $fullname, $activationLinkreplace);
                    $subject = "Confirm your email address";
                    $from = $jsonArray['sendgridaccount']['addfrom'];
                    $mailfunction = $mailplugin->confirmationmail($email, $from, $subject, $mailBody);
                    $mailfunction = 1;
                }
               // $resultinsertvalue = 1; 

            }else {
                $mailfunction = 0;
            }

        echo $mailfunction;exit;
      
       
    }
    public function confirmmailAction() //added by me
    {
        $modelPlugin      = $this->modelplugin();
        $dynamicPath      = $modelPlugin->dynamicPath();
        $actionChecker    = $this->getEvent()->getRouteMatch()->getParam('id');
        $useridentifier   = $this->getEvent()->getRouteMatch()->getParam('pId');

        $getfirstdecodeid = explode("#$#", base64_decode($actionChecker));
                $getpubid = explode("###", base64_decode($getfirstdecodeid[1]));
                $arrayid  = base64_decode($getpubid[1]);

        if($actionChecker != "resetpassword") {
            $decrypteduserId = $arrayid;
            $searchkayarray  = array('userid'=>$arrayid);
            $updateArray     = array('activation' => '1');
            $updatedValues   = $modelPlugin->getuserTable()->updateuser($updateArray, $searchkayarray);
            $user_session = new Container('userloginId');
            $user_session->userloginId = $arrayid;
        } else {

            $serchArray     = array('forgetpassword' => $useridentifier);
            $FetchDetails   = $modelPlugin->getuserTable()->fetchall($serchArray);

            if (empty($FetchDetails)) {
                    return $this->redirect()->toUrl($dynamicPath."/album/showalbum");
            } else {
                $decrypteduserId = $FetchDetails[0]['userid'];
            }
        }
        return $this->redirect()->toUrl($dynamicPath . "/profile/newsfeed/confirmed/".$actionChecker);
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

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
        {
            if(count($usercheck) == 0){
                $insertedArray = array('emailid' => $email, 'password' => $password, 'firstname' => $firstName, 'lastname' => $lastName,'signindate' => date('Y-m-d'));
                $albumFolder = $modelPlugin->getuserTable()->savedata($insertedArray,$keyArray);
                $insrtArrayforpagetable =array('UID'=>$albumFolder, 'createddate' =>date('Y-m-d'));
                //print_r($insrtArrayforpagetable);exit;
                $resultinsert = $modelPlugin->getpagedetailsTable()->insertData($insrtArrayforpagetable);
                
                $albumDetails = $modelPlugin->getuserTable()->fetchall($keyArray);
                $usid= $albumDetails[0]['userid'];
                if($resultinsert == 1)
                {
                    
                    $key = '1234547890183420';
                    $encrypted = $this->encrypt($usid, $key);
                    $buttonclick = $dynamicPath . "/profile/newsfeed/" . $encrypted;
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
                }

            }else {
                $resultinsert = 0;
            }

        }
        
        //$output = json_decode($mailfunction);
        /*if (trim($output->message) === 'success') {

            $updateArray = array(
                'activation' => '1'
            );
            $keyarray = array('userid' => $usid);
            $updatedValues = $modelPlugin->getuserTable()->updateuser($updateArray, $keyarray);
           
        }*/
        echo $resultinsert;exit;
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

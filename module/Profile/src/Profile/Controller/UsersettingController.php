<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class UsersettingController extends AbstractActionController {

    public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        if ($this->sessionid == "") {
            header("Location:" . $dynamicPath. "/album/showalbum");
            exit;
        }
    }
    public function generalAction(){
        $this->layout('layout/profilelayout.phtml');
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $modelPlugin->dynamicPath();
        $currentPageURL = $modelPlugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
        $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'sessionid'=>$this->sessionid));
        return new ViewModel(array('dynamicPath' => $dynamicPath,'userDetails'=>$userDetails));
    }
    public function changepasswordAction() {
        $modelPlugin = $this->modelplugin();
        $response = array();
        $currentpasword = $_POST['currentPassword'];
        $conditionpublisherarray = array('userid' => $this->sessionid);
        $userDetails = $modelPlugin->getuserTable()->fetchall($conditionpublisherarray);

        $passcheck = password_verify($currentpasword, $userDetails[0]['password']);
        //echo $pass;exit;
        //if ($publisherDetails[0]['password'] != $pass) {
        if ($passcheck == false) {
            $response['error'] = 1;
            $response['Message'] = "Your current password is wrong";
        } else {
            //$passnew = $plugin->encrypt_decrypt('encrypt', $_POST['newPassword']);
            $passnew = password_hash(($_POST['newPassword']), PASSWORD_BCRYPT);
            $data = array(
                'password' => $passnew
            );
            $updateData = $modelPlugin->getuserTable()->updateuser($data, $conditionpublisherarray);
            $response['success'] = 1;
            $response['Message'] = "Password updated";
        }

        echo json_encode($response);
        exit;
    }
    public function changedetailsAction() {

        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $firstName = $_POST['accountFirstName'];
        $lastName = $_POST['accountLastName'];
        //$accountEmail = $_POST['accountEmail'];
        $accountDOB = $_POST['accountDOB'];
        $conditionpublisherarray = array('userid' => $this->sessionid);
        
        $data = array(

            'firstname' => $firstName,
            'lastname' => $lastName,
            'dateofbirth' => $accountDOB
            //'emailid' =>$accountEmail
        );
        $updateUserData = $modelPlugin->getuserTable()->updateuser($data, $conditionpublisherarray);
       
        
        exit;
    }
    public function sendQuestionAction() {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $mailplugin = $this->mailplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $questionDetails = $_POST['questionDetails'];
        $keyArray = array('userid'=>$this->sessionid);
        $usercheck = $modelPlugin->getuserTable()->fetchall($keyArray);
        $fullname = $usercheck[0]['firstname']." ".$usercheck[0]['lastname'];
        $searchArray = array('mailCatagory' => 'Q_MAIL');
        $getMailStructure = $modelPlugin->getmailconfirmationTable()->fetchall($searchArray);
        $getmailbodyFromTable = $getMailStructure[0]['mailTemplate'];
        $activationLinkreplace = str_replace("|QUERY|", $questionDetails, $getmailbodyFromTable);
        $email = 'rajyasree.delgence@gmail.com';
        $mailBody = str_replace("|FULLNAME|", $fullname, $activationLinkreplace);
        $subject = "Query to be answered";
        $from = $jsonArray['sendgridaccount']['addfrom'];
        echo $mailBody;exit;
        $mailfunction = $mailplugin->confirmationmail($email, $from, $subject, $mailBody);
        echo $mailfunction;exit;
    }
    public function viewProfilePermissionAction() {
        $optionValue = $_POST['optionValue'];
        $typeValue = $_POST['type'];
        $modelPlugin = $this->modelplugin();
        $conditionData = array('userid' => $this->sessionid);
        if($typeValue == 'name')
        {
            $data = array('viewname' => $optionValue);
        }
        else
        {
            $data = array('viewprofile' => $optionValue);
        }
        $updateData = $modelPlugin->getuserTable()->updateuser($data, $conditionData);
        echo $updateData;exit;
    }
    
}

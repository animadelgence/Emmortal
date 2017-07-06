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
//        if ($this->sessionid == "") {
//            header("Location:" . $dynamicPath. "/album/showalbum");
//            exit;
//        }
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
        $bgimg = $modelPlugin->getbgimageTable()->fetchall();
        if(@getimagesize($userDetails[0]['backgroundimage'])){
                $bgimgSend = $userDetails[0]['backgroundimage'];
            }
            else{
             $bgimgSend = $bgimg[0]['bgimgpath'];
            }
        $this->layout()->setVariables(array('controller' => $controller, 'action' => $action,'dynamicPath' => $dynamicPath, 'userDetails'=>$userDetails, 'sessionid'=>$this->sessionid,'bgimg'=>$bgimgSend));
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
        $dynamicPath = $plugin->dynamicPath();
        $firstName = $_POST['accountFirstName'];
        $lastName = $_POST['accountLastName'];
        //$accountEmail = $_POST['accountEmail'];
        $accountDOB = $_POST['accountDOB'];
        
        $conditionpublisherarray = array('userid' => $this->sessionid);
        $checkArray = $modelPlugin->getuserTable()->fetchall($conditionpublisherarray);
        //print_r($checkArray);exit;
        if($checkArray[0]['profileimage'] != "")
        {
            if($_POST['profileimageNmae'] != "") {
                $profileimageNmae = $dynamicPath."/upload/profileImage/".$_POST['profileimageNmae']; 
            } else {
                 $profileimageNmae = $checkArray[0]['profileimage'];
            }
        } else {

            $profileimageNmae = $dynamicPath."/upload/profileImage/".$_POST['profileimageNmae'];
        }
        if($checkArray[0]['backgroundimage'] != "")
        {
            if($_POST['backgroundimageName'] != "") {
                $backgroundimageName = $dynamicPath."/upload/backgroundImage/".$_POST['backgroundimageName']; 
            } else {
                 $backgroundimageName = $checkArray[0]['backgroundimage'];
            }
        } else {
            $backgroundimageName = $dynamicPath."/upload/backgroundImage/".$_POST['backgroundimageName']; 
        }
        $data = array(

            'firstname' => $firstName,
            'lastname' => $lastName,
            'dateofbirth' => $accountDOB,
            'profileimage' => $profileimageNmae,
            'backgroundimage' => $backgroundimageName
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
        //echo $mailBody;exit;
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
    public function removeallavatarAction(){
        //echo 1; exit;

        $modelPlugin = $this->modelplugin();
        $imageName = $_POST['imageName'];
        //echo $imageName;exit;
        $imageCategory = $_POST['imageCategory'];
        
        $conditionData = array('userid' => $this->sessionid);
        if($imageCategory == "profileimage")
        {
            $updatedArray = array('profileimage'=> "");
        }else{
            $updatedArray = array('backgroundimage'=> "");
        }
        $updateData = $modelPlugin->getuserTable()->updateuser($updatedArray, $conditionData);
        echo $updateData;exit;

    }
    public function bgeditsubmitAction(){
              $modelPlugin  = $this->modelplugin();
              $plugin       = $this->routeplugin();
              $uploadPlugin = $this->imageuploadplugin();
              $dynamicPath  = $plugin->dynamicPath();
              $jsonArray    = $plugin->jsondynamic();
		      $currentPageURL = $plugin->curPageURL();

              $request1 = $this->getRequest()->getPost();
              $name = $request1['filename'];
              $request = $this->getRequest();
              $files = $request->getFiles()->toArray();
         //print_r($files); exit;
              $filename = $files['fileupload']['name'];
         //echo $imageName; exit;


              //$filename = $_FILES['fileupload']['name'];

              $bgimgpath = $dynamicPath."/upload/bgimg/".$filename;
              //echo $bgimgpath; exit;

              //upload in bgimg folder(start)
              $href              = explode("/", $currentPageURL);
              $controller        = @$href[3];
              $action            = @$href[4];

              $res               = array();
//              $request           = $this->getRequest();
//              $files             = $request->getFiles()->toArray();
//              $tmp_name          = $_FILES['fileupload']['tmp_name'];
//              $fileNamewithspace = $_FILES['fileupload']['name'];
//              $fileType          = $_FILES['fileupload']['type'];
//              $fileSize          = ($_FILES['fileupload']['size'] / 1024) / 1024;

              $tmp_name          = $files['fileupload']['tmp_name'];
              $fileNamewithspace = $files['fileupload']['name'];
              $fileName          = str_replace("","_",$fileNamewithspace);
              $fileType          = $files['fileupload']['type'];
              $fileType          = strtolower($fileType);
              $fileSize          = ($files['fileupload']['size'] / 1024) / 1024;


              if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/bgimg')) {
                      @mkdir($_SERVER['DOCUMENT_ROOT'] . '/upload/bgimg', 0777, true);
                      chmod($_SERVER['DOCUMENT_ROOT'] . '/upload/bgimg/', 0777);
                  }

              //$result = $uploadPlugin->bgimgedit($tmp_name , $fileName);
              $folderName = "/upload/bgimg/";
              $result = $uploadPlugin->uploadimg($fileSize, $fileName, $files[$filename]['error'], $folderName, $fileName, $fileType);
            print_r($result); exit;

//         echo json_encode($result);
//        exit;
              //print_r($result); exit; //uncomment this
//              echo $bgimgpath; exit;
              //upload in bgimg folder(end)

     }

}

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
            $response['Message'] = "You current password is wrong";
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
}

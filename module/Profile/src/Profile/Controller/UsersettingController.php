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
}

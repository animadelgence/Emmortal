<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class PageController extends AbstractActionController {

        public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        /*if ($this->sessionid == "") {
            header("Location:" . $dynamicPath. "/profile/showprofile");
            exit;
        }*/
    }

    public function newpagecreateAction(){
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $modelPlugin->dynamicPath();
        $currentdatetime = date("Y-m-d h:i:sa");
        $data = array("UID" => "13" , "createddate" =>$currentdatetime);
        $pageinsertQuery = $modelPlugin->getpagedetailsTable()->insertData($data);
        return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
    }
    public function selectpageAction(){
        $id = $_GET['pageid'];
        $data = array("UID" => "13" ,"PID"=>$id);
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $modelPlugin->dynamicPath();
        $fetchDetailsOfPage = $modelPlugin->getuploadDetailsTable()->fetchall($data);
        if (count($fetchDetailsOfPage) > 0) {
            $response = json_encode($fetchDetailsOfPage);
            echo $response;exit;
        }
        else
        {
            $response[0]['NoPage'] = 1;
            echo json_encode($response);exit;
        }
    }

}

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

    }

    public function newpagecreateAction(){
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $modelPlugin->dynamicPath();
        $currentdatetime = date("Y-m-d h:i:sa");
        $data = array("UID" => $this->sessionid , "createddate" =>$currentdatetime);
        $pageinsertQuery = $modelPlugin->getpagedetailsTable()->insertData($data);
        $currentPageURL = $modelPlugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        if($controller=="profile"&&$action=="showprofile"){
          $response['noredirect'] = 1;
        }
        else
        {
          $response['noredirect'] = 0;
          $response['gotostep'] = $pageinsertQuery;
        }
        $response = json_encode($response);
        echo $response;exit;
    }
    public function selectpageAction(){
        $id = $_POST['pageid'];
        $useid = $_POST['useid']; // check
        $modelPlugin = $this->modelplugin(); // check
        $dynamicPath = $modelPlugin->dynamicPath(); // check
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('uniqueUser'=>$useid)); // check
        $userid = $userDetails[0]['userid']; // check
        $data = array("UID" => $userid ,"PID"=>$id);
        $fetchDetailsOfPage = $modelPlugin->getuploadDetailsTable()->fetchall($data);
        $pageData = array("UID" => $userid); // check
        $fetchFirstPage = $modelPlugin->getpagedetailsTable()->fetchall($pageData);
        $selectFirstPage = $fetchFirstPage[0]['pageid'];
        if($id==$selectFirstPage)
        {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$userid)); // check
            if (@getimagesize($userDetails[0]['profileimage'])) {
                $response['profileImage']  = 1;
            } else {
                $response['profileImage']  = $dynamicPath."/image/profile-deafult-avatar.jpg";
            }
            $response['DOB'] = $userDetails[0]['dateofbirth'];
            $response['Name'] = $userDetails[0]['firstname']." ".$userDetails[0]['lastname'];
            $response['defaultPage']  = 1;
        }
        else
        {
            $response['defaultPage']  = 0;
        }
        if (count($fetchDetailsOfPage) > 0) {
            $response['NoPage'] = 0;
            $response['uploaddetails'] = $fetchDetailsOfPage;
        }
        else
        {
            $response['NoPage'] = 1;
        }
        $response['sessionid'] = '';
        if ($this->sessionid) {
            $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$this->sessionid));
            $response['sessionid'] = $userDetails[0]['uniqueUser'];
        }
        
        
        echo json_encode($response);exit;
    }

}

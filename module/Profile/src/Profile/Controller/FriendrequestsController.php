<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class FriendrequestsController extends AbstractActionController {


    public function __construct() {

        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
    }
    public function indexAction() {
        echo "work in progress";exit;
    }
    public function searchfriendsAction()
    {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $query = array();
        $userdetails = $modelPlugin->getuserTable()->fetchall($query);
        $array = array();
        foreach ($userdetails as $rSet) {
            $array[] = array(
                'friendsid' => $rSet['userid'],
                'emailid' => $rSet['emailid'],
                'friendsname' => $rSet['firstname']." ".$rSet['lastname'],
                'profileimage'=>$rSet['profileimage']
            );
          }
        //print_r($array);exit;
        $res['userDetails'] = $array;
        echo json_encode($res);
        exit;
    }
    public function sendingrequestAction()
    {
        $userId = $_POST['userId'];
        echo $userId;
        echo "livw";
        exit;
    }
}

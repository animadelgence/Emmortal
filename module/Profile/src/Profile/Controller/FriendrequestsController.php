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
        $query = $this->sessionid;
        $userdetails = $modelPlugin->getuserTable()->fetchallData($query);
        //print_r($userdetails);exit;
        $array = array();
        $userid = $this->sessionid;
        foreach ($userdetails as $rSet) {
            /*$array[] = array(
                'friendsid' => $rSet['userid'],
                'emailid' => $rSet['emailid'],
                'friendsname' => $rSet['firstname']." ".$rSet['lastname'],
                'profileimage'=>$rSet['profileimage']
            );*/
           
          }
        exit;
        //print_r($array);//exit;
        $noOfUsers = count($array);
        echo $noOfUsers;
        for($i=0;$i<$noOfUsers;$i++) {
            $query = array('userid'=>$userid,
                           'friendsid'=>$array[$i]['friendsid']);
            print_r($query);
            $friendDetails = $modelPlugin->getfriendsTable()->fetchall($query);
            print_r($friendDetails);exit;
        }
        
        $res['userDetails'] = $array;
        echo json_encode($res);
        exit;
    }
    public function sendingrequestAction()
    {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $friendsId = $_POST['userID'];
        $userid = $this->sessionid;
        //echo $friendsId;
        //echo $userid;
        $query = array('userid'=>$userid,
                      'friendsid'=>$friendsId);
        $friendDetails = $modelPlugin->getfriendsTable()->fetchall($query);
        if(empty($friendDetails)) {
            $newQuery  =  array('userid'=>$userid,
                                'friendsid'=>$friendsId,
                                'friendshipdate'=>date('Y-m-d H:i:s'),
                                'relationshipstatus'=>'outgoing',
                               'requestaccept'=>0);
            $friendDetails = $modelPlugin->getfriendsTable()->insertFirend($newQuery);
            if($friendDetails == 1) {
                $res['status'] = 'Request sent';
            }
            else {
                $res['status'] = 'Request could not be sent';
            }
        }
        else {
            $res['status'] = 'Request already sent';
        }
        echo json_encode($res);
        exit;
    }
}

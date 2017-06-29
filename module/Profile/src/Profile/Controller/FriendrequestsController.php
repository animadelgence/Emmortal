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
        $array = array();
        $userid = $this->sessionid;
        $param = $_POST['param'];
        foreach ($userdetails as $rSet) {
            $frndid = $rSet['userid'];
            $sendfrndCon     = array('friends.userid'=>$userid,'friends.friendsid'=>$frndid);
            $sendfrndJoin    = "friends.friendsid = user.userid";
            $sendfrndDetails = $modelPlugin->getfriendsTable()->joinquery($sendfrndCon,$sendfrndJoin);
            $recfrndCon      = array('friends.friendsid'=>$userid,'friends.userid'=>$frndid);
            $recfrndJoin     = "friends.userid = user.userid";
            $recfrndDetails  = $modelPlugin->getfriendsTable()->joinquery($recfrndCon,$recfrndJoin);
            if(count($sendfrndDetails)>0){
                if($sendfrndDetails[0]['requestaccept'] == 1){
                    $status = "Accepted";
                } else{
                    $status = "Outgoing";
                }
                if(($param=='AllFriend') || ($param=='Outgoing' && $status == "Outgoing") || ($param=='All')){
                $array[] = array(
                    'friendsid'     => $sendfrndDetails[0]['friendsid'],
                    'friendsname'   => $sendfrndDetails[0]['firstname']." ".$sendfrndDetails[0]['lastname'],
                    'profileimage'  => $sendfrndDetails[0]['profileimage'],
                    'status'        => $status
                );
                }
                else if ($param == 'Onlyfriend' && $status =='Accepted') {
                    $array[] = array(
                            'friendsid'     => $sendfrndDetails[0]['friendsid'],
                            'friendsname'   => $sendfrndDetails[0]['firstname']." ".$sendfrndDetails[0]['lastname'],
                            'profileimage'  => $sendfrndDetails[0]['profileimage'],
                            'status'        => $status
                        );
                }
            } else if(count($recfrndDetails)>0){
                if($recfrndDetails[0]['requestaccept'] == 1){
                    $status = "Accepted";
                } else{
                    $status = "Incoming";
                }
                if($recfrndDetails[0]['relationshipstatus'] == 'declined'){
                    if(($param=='Incoming' && $status == "Incoming") || ($param=='All')){
                        $array[] = array(
                            'friendsid'     => $recfrndDetails[0]['userid'],
                            'friendsname'   => $recfrndDetails[0]['firstname']." ".$recfrndDetails[0]['lastname'],
                            'profileimage'  => $recfrndDetails[0]['profileimage'],
                            'dbstatus'  => $recfrndDetails[0]['relationshipstatus'],
                            'status'        => "Declined"
                        );
                    }
                }
                else if ($param == 'Onlyfriend' && $status =='Accepted') {
                    $array[] = array(
                            'friendsid'     => $recfrndDetails[0]['userid'],
                            'friendsname'   => $recfrndDetails[0]['firstname']." ".$recfrndDetails[0]['lastname'],
                            'profileimage'  => $recfrndDetails[0]['profileimage'],
                            'dbstatus'  => $recfrndDetails[0]['relationshipstatus'],
                            'status'        => $status
                        );
                }
                else {
                    if(($param=='AllFriend') || ($param=='Incoming' && $status == "Incoming") || ($param=='All')){
                        $array[] = array(
                            'friendsid'     => $recfrndDetails[0]['userid'],
                            'friendsname'   => $recfrndDetails[0]['firstname']." ".$recfrndDetails[0]['lastname'],
                            'profileimage'  => $recfrndDetails[0]['profileimage'],
                            //'dbstatus'  => $recfrndDetails[0]['relationshipstatus'],
                            'status'        => $status
                        );
                }
                }
            } /*else if(count($recfrndDetails)>0){
                if($recfrndDetails[0]['relationshipstatus'] == 'declined'){
                if($recfrndDetails[0]['requestaccept'] == 1){
                    $status = "Accepted";
                } else{
                    $status = "Declined";
                }
                if(($param=='Incoming' && $status == "Declined") || ($param=='All')){
                $array[] = array(
                    'friendsid'     => $recfrndDetails[0]['userid'],
                    'friendsname'   => $recfrndDetails[0]['firstname']." ".$recfrndDetails[0]['lastname'],
                    'profileimage'  => $recfrndDetails[0]['profileimage'],
                    'dbstatus'  => $recfrndDetails[0]['relationshipstatus'],
                    'status'        => $status
                );
                }
                }
            }*/ else{
                if($param=='All'){
                $array[] = array(
                    'friendsid'     => $rSet['userid'],
                    'friendsname'   => $rSet['firstname']." ".$rSet['lastname'],
                    'profileimage'  => $rSet['profileimage'],
                    'status'        => 'New'
                );
                }
            }
          }
        if(count($array)<1){
            $array = array();
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
    public function responserequestAction()
    {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $friendsId = $_POST['userID'];
        $action = $_POST['action'];
        $userid = $this->sessionid;
        $query = array('userid'=>$friendsId,
                      'friendsid'=>$userid);
        $friendDetails = $modelPlugin->getfriendsTable()->fetchall($query);
        //print_r($friendDetails);exit;
        $updatedArray = array(
                            'relationshipstatus'=>'accepted',
                            'requestaccept'=>1);
        $where = array(
                        'userid'=>$friendsId,
                        'friendsid'=>$userid);
        $friendDetails = $modelPlugin->getfriendsTable()->updateData($updatedArray,$where);
        echo $friendDetails;exit;
        
    }
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class TributeController extends AbstractActionController {
   public function __construct() {
        $userSession = new Container('userloginId');
        $this->sessionid = $userSession->offsetGet('userloginId');
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $dynamicPath = $protocol . $_SERVER['HTTP_HOST'];
        // if ($this->sessionid == "") {
        //     header("Location:" . $dynamicPath. "/profile/showprofile");
        //     exit;
        // }
    }
    public function tributesubmitAction(){
        $plugin                     = $this->routeplugin();
        $modelPlugin                = $this->modelplugin();
        $dynamicPath                = $plugin->dynamicPath();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $tributeDescription         = $_POST['tributeDescription'];
        $frndIdValue                = $_POST['frndId'];
        if($frndIdValue){
           $friendId                =  implode(",",$frndIdValue);
            } else{
              $friendId = "";
            }
           // echo $friendId;exit;
        $UID                        = $this->sessionid;
        $this->layout()->setVariables(array('sessionid'=> $UID,'controller' => $controller, 'action' => $action));
        $addeddate                  = date('Y-m-d H:i:s');
        $data                       =  array('UID'=>$UID,
                      'description'=>$tributeDescription,
                      'friendsid'=>$friendId,
                      'addeddate'=>$addeddate

                      );
        $tributeDetails             = $modelPlugin->gettributedetailsTable()->insertData($data);
        $userDetails = $modelPlugin->getuserTable()->fetchall(array('userid'=>$UID));
        $recfrndCon      = array('friends.friendsid'=>$friendId,'friends.requestaccept'=>1);
        $recfrndJoin     = "friends.friendsid = user.userid";
        $recfrndDetails  = $modelPlugin->getfriendsTable()->joinquery($recfrndCon,$recfrndJoin);
        if($tributeDetails == 1){
            return new ViewModel(array('sessionid'=>$UID,'dynamicPath' => $dynamicPath,'tributeDescription'=>$tributeDescription, 'tributeDescription'=>$tributeDescription,'recfrndDetails'=>$recfrndDetails,'userDetails'=>$userDetails));
        }


    }

    public function gettributeAction(){
    	$plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        $jsonArray = $plugin->jsondynamic();
        $currentPageURL = $plugin->curPageURL();
        $href = explode("/", $currentPageURL);
        $controller = @$href[3];
        $action = @$href[4];
        $userid = $this->sessionid;
        $friendId = $_POST['frndId'];
        $description = $_POST['description'];
        if(!empty($description)){
            $value = array(
                        'UID'=>$userid,
                        'description'=>$description,
                        'friendsid'=>$friendId,
                        'addeddate'=>date("Y-m-d H:i:s")
                    );
            $tribute = $modelPlugin->gettributedetailsTable()->insertData($value);
        }
        $tributeDetails = $modelPlugin->gettributedetailsTable()->fetchall();
        foreach ($tributeDetails as $rSet) {
            if(($userid == $rSet['UID']) && ($friendId == $rSet['friendsid'])){
                if ($friendId == $rSet['friendsid'])
                {
                    $where = array('TID'=>$rSet['tributesid']);
                    $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($where);
                    $join = 'tributedetails.UID = user.userid';
                    $condition = array('tributedetails.tributesid'=>$rSet['tributesid']);
                    $tribute = $modelPlugin->gettributedetailsTable()->joinquery($condition,$join);
                    $like = count($likeDetails);
                    $array[] = array(
                        'tributesid' => $tribute[0]['tributesid'],
                        'UID' => $tribute[0]['UID'],
                        'friendsname' => $tribute[0]['firstname']." ".$tribute[0]['lastname'],
                        'profileimage'=>$tribute[0]['profileimage'],
                        'description'=>$tribute[0]['description'],
                        'shortDescription'=>substr($tribute[0]['description'],0,20).'...',
                        'friendsid'=>$tribute[0]['friendsid'],
                        'like'=>$like,
                        'addeddate'=>date("m/d/Y",strtotime($tribute[0]['addeddate']))
                    );
                }
            } else if($friendId == $rSet['UID'] && $userid == $rSet['friendsid']){
                if ($friendId == $rSet['friendsid'])
                {
                    $where = array('TID'=>$rSet['tributesid']);
                    $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($where);
                    $join = 'tributedetails.UID = user.userid';
                    $condition = array('tributedetails.tributesid'=>$rSet['tributesid']);
                    $tribute = $modelPlugin->gettributedetailsTable()->joinquery($condition,$join);
                    $like = count($likeDetails);
                    $array[] = array(
                        'tributesid' => $tribute[0]['tributesid'],
                        'UID' => $tribute[0]['UID'],
                        'friendsname' => $tribute[0]['firstname']." ".$tribute[0]['lastname'],
                        'profileimage'=>$tribute[0]['profileimage'],
                        'description'=>$rSet['description'],
                        'shortDescription'=>substr($tribute[0]['description'],0,20).'...',
                        'friendsid'=>$tribute[0]['friendsid'],
                        'like'=>$like,
                        'addeddate'=>date("m/d/Y",strtotime($tribute[0]['addeddate']))
                    );
                }
            }
        }
        $res['tributeDetails'] = $array;
        echo json_encode($res);
        exit;
     }

    
    
}
?>

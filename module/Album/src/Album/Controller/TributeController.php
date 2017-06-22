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
        $tributeDescription         = $_POST['tributeDescription'];
        $frndIdValue                = $_POST['frndId'];
        if($frndIdValue){
           $friendId                =  implode(",",$frndIdValue);
            } else{
              $friendId = "";
            }
           // echo $friendId;exit;
        $UID                        = $this->sessionid;
        $addeddate                  = date('Y-m-d H:i:s');
        $data                       =  array('UID'=>$UID,
                      'description'=>$tributeDescription,
                      'friendsid'=>$friendId,
                      'addeddate'=>$addeddate

                      );
        $tributeDetails             = $modelPlugin->gettributedetailsTable()->insertData($data);
        if($tributeDetails == 1){
            return $this->redirect()->toUrl($dynamicPath . "/profile/showprofile");
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
        $where = array('tributedetails.UID'=>$userid);
        $tributeDetails = $modelPlugin->gettributedetailsTable()->joinquery($where);
        $array = array();
        foreach ($tributeDetails as $rSet) {
            $friendsid = explode(",",$rSet['friendsid']);
            if (in_array($friendId, $friendsid))
            {
                $where = array('TID'=>$rSet['tributesid']);
                $likeDetails = $modelPlugin->getlikesdetailsTable()->fetchall($where);
                $like = count($likeDetails);
                $array[] = array(
                    'tributesid' => $rSet['tributesid'],
                    'UID' => $rSet['UID'],
                    'friendsname' => $rSet['firstname']." ".$rSet['lastname'],
                    'profileimage'=>$rSet['profileimage'],
                    'description'=>$rSet['description'],
                    'shortDescription'=>substr($rSet['description'],0,20).'...',
                    'friendsid'=>$rSet['friendsid'],
                    'like'=>$like,
                    'addeddate'=>date("m/d/Y",strtotime($rSet['addeddate']))
                );
            }
        }
        $res['tributeDetails'] = $array;
        echo json_encode($res);
        exit;
     }
    
    
}
?>

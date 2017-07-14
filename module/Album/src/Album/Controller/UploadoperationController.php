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

class UploadoperationController extends AbstractActionController {
    public function __construct() {
        $userSession        = new Container('userloginId');
        $this->sessionid    = $userSession->offsetGet('userloginId');
    }
    public function indexAction() {
        echo 1; exit;
    }
    public function deletedataAction() {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        
        $user_id = $this->sessionid;
        $dataId = $_POST['dataid'];
        
        $deleteDetails = 0;
        $data = array(
                'uploadId' => $dataId,
                'UID' => $user_id
                );
        $dataDetails    = $modelPlugin->getuploadDetailsTable()->fetchall($data);
        if($dataDetails) {
            $deleteDetails = $modelPlugin->getuploadDetailsTable()->deleteData($data);
        }
        echo $deleteDetails;exit;
    }
    public function opendataAction() {
        $plugin = $this->routeplugin();
        $modelPlugin = $this->modelplugin();
        $dynamicPath = $plugin->dynamicPath();
        
        $user_id = $this->sessionid;
        $dataId = $_POST['dataid'];
        $data = array(
                'uploadId' => $dataId,
                'UID' => $user_id
                );
        $dataDetails    = $modelPlugin->getuploadDetailsTable()->fetchall($data);
        $res['uploadId'] = $dataDetails[0]['uploadId'];
        $res['uploadPath'] = $dataDetails[0]['uploadPath'];
        //$res['uploadPath'] = '/upload/uploadimage/1500020556_imagescrap2.php.jpeg';
        $res['uploadTitle'] = $dataDetails[0]['uploadTitle'];
        $res['uploadDescription'] = $dataDetails[0]['uploadDescription'];
        $res['uploadType'] = $dataDetails[0]['uploadType'];
        $res['AID'] = $dataDetails[0]['AID'];
        $res['FID'] = $dataDetails[0]['FID'];
        echo json_encode($res);
        //print_r($dataDetails);
        exit;
    }
}
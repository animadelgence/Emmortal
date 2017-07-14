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
}
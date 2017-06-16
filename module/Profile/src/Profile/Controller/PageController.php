<?php

namespace Profile\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;

class PageController extends AbstractActionController {

    public function indexAction() {
        $modelPlugin = $this->modelplugin();
        $pageDetails = $modelPlugin->getpagedetailsTable()->fetchall();
        print_r($pageDetails);exit;
       }
}

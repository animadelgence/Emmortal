<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Authorization;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Authorization\Model\user;
use Authorization\Model\userTable;
use Authorization\Model\trackdetails;
use Authorization\Model\trackdetailsTable;
use Authorization\Model\trackdetailsafterlogin;
use Authorization\Model\trackdetailsafterloginTable;

use Authorization\Model\userbackup;
use Authorization\Model\userbackupTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     public function getServiceConfig()
     {
         return array(
            'factories' => array(
                'Authorization\Model\userTable' => function($sm) {
                    $tableGateway = $sm->get('userTableGateway');
                    $table = new userTable($tableGateway);
                    return $table;
                },
                'userTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new user());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },

                'Authorization\Model\userbackupTable' => function($sm) {
                    $tableGateway = $sm->get('userbackupTableGateway');
                    $table = new userbackupTable($tableGateway);
                    return $table;
                },
                'userbackupTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new userbackup());
                    return new TableGateway('userbackup', $dbAdapter, null, $resultSetPrototype);
                },

                'Authorization\Model\trackdetailsTable' => function($sm) {
                    $tableGateway = $sm->get('trackdetailsTableGateway');
                    $table = new trackdetailsTable($tableGateway);
                    return $table;
                },
                'trackdetailsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new trackdetails());
                    return new TableGateway('trackdetails', $dbAdapter, null, $resultSetPrototype);
                },
                'Authorization\Model\trackdetailsafterloginTable' => function($sm) {
                    $tableGateway = $sm->get('trackdetailsafterloginTableGateway');
                    $table = new trackdetailsafterloginTable($tableGateway);
                    return $table;
                },
                'trackdetailsafterloginTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new trackdetailsafterlogin());
                    return new TableGateway('trackdetailsafterlogin', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

}
?>

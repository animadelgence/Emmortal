<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Album;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Album\Model\albumdetails;
use Album\Model\albumdetailsTable;
use Album\Model\mailconfirmation;
use Album\Model\mailconfirmationTable;
use Album\Model\friends;
use Album\Model\friendsTable;
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
                'Album\Model\albumdetailsTable' => function($sm) {
                    $tableGateway = $sm->get('albumdetailsTableGateway');
                    $table = new albumdetailsTable($tableGateway);
                    return $table;
                },
                'albumdetailsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new albumdetails());
                    return new TableGateway('albumdetails', $dbAdapter, null, $resultSetPrototype);
                },
                'Album\Model\mailconfirmationTable' => function($sm) {
                    $tableGateway = $sm->get('mailconfirmationTableGateway');
                    $table = new mailconfirmationTable($tableGateway);
                    return $table;
                },
                'mailconfirmationTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new mailconfirmation());
                    return new TableGateway('mailconfirmation', $dbAdapter, null, $resultSetPrototype);
                },
                'Album\Model\friendsTable' => function($sm) {
                    $tableGateway = $sm->get('friendsTableGateway');
                    $table = new friendsTable($tableGateway);
                    return $table;
                },
                'friendsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new friends());
                    return new TableGateway('friends', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
?>

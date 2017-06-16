<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Profile;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Profile\Model\uploadDetails;
use Profile\Model\uploadDetailsTable;
use Profile\Model\pagedetails;
use Profile\Model\pagedetailsTable;
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
                'Profile\Model\uploadDetailsTable' => function($sm) {
                    $tableGateway = $sm->get('uploadDetailsTableGateway');
                    $table = new uploadDetailsTable($tableGateway);
                    return $table;
                },
                'uploadDetailsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new uploadDetails());
                    return new TableGateway('uploadDetails', $dbAdapter, null, $resultSetPrototype);
                },
                'Profile\Model\pagedetailsTable' => function($sm) {
                    $tableGateway = $sm->get('pagedetailsTableGateway');
                    $table = new pagedetailsTable($tableGateway);
                    return $table;
                },
                'pagedetailsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new pagedetails());
                    return new TableGateway('pagedetails', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
 
}
?>

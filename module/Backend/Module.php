<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Backend;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Backend\Model\admin;
use Backend\Model\adminTable;
use Backend\Model\seo;
use Backend\Model\seoTable;
use Backend\Model\bgimage;
use Backend\Model\bgimageTable;

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
                'Backend\Model\adminTable' => function($sm) {
                    $tableGateway = $sm->get('adminTableGateway');
                    $table = new adminTable($tableGateway);
                    return $table;
                },
                'adminTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new admin());
                    return new TableGateway('admin', $dbAdapter, null, $resultSetPrototype);
                },
                'Backend\Model\seoTable' => function($sm) {
                    $tableGateway = $sm->get('seoTableGateway');
                    $table = new seoTable($tableGateway);
                    return $table;
                },
                'seoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new seo());
                    return new TableGateway('seo', $dbAdapter, null, $resultSetPrototype);
                },
                'Backend\Model\bgimageTable' => function($sm) {
                    $tableGateway = $sm->get('bgimageTableGateway');
                    $table = new bgimageTable($tableGateway);
                    return $table;
                },
                'bgimageTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new bgimage());
                    return new TableGateway('bgimage', $dbAdapter, null, $resultSetPrototype);
                },
           ),

        );

      }
 
}
?>

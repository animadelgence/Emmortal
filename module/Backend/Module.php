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
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'loadConfiguration'), MvcEvent::EVENT_DISPATCH_ERROR, function($e) {
            $result = $e->getResult();
            $result->setTerminal(TRUE);
        }, 100);
        $eventManager->attach('dispatch.error',array($this,'handleError'), 100);
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    public function loadConfiguration(MvcEvent $e)
    {
        $sm = $e->getApplication()->getServiceManager();
        $controller = $e->getRouteMatch()->getParam('controller');
        if (0 !== strpos($controller, __NAMESPACE__, 0)) {
            //if not this module
            return;
        }
        $action = $e->getRouteMatch()->getParam('action');
        if ($action == 'not-found') {
            //if not this module
            include_once(dirname(dirname(dirname(__FILE__))).'/module/Authorization/view/authorization/error/error.php');
        }
        //if this module
        $exceptionstrategy = $sm->get('ViewManager')->getExceptionStrategy();
		$exceptionstrategy->setExceptionTemplate('error/index');
    }
    public function handleError(MvcEvent $e)
	{
        $error  = $e->getError();
        include_once(dirname(dirname(dirname(__FILE__))).'/module/Authorization/view/authorization/error/error.php');
		//...handle the exception...     maybe log it and redirect to another page,
		//or send an email that an exception occurred...
	}
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

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
use Profile\Model\uploadBackup;
use Profile\Model\uploadBackupTable;
use Profile\Model\pagedetails;
use Profile\Model\pagedetailsTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

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
        echo $action = $e->getRouteMatch()->getParam('action'); exit;
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
                'Profile\Model\uploadBackupTable' => function($sm) {
                    $tableGateway = $sm->get('uploadBackupTableGateway');
                    $table = new uploadBackupTable($tableGateway);
                    return $table;
                },
                'uploadBackupTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new uploadBackup());
                    return new TableGateway('uploadBackup', $dbAdapter, null, $resultSetPrototype);
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

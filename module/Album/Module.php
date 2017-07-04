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
use Album\Model\tributedetails;
use Album\Model\tributedetailsTable;
use Album\Model\user;
use Album\Model\userTable;
use Album\Model\likesdetails;
use Album\Model\likesdetailsTable;
use Album\Model\notificationdetails;
use Album\Model\notificationdetailsTable;
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
                'Album\Model\tributedetailsTable' => function($sm) {
                    $tableGateway = $sm->get('tributedetailsTableGateway');
                    $table = new tributedetailsTable($tableGateway);
                    return $table;
                },
                'tributedetailsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new tributedetails());
                    return new TableGateway('tributedetails', $dbAdapter, null, $resultSetPrototype);
                },
                'Album\Model\likesdetailsTable' => function($sm) {
                    $tableGateway = $sm->get('likesdetailsTableGateway');
                    $table = new likesdetailsTable($tableGateway);
                    return $table;
                },
                'likesdetailsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new likesdetails());
                    return new TableGateway('likesdetails', $dbAdapter, null, $resultSetPrototype);
                },
                'Album\Model\notificationdetailsTable' => function($sm) {
                    $tableGateway = $sm->get('notificationdetailsTableGateway');
                    $table = new notificationdetailsTable($tableGateway);
                    return $table;
                },
                'notificationdetailsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new notificationdetails());
                    return new TableGateway('notificationdetails', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
?>

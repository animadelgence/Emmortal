<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
     'controllers' => array(
         'invokables' => array(
             'Backend\Controller\Adminlogin' => 'Backend\Controller\AdminloginController',
             'Backend\Controller\Usermanage' => 'Backend\Controller\UsermanageController',
             'Backend\Controller\Seomanage' => 'Backend\Controller\SeomanageController',
             'Backend\Controller\Uploads' => 'Backend\Controller\UploadsController',
            'Backend\Controller\Patternget' => 'Backend\Controller\PatterngetController'
         ),
     ),

    // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(

             // this is for Adminlogin operation
             'adminlogin' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/adminlogin[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Adminlogin',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
             // this is for Usermanage operation
             'usermanage' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/usermanage[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Usermanage',
                         'action'     => 'index',
                     ),
                 ),
             ),

             // this is for Seomanage operation
             'seomanage' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/seomanage[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Seomanage',
                         'action'     => 'index',
                     ),
                 ),
             ),

              // this is for Uploads-manage operation
             'uploads' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/uploads[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Uploads',
                         'action'     => 'index',
                     ),
                 ),
             ),
            // this is for Uploads-manage operation
             'patternget' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/patternget[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Backend\Controller\Patternget',
                         'action'     => 'index',
                     ),
                 ),
             ),

         ),
     ),
    


	 'view_manager' => array(
         /*'template_map' => array(
            'layout/layout' => ,

		),*/
		 'template_path_stack' => array(
            __DIR__ . '/../view',
        )

    )
 );

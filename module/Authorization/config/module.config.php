<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
     'controllers' => array(
         'invokables' => array(
             'Authorization\Controller\Authorizationlogin' => 'Authorization\Controller\AuthorizationloginController',
             'Authorization\Controller\Authorizationsignup' => 'Authorization\Controller\AuthorizationsignupController'

         ),
     ),
    // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             // this is for loginpurpose
             'authorizationlogin' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/authlogin[/:action][/:id][/:pId][/:devId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                      ),
                     'defaults' => array(
                         'controller' => 'Authorization\Controller\Authorizationlogin',
                         'action'     => 'login',
                     ),
                 ),
             ),
             'authorizationsignup' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/authsignup[/:action][/:id][/:pId][/:devId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                     'defaults' => array(
                         'controller' => 'Authorization\Controller\Authorizationsignup',
                         'action'     => 'signup',
                     ),
                 ),
             ),
             
             
         ),
     ),
    
    


     'view_manager' => array(
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/albumlayout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
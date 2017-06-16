<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
     'controllers' => array(
         'invokables' => array(
             'Profile\Controller\Profile' => 'Profile\Controller\ProfileController',
             'Profile\Controller\Page' => 'Profile\Controller\PageController'
         ),
     ),
    // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             // this is for dashboard operation 
             'Profile' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/profile[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                         
                     ),
                     'defaults' => array(
                         'controller' => 'Profile\Controller\Profile',
                         'action'     => 'index',
                     ),
                 ),
             ),
            'Page' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/page[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                     ),
                     'defaults' => array(
                         'controller' => 'Profile\Controller\Page',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
         ),
     ),
    


	 'view_manager' => array(
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/profilelayout.phtml',
        ),
		 'template_path_stack' => array(
            __DIR__ . '/../view',
        )

    )
 );

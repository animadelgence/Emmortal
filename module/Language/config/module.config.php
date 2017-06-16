<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
     'controllers' => array(
         'invokables' => array(
             'Language\Controller\Profile' => 'Language\Controller\LanguageController'
         ),
     ),
    // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             // this is for dashboard operation 
             'Language' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/language[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Language\Controller\Profile',
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

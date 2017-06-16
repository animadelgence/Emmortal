<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
     'controllers' => array(
         'invokables' => array(
             'Payment\Controller\Payments' => 'Payment\Controller\PaymentsController'
             
         ),
     ),
    // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
             // this is for paymentsfp controller
             'Payments' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/payment[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Payment\Controller\Payments',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
             
         ),
     ),
    

    'view_manager' => array(
         /*'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/paymentlayout.phtml',

		),*/
		 'template_path_stack' => array(
            __DIR__ . '/../view',
        )

    )
 );

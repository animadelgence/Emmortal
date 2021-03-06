<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return array(
     'controllers' => array(
         'invokables' => array(
             'Album\Controller\Album' => 'Album\Controller\AlbumController',
             'Album\Controller\Newsfeed' => 'Album\Controller\NewsfeedController',
             'Album\Controller\Video' => 'Album\Controller\VideoController',
             'Album\Controller\Image' => 'Album\Controller\ImageController',
             'Album\Controller\Albumdetails' => 'Album\Controller\AlbumdetailsController',
             'Album\Controller\Tribute' => 'Album\Controller\TributeController',
             'Album\Controller\Notification' => 'Album\Controller\NotificationController',
             'Album\Controller\Lazyload' => 'Album\Controller\LazyloadController',
             'Album\Controller\Redirection' => 'Album\Controller\RedirectionController',
             'Album\Controller\Uploadoperation' => 'Album\Controller\UploadoperationController',
             'Album\Controller\Createalbum' => 'Album\Controller\CreatealbumController'

           
             
         ),
     ),
    // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Album\Controller',
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'showalbum',
                    ),
                ),
            ),
             // this is for controller
             'Album' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/album[/:action][/:id][/:pId]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Album',
                         'action'     => 'index',
                     ),
                 ),
             ),
             // this is for controller
             'Newsfeed' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/newsfeed[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
                         
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Newsfeed',
                         'action'     => 'news',
                     ),
                 ),
             ),

              // this is for controller
             'Video' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/video[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Video',
                         'action'     => 'news',
                     ),
                 ),
             ),
             'Tribute' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/tribute[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Tribute',
                         'action'     => 'news',
                     ),
                 ),
             ),

             'Image' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/image[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Image',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'Albumdetails' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/albumdetails[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Albumdetails',
                         'action'     => 'index',
                     ),
                 ),
             ),
             
                  'Lazyload' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/lazyload[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Lazyload',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'Notification' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/notification[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Notification',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'Createalbum' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/createalbum[/:action][/:id][/:pid]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Createalbum',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'Redirection' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/redirection[/:action][/:id][/:pid]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         
                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Redirection',
                         'action'     => 'index',
                     ),
                 ),
             ),
             'Uploadoperation' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/uploadoperation[/:action][/:id][/:pid]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',

                     ),
                     'defaults' => array(
                         'controller' => 'Album\Controller\Uploadoperation',
                         'action'     => 'index',
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


<?php
//echo http_response_code();

/**
* Global Configuration Override
*
* You can use this file for overriding configuration values from modules, etc.
* You would place values in here that are agnostic to the environment and not
* sensitive to security.
*
* @NOTE: In practice, this file will typically be INCLUDED in your source
* control, so do not include passwords or other sensitive information in this
* file.
*/

$string 			= file_get_contents($_SERVER['DOCUMENT_ROOT']."/setting.json");
$json 				= json_decode($string, true);
$path  				=  $json['domain']["home"];
$dynamicPathCreate	= explode("/",$path);

return array(
    'db' 				=> array(
        'driver' 			=> 'pdo_mysql',
        'dsn' 				=> $json['database']["database_dsn"],
        'username'       	=> $json['database']["database_username"],
        'password'      	=>  $json['database']["database_password"],
        'driver_options' 	=> array(
            1002 => 'SET NAMES \'UTF8\''
        ),
    ),

    'pathName' => array(
        'path' 	=>$dynamicPathCreate,
    ),
    'json' 	   => array(
        'jsonvariable' =>$json,
    ),
    'publish_domain' => array(
        'value'  => array($json['domain']["publish_domain"]),
    ),
    
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
       /* 'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        ),*/
    ),

    'view_manager' => array(
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
    ),
);

?>

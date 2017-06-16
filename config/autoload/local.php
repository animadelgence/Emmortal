<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */

return array(
	'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'mongodb://souvik:RL37pb25@sfpmongo-shard-00-00-4rviw.mongodb.net:27017,sfpmongo-shard-00-01-4rviw.mongodb.net:27017,sfpmongo-shard-00-02-4rviw.mongodb.net:27017/admin?ssl=true&replicaSet=sfpmongo-shard-0&authSource=admin',
                    'port'     => '3306',
                    'user'     => 'souvik',
                    'password' => 'RL37pb25',
                    'dbname'   => 'reportdata',
                )
            )
        )
    ),

);


<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}
defined('PUBLIC_PATH')
|| define('PUBLIC_PATH', realpath(dirname(__FILE__)));
defined('FILES_PATH')
|| define('FILES_PATH',PUBLIC_PATH . '/upload');
defined('FEATURE_PATH')
|| define('FEATURE_PATH',PUBLIC_PATH . '/feature');
defined('REFERENCE_PATH')
|| define('REFERENCE_PATH',PUBLIC_PATH . '/reference/upload');
defined('PRICING_PATH')
|| define('PRICING_PATH',PUBLIC_PATH . '/pricing');
defined('SCREENSHOT_PATH')
|| define('SCREENSHOT_PATH',PUBLIC_PATH . '/files');
// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();

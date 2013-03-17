<?php
header('Content-type: text/html; charset=utf-8');
date_default_timezone_set('Europe/Berlin');
//Locale::setDefault('en_US');
chdir(dirname(__DIR__));

if (preg_match('/^\/cms/', $_SERVER['REQUEST_URI'])) {
    defined('APP_SCOPE') || define('APP_SCOPE', 'backend');
} else {
    defined('APP_SCOPE') || define('APP_SCOPE', 'frontend');
}

defined('BASE_PATH') || define('BASE_PATH', realpath(__DIR__ . '/../'));
defined('VENDOR_PATH') || define('VENDOR_PATH', BASE_PATH . '/vendor');
defined('APPLICATION_PATH') || define('APPLICATION_PATH', BASE_PATH . '/application');
defined('LIB') || define('LIB', APPLICATION_PATH . '/library');
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'development');

// Setup autoloading
require BASE_PATH . '/init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require BASE_PATH . '/config/application.config.php')->run();

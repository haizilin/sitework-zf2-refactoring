<?php
if (!defined('VENDOR_PATH')) {

    // try to find path to required vendor librarys (Zend, Propel, ...)
    $vendorPath = false;

    if (getenv('ZF2_PATH')) {           // Support for ZF2_PATH environment variable or git submodule
        $vendorPath = getenv('ZF2_PATH');
    } elseif (get_cfg_var('zf2_path')) { // Support for zf2_path directive value
        $vendorPath = get_cfg_var('zf2_path');
    } else if (defined('VENDOR_PATH')) {
        $vendorPath = VENDOR_PATH;
    } elseif (is_dir(__DIR__ . '/vendor')) {
        $vendorPath = __DIR__ . '/vendor';
    }

    define('VENDOR_PATH', $vendorPath);
}

// Composer autoloading
if (is_file(__DIR__ . '/autoload.php')) {

    $loader = include           VENDOR_PATH . '/autoload.php';
    $loader->add('Zend',        VENDOR_PATH . '/Zend');
    $loader->add('ZendOAuth',   VENDOR_PATH . '/ZendOAuth');
    $loader->add('ZendService', VENDOR_PATH . '/ZendService');
    $loader->add('ZendRest',    VENDOR_PATH . '/ZendRest');
    $loader->add('ZendRest',    VENDOR_PATH . '/ZendRest');
    $loader->add('Propel',      VENDOR_PATH . '/Propel');
    $loader->add('Pear',        VENDOR_PATH . '/Pear');

}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {

    require_once VENDOR_PATH . '/Zend/Loader/AutoloaderFactory.php';
    Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array(
        'namespaces'      => array(
            'Zend'        => VENDOR_PATH . '/Zend',
            'ZendOAuth'   => VENDOR_PATH . '/ZendOAuth',
            'ZendService' => VENDOR_PATH . '/ZendService',
            'ZendRest'    => VENDOR_PATH . '/ZendRest',
            'Propel'      => VENDOR_PATH . '/Propel',
        ),
        'fallback_autoloader' => true
    )));
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load required librarys from vendor. Please define path to vendor as VENDOR_PATH');
}


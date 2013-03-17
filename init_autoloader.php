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

ini_set('include_path', implode(PATH_SEPARATOR, array(ini_get('include_path'), VENDOR_PATH . '/Pear')));

// Composer autoloading
if (is_file(__DIR__ . '/autoload.php')) {

    $loader = include           VENDOR_PATH . '/autoload.php';
    $loader->add('Zend',        VENDOR_PATH . '/Zend');
    $loader->add('Propel',      VENDOR_PATH . '/Propel');

}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {

    require_once VENDOR_PATH . '/Zend/Loader/AutoloaderFactory.php';
    Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array(
        'namespaces'      => array(
            'Zend'        => VENDOR_PATH . '/Zend',
            'Propel'      => VENDOR_PATH . '/Propel',
        ),
        'fallback_autoloader' => true
    )));
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load required librarys from vendor. Please define path to vendor as VENDOR_PATH');
}


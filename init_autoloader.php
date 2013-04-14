<?php
ini_set('include_path', implode(PATH_SEPARATOR, array(
    ini_get('include_path'),
    VENDOR_PATH . '/zf2',
    VENDOR_PATH . '/Pear',
    VENDOR_PATH . '/Propel'
)));

if (!class_exists('Zend\Loader\AutoloaderFactory')) {

    require_once 'Zend/Loader/AutoloaderFactory.php';
    Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array(
        'namespaces'      => array(
            'Zend'        => VENDOR_PATH . '/zf2/Zend',
            'Propel'      => VENDOR_PATH . '/Propel',
        ),
        'fallback_autoloader' => true
    )));
}

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load required librarys from vendor. Please define path to vendor as VENDOR_PATH');
}


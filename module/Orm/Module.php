<?php
namespace Orm;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\View\Helper\Navigation\Menu;
use \Propel;

require_once VENDOR_PATH . '/Propel/runtime/lib/Propel.php';

class Module implements AutoloaderProviderInterface
{
    public function getConfig() {
        \Propel::init(__DIR__ . '/config/PropelOrm-conf.php');
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
                'fallback_autoloader' => true,
            ),
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            )
        );
    }
}


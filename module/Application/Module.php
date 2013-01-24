<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
class Module
{
    public function onBootstrap(MvcEvent $e) {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    __NAMESPACE__ . '\Form' => __DIR__ . '/src/' . __NAMESPACE__ . '/Form',
                    __NAMESPACE__ . '\View' => __DIR__ . '/src/' . __NAMESPACE__ . '/View',
                    __NAMESPACE__ . '\Model' => __DIR__ . '/src/' . __NAMESPACE__ . '/Model',
                ),
                'fallback_autoloader' => true,
            ),
        );

    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getViewHelperConfig(){
        //return array( 'Formbutton'=>'Application\Form\View\Helper\Formbutton' );
    }
}

<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $this -> initAcl($e);
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function initAcl(MvcEvent $e)
    {
        $acl = new Acl();
        $config = (Array) $e->getApplication()->getServiceManager()->get('config');
        $roles = $config['acl'];
        $allResources = array();
        foreach ($roles as $role => $resources) {

            $role = new GenericRole($role);
            $acl->addRole($role);

            $allResources = array_merge($resources, $allResources);

            //adding resources
            foreach ($resources as $resource) {
                $acl->addResource(new GenericResource($resource));
            }
            //adding restrictions
            foreach ($allResources as $resource) {
                $acl->allow($role, $resource);
            }
        }
        //testing
        //var_dump($acl->isAllowed('admin','home'));
        //true

        //setting to view
        $e->getViewModel()->acl = $acl;

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

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'mailto' => 'Application\View\Helper\Mailto',
                'image' => 'Application\View\Helper\Image',
                'assets' => 'Application\View\Helper\Assets',
                'google' => 'Application\View\Helper\Google',
            ),
        );
    }
}

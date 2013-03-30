<?php
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'contact' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/contact',
                    'defaults' => array(
                        'controller'    => 'Application\Controller\Index',
                        'action'        => 'contact',
                    ),
                ),
            ),
            'imprint' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/imprint',
                    'defaults' => array(
                        'controller'    => 'Application\Controller\Index',
                        'action'        => 'imprint',
                    ),
                ),
            ),
            'disclaimer' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/disclaimer',
                    'defaults' => array(
                        'controller'    => 'Application\Controller\Index',
                        'action'        => 'disclaimer',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'default_navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'footer_navigation' => 'Application\Navigation\Service\FooterNavigationFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../../../data/language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'                => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index'      => __DIR__ . '/../view/application/index/index.phtml',
            'application/index/contact'    => __DIR__ . '/../view/application/index/contact.phtml',
            'application/index/imprint'    => __DIR__ . '/../view/application/index/imprint.phtml',
            'application/index/disclaimer' => __DIR__ . '/../view/application/index/disclaimer.phtml',
            'application/index/twitter'    => __DIR__ . '/../view/application/index/twitter.phtml',
            'error/404'                    => __DIR__ . '/../view/error/404.phtml',
            'error/index'                  => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'mailto' => 'Application\View\Helper\Mailto',
            'image' => 'Application\View\Helper\Image',
        ),
    ),
    'cache' => Zend\Cache\StorageFactory::factory(array(
        'adapter' => array(
            'name' => 'filesystem',
            'namespaceIsPrefix' => true,
            'options' => array(
                'cache_dir' => __DIR__ . '/../../../data/cache',
                'ttl' => 1000
            ),
        ),
        'plugins' => array(
            'exception_handler' => array(
                'throw_exceptions' => false
            ),
        )
    )),
);

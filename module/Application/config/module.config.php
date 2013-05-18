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
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'default_navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'footer_navigation' => 'Application\Navigation\Service\FooterNavigationFactory',
            'social_navigation' => 'Application\Navigation\Service\SocialNavigationFactory',
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
                'order' => 1
            ),
            array(
                'label' => 'Contact',
                'route' => 'contact',
                'order' => 3
            ),
        ),
        'footer' => array(
            array(
                'label' => 'Imprint',
                'route' => 'imprint',
                'order' => 1
            ),
            array(
                'label' => 'Disclaimer',
                'route' => 'disclaimer',
                'order' => 2
            ),
        ),
        'social' => array(
            array(
                'class' => 'icon-xing',
                'uri' => 'http://www.xing.com/profile/Matthias_Kruschke',
                'title' => 'Lesen Sie mein Profil bei XING.',
                'order' => 1
            ),
            array(
                'class' => 'icon-linkedin',
                'uri' => 'http://de.linkedin.com/pub/matthias-kruschke/42/a10/7a2/',
                'title' => 'Lesen Sie mein Profil bei LinkedIn.',
                'order' => 2
            ),
            array(
                'class' => 'icon-google-plus',
                'uri' => 'http://www.facebook.com/matthias.kruschke',
                'title' => 'Erfahren Sie mehr über mich bei google+.',
                'order' => 3
            ),
            array(
                'class' => 'icon-facebook',
                'uri' => 'http://www.facebook.com/matthias.kruschke',
                'title' => 'Erfahren Sie mehr über mich bei facebook.',
                'order' => 4
            ),
            array(
                'class' => 'icon-twitter',
                'uri' => 'http://twitter.com/sitewalker',
                'title' => 'Flgen Sie mir auf Twitter.',
                'order' => 5
            ),
            array(
                'class' => 'icon-github has-tooltip',
                'uri' => 'http://github.com/sitework',
                'title' => 'Forken Sie meine Projekte auf Github.',
                'order' => 6
            ),
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
    'cache' => Zend\Cache\StorageFactory::factory(array(
        'adapter' => array(
            'name' => 'filesystem',
            'namespaceIsPrefix' => true,
            'options' => array(
                'cache_dir' => __DIR__ . '/../../../data/cache',
                'ttl' => 1
            ),
        ),
        'plugins' => array(
            'exception_handler' => array(
                'throw_exceptions' => false
            ),
        )
    )),
);

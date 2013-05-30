<?php
return array(
    'router' => array(
        'routes' => array(
            'project' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/project[/:action][/:id]',
                    'constrains' => array(
                        'action' => '[a-zA-Z0-9_-]*',
                        'id' => '[0-9]+'
                    ),
                    'defaults' => array(
                        'controller' => 'Project\Controller\Project',
                        'action' => 'index'
                    )
                )
            )
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Project\Controller\Project' => 'Project\Controller\ProjectController'
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'project' => __DIR__ . '/../view'
        )
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Projekte',
                'route' => 'project',
                'order' => 2
            ),
        ),
    )
);

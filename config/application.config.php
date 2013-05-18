<?php
return array(
    'modules' => array(
        'Application',
        'Orm',
        'Project',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}' . (APPLICATION_ENV ?: 'production') . '.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);

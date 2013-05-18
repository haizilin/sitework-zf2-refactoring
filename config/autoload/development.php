<?php
/**
 * configure assets
 */
return array(
    'js' => array(
        'jquery-1.9.1.min.js',
        'custom.modernizr.min.js',
        'foundation.min.js',
        'src/sw.js'
    ),
    'css'  => array(
        'src/normalize.css',
        'src/foundation.css',
        'src/sw.css'
    ),
    'google' => array(
        'map' => array(
            'key' => 'AIzaSyDd46CEoMqOQK_WJW7fJxSkJQ66BW_3zac',
            'cache' => '/gfx/map',
        )
    ),
    'phpSettings' => array(
        'display_errors' => 'On',
        'display_startup_errors' => 'On',
        'error_reporting' => 'E_ALL & ~E_NOTICE',
    ),
);

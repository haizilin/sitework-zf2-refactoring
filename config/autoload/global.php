<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'phpSettings' => array(
        'display_errors' => 'On',
        'display_startup_errors' => 'On',
        'error_reporting' => 'E_ALL & ~E_NOTICE',
    ),
);

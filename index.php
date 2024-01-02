text/x-generic index.php ( PHP script, ASCII text, with CRLF line terminators )
<?php

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error
 * reporting. By default development will show errors but testing
 * and live will hide them.
 */
if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(-1);
            ini_set('display_errors', 1);
            break;

        case 'testing':
        case 'production':
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
            ini_set('display_errors', 0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
$systemDirectory = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory then the default one you can set its name here. The
 * directory can also be renamed or relocated anywhere on your server.
 * If you do, use an absolute (full) server path.
 *
 * For more info please see the user guide:
 *
 * https://codeigniter4.github.io/CodeIgniter4/general/environments.html
 */
$applicationDirectory = 'app';

/*
 *---------------------------------------------------------------
 * VIEW DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want to move the view directory out of the application
 * directory, set the path to the new location.
 * The path can be absolute or relative to this front controller.
 */
$viewDirectory = '';

/*
 * --------------------------------------------------------------------
 * LOAD OUR BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require realpath(__DIR__ . '/' . $systemDirectory) . '/bootstrap.php';

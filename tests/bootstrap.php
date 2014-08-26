<?php
// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

define('VENDOR_PATH', APPLICATION_PATH . '/../vendor');

define('TEST_CONFIGS_PATH', dirname(__FILE__) . '/configs');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH),
    realpath(APPLICATION_PATH . '/../library'),
    realpath(VENDOR_PATH . '/zwilias/zend-framework-1/src/'),
    get_include_path(),
)));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', 'testing');

/** Zend_Application */
require_once 'Zend/Application.php';
// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap('autoload');
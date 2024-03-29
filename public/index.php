<?php
// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

defined('PUBLIC_PATH')
|| define('PUBLIC_PATH', $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);

defined('UPLOAD_PATH')
|| define('UPLOAD_PATH', realpath(dirname(__FILE__) . '/../uploads'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
	realpath(APPLICATION_PATH . '/../library'),
	get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
	APPLICATION_ENV,
	APPLICATION_PATH . '/configs/application.ini'
);
try{
$application->bootstrap()
            ->run();
}
catch(Exception $e){
	echo $e->getMessage();
	exit();
}

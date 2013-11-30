<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

$appConfig = require 'config/application.config.php';

$coreModules = include 'config/core.modules.php';
$backendModules = include 'config/backend.modules.php';
$frontendModules = include 'config/frontend.modules.php';

$modules = array_merge($coreModules, $backendModules, $frontendModules);

$appConfig['modules'] = $modules;

// Run the application!
Zend\Mvc\Application::init($appConfig)->run();

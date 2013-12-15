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
require 'module/Application/src/Application/Bootstrap/BootstrapInterface.php';
require 'module/Application/src/Application/Bootstrap/AbstractBootstrap.php';
require 'module/Application/src/Application/Bootstrap/FrontendBootstrap.php';

\Application\Bootstrap\FrontendBootstrap::init();

\Application\Bootstrap\FrontendBootstrap::getServiceManager()
    ->get('Application')->bootstrap()->run();

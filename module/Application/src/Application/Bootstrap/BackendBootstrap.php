<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Bootstrap;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;
/**
 *  Bootstrap
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class BackendBootstrap
{
    protected static $serviceManager;

    public static function init()
    {
        include 'init_autoloader.php';
        
        // use ModuleManager to load core and backend modules
        $config = include 'config/application.config.php';
        
        $coreModules = include 'config/core.modules.php';
        $backendModules = include 'config/backend.modules.php.dist';
        
        $config['modules'] = array_merge($coreModules, $backendModules);

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        static::$serviceManager = $serviceManager;
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }
}

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
use Application\ModuleInclusion\ModuleIncludeManager;
/**
 *  Bootstrap
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class BackendBootstrap
{
    protected static $serviceManager;
    
    protected static $moduleIncludeManager;

    public static function init()
    {
        include_once 'init_autoloader.php';
        
        // use ModuleManager to load core and backend modules
        $config = include 'config/application.config.php';
        
        $config['modules'] = static::getModuleIncludeManager()->getBackendModulesList();

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        static::$serviceManager = $serviceManager;
    }

    public static function getServiceManager()
    {
        return static::$serviceManager;
    }
    
    /**
     * 
     * @return ModuleIncludeManager
     */
    public static function getModuleIncludeManager()
    {
        if (is_null(static::$moduleIncludeManager)) {
            static::$moduleIncludeManager = new ModuleIncludeManager();
        }
        
        return static::$moduleIncludeManager;
    }
    
    /**
     * 
     * @param ModuleIncludeManager $manager
     */
    public static function setModuleIncludeManager(ModuleIncludeManager $manager)
    {
        static::$moduleIncludeManager = $manager;
    }
    
    public static function reset()
    {
        static::$serviceManager = null;
        
    }
}

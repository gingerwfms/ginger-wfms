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
 *  BaseBootstrap
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
abstract class AbstractBootstrap
{
    protected static $serviceManager;
    
    protected static $moduleIncludeManager;
    
    public static function init()
    {
        include_once 'init_autoloader.php';
        
        // use ModuleManager to load core and backend modules
        $config = include 'config/application.config.php';
        
        $modules = static::getModulesList();
         
        $config['modules'] = array_keys($modules);
        
        $modulePaths = $config['module_listener_options']['module_paths'];
         
        foreach ($modules as $namespace => $packageNameOrDir) {
            switch ($packageNameOrDir) {
                case 'vendor':
                    //vendor dir is already registered in module paths
                    break;
                case 'module':
                    //module dir is already registered in module paths
                    break;
                default:
                    //packageName means direct mapping
                    $modulePaths[$namespace] = 'plugin/' 
                    . $packageNameOrDir . '/src/'
                    . $namespace;
                    
            }
        }
        
        $config['module_listener_options']['module_paths'] = $modulePaths;

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        static::$serviceManager = $serviceManager;
    }
    
    public static function getServiceManager()
    {
        if (is_null(static::$serviceManager)) {
            static::init();
        }
        
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
        static::$moduleIncludeManager = null;
        
    }
}

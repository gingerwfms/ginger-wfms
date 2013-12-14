<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\ModuleInclusion\Service;

use Application\ModuleInclusion\PluginHandler;
use Application\ModuleInclusion\ModuleIncludeManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
/**
 * ServiceFactory for PluginHandler
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class PluginHandlerFactory implements FactoryInterface
{
    /**
     * Create a new instance of PluginHandler
     * 
     * @param ServiceLocatorInterface $serviceLocator
     * 
     * @return PluginHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $pluginHandler = new PluginHandler($serviceLocator->get('module_include_manager'));
        
        return $pluginHandler;
    }

}

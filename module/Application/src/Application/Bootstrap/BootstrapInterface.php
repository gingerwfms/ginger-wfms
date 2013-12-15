<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Bootstrap;

use Zend\ServiceManager\ServiceLocatorInterface;
use Application\ModuleInclusion\ModuleIncludeManager;
/**
 *  BootstrapInterface
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
interface BootstrapInterface
{
    /**
     * Initialize the Ginger WfMS system
     */
    public static function init();
    
    /**
     * Get the ZF2 ServiceLocator
     * 
     * @return ServiceLocatorInterface
     */
    public static function getServiceManager();
    
    /**
     * 
     * @return ModuleIncludeManager
     */
    public static function getModuleIncludeManager();
    
    /**
     * Get list of modules that should be loaded
     */
    public static function getModulesList();
}

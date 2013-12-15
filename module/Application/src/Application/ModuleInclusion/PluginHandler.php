<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\ModuleInclusion;

use GingerPluginInstaller\Cqrs;
use Application\Exception;
/**
 * CQRS PluginHandler
 * 
 * Listen on events and commands coming from GingerPluginInstaller.
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class PluginHandler
{
    use \Malocher\Cqrs\Adapter\AdapterTrait;
    
    protected $moduleIncludeManager;
    
    /**
     * Construct
     * 
     * @param ModuleIncludeManager $manager
     */
    public function __construct(ModuleIncludeManager $manager)
    {
        $this->moduleIncludeManager = $manager;
    }

    /**
     * Register plugin in the backend or frontend depending on the type of the plugin
     * 
     * @param PluginInstalledEvent $event
     * @throws Exception\InvalidArgumentException If plugin type is unknown
     * 
     * @return void
     */
    public function onPluginInstalled(Cqrs\PluginInstalledEvent $event)
    {
        switch ($event->getPluginType()) {
            case 'ginger-backend-plugin':                    
                    $this->moduleIncludeManager->addBackendModule($event->getPluginNamespace());
                break;
            case 'ginger-frontend-plugin';
                    $this->moduleIncludeManager->addFrontendModule($event->getPluginNamespace());
                break;
            default:
                throw new Exception\InvalidArgumentException(
                    sprintf(
                        'Provided plugin typ is unknown -%s-',
                        $event->getPluginType()
                    )
                );
        }
    }
}

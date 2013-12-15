<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ApplicationTest\ModuleInclusion;

use ApplicationTest\TestCase;
use Application\ModuleInclusion\PluginHandler;
use Application\ModuleInclusion\ModuleIncludeManager;
use Application\Bootstrap\BackendBootstrap;
use GingerPluginInstaller\Cqrs;
/**
 *  PluginHandlerTest
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class PluginHandlerTest extends TestCase
{
    /**
     *
     * @var ModuleIncludeManager
     */
    protected $moduleIncludeManager;

    protected function setUp()
    {
        parent::setUp();
        
        $this->moduleIncludeManager = new ModuleIncludeManager(
            __DIR__ . '/../config'
        );
        
        $this->moduleIncludeManager->removeBackendModule('BackendTest');
        $this->moduleIncludeManager->removeFrontendModule('FrontendTest');
        
        BackendBootstrap::setModuleIncludeManager($this->moduleIncludeManager);
        
        BackendBootstrap::getServiceManager()->setAllowOverride(true);
        BackendBootstrap::getServiceManager()
            ->setService('module_include_manager', $this->moduleIncludeManager);
    }
    
    protected function tearDown()
    {
        BackendBootstrap::reset();
        @unlink(__DIR__ . '/../config/' . 'core.modules.php');
        @unlink(__DIR__ . '/../config/' . 'backend.modules.php');
        @unlink(__DIR__ . '/../config/' . 'frontend.modules.php');
    }
    
    public function testOnPluginInstalled_backendModule()
    {
        $pluginInstalledEvent = new Cqrs\PluginInstalledEvent(array(
            'plugin_namespace' => 'WfConfiguratorBackend',
            'plugin_name' => 'gingerwfms/wf-configurator-backend',
            'plugin_type' => 'ginger-backend-plugin',
            'version' => '1.0.0'
        ));        
        
        BackendBootstrap::getServiceManager()
            ->get('malocher.cqrs.gate')
            ->getBus()
            ->publishEvent($pluginInstalledEvent);
        
        $check = array(
            'GingerCore' => 'module',
            'MalocherCqrsModule' => 'vendor',
            'WfConfiguratorBackend' => 'gingerwfms/wf-configurator-backend'
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getBackendModulesList());
    }
    
    public function testOnPluginInstalled_frontendModule()
    {
        $pluginInstalledEvent = new Cqrs\PluginInstalledEvent(array(
            'plugin_namespace' => 'WfConfiguratorFrontend',
            'plugin_name' => 'gingerwfms/wf-configurator-frontend',
            'plugin_type' => 'ginger-frontend-plugin',
            'version' => '1.0.0'
        ));        
        
        BackendBootstrap::getServiceManager()
            ->get('malocher.cqrs.gate')
            ->getBus()
            ->publishEvent($pluginInstalledEvent);
        
        $check = array(
            'GingerCore' => 'module',
            'MalocherCqrsModule' => 'vendor',
            'WfConfiguratorFrontend' => 'gingerwfms/wf-configurator-frontend'
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getAllModulesList());
    }
}

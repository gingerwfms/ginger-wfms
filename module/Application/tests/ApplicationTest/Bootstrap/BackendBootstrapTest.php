<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace ApplicationTest\Bootstrap;

use ApplicationTest\TestCase;
use Application\ModuleInclusion\ModuleIncludeManager;
use Application\Bootstrap\BackendBootstrap;
/**
 *  BackendBootstrapTest
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class BackendBootstrapTest extends TestCase
{
    protected function setUp()
    {
        $moduleIncludeManager = new ModuleIncludeManager(
            __DIR__ . '/../config'
        );
        
        chdir(realpath(__DIR__ . '/../../../../..'));
        
        $moduleIncludeManager->removeBackendModule('BackendTest');
        $moduleIncludeManager->removeFrontendModule('FrontendTest');
        
        BackendBootstrap::setModuleIncludeManager($moduleIncludeManager);
    }
    
    protected function tearDown()
    {
        BackendBootstrap::reset();
        @unlink(__DIR__ . '/../config/' . 'core.modules.php');
        @unlink(__DIR__ . '/../config/' . 'backend.modules.php');
        @unlink(__DIR__ . '/../config/' . 'frontend.modules.php');
    }
    
    public function testInit()
    {
        BackendBootstrap::init();
        
        $this->assertInstanceOf(
            'Zend\ServiceManager\ServiceManager', 
            BackendBootstrap::getServiceManager()
        );
    }
}

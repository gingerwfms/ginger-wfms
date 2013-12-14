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
use Application\ModuleInclusion\ModuleIncludeManager;
/**
 *  ModuleIncludeManagerTest
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ModuleIncludeManagerTest extends TestCase
{
    /**
     *
     * @var ModuleIncludeManager
     */
    protected $moduleIncludeManager;

    protected function setUp()
    {
        $this->moduleIncludeManager = new ModuleIncludeManager(
            __DIR__ . '/../config'
        );
    }
    
    protected function tearDown()
    {
        @unlink(__DIR__ . '/../config/' . 'core.modules.php');
        @unlink(__DIR__ . '/../config/' . 'backend.modules.php');
        @unlink(__DIR__ . '/../config/' . 'frontend.modules.php');
    }
    
    public function testGetBackendModulesList()
    {
        $check = array(
            'CoreTest',
            'BackendTest'
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getBackendModulesList());
    }
    
    public function testGetAllModulesList()
    {
        $check = array(
            'CoreTest',
            'BackendTest',
            'FrontendTest'
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getAllModulesList());
    }
    
    public function testAddBackendModule()
    {
        $this->moduleIncludeManager->addBackendModule('MyBackendModule');
        
        $check = array(
            'CoreTest',
            'BackendTest',
            'MyBackendModule',
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getBackendModulesList());
    }
    
    public function testAddFrontendModule()
    {
        $this->moduleIncludeManager->addFrontendModule('MyFrontendModule');
        
        $check = array(
            'CoreTest',
            'BackendTest',
            'FrontendTest',
            'MyFrontendModule'
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getAllModulesList());
    }
    
    public function testRemoveBackendModule()
    {
        $this->moduleIncludeManager->addBackendModule('MyBackendModule');
        $this->moduleIncludeManager->removeBackendModule('MyBackendModule');
        
        $check = array(
            'CoreTest',
            'BackendTest',
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getBackendModulesList());
        
        $this->moduleIncludeManager->removeBackendModule('BackendTest');
        
        $check = array(
            'CoreTest',
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getBackendModulesList());                
    }
    
    public function testRemoveFrontendModule()
    {
        $this->moduleIncludeManager->addFrontendModule('MyFrontendModule');
        
        $this->moduleIncludeManager->removeFrontendModule('MyFrontendModule');
        
        $check = array(
            'CoreTest',
            'BackendTest',
            'FrontendTest',
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getAllModulesList());
        
        $this->moduleIncludeManager->removeFrontendModule('FrontendTest');
        
        $check = array(
            'CoreTest',
            'BackendTest',
        );
        
        $this->assertEquals($check, $this->moduleIncludeManager->getAllModulesList());
    }
}

<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\ModuleInclusion;

use Application\Exception;
use Zend\Config\Writer\PhpArray;
/**
 *  ModuleIncludeManager
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ModuleIncludeManager
{
    protected $configDir;
    
    public function __construct($configDir = null)
    {
        if (is_null($configDir)) {
            $configDir = 'config';
        }
        
        $this->configDir = $configDir;
    }
    
    public function getBackendModulesList()
    {
        $coreModules = $this->loadCoreModulesList();
        
        $backendModules = $this->loadBackendModulesList();
        
        return array_merge($coreModules, $backendModules);
    }
    
    public function getAllModulesList()
    {
        $backendModules = $this->getBackendModulesList();
        
        $frontendModules = $this->loadFrontendModulesList();
        
        return array_merge($backendModules, $frontendModules);
    }
    
    public function addBackendModule($name)
    {
        $backendModules = $this->loadBackendModulesList();
        
        $backendModules[] = $name;
        
        $this->writeFile($backendModules, 'backend.modules.php');
    }
    
    public function addFrontendModule($name)
    {
        $frontendModules = $this->loadFrontendModulesList();
        
        $frontendModules[] = $name;
        
        $this->writeFile($frontendModules, 'frontend.modules.php');
    }
    
    public function removeBackendModule($name)
    {
        $backendModules = $this->loadBackendModulesList();
        
        $index = array_search($name, $backendModules);
        
        unset($backendModules[$index]);
        
        $this->writeFile($backendModules, 'backend.modules.php');
    }
    
    public function removeFrontendModule($name)
    {
        $frontendModules = $this->loadFrontendModulesList();
        
        $index = array_search($name, $frontendModules);
        
        unset($frontendModules[$index]);
        
        $this->writeFile($frontendModules, 'frontend.modules.php');
    }
    
    protected function loadCoreModulesList()
    {
        return $this->readFile('core.modules.php');
    }

    protected function loadBackendModulesList()
    {
        return $this->readFile('backend.modules.php');
    }
    
    protected function loadFrontendModulesList()
    {
        return $this->readFile('frontend.modules.php');
    }

    protected function readFile($filename)
    {
        $file = $this->configDir . '/' . $filename;
        
        if (!file_exists($file)) {
            $distFile = $file . '.dist';
            
            if (!file_exists($distFile)) {
                throw new Exception\InvalidArgumentException(
                    sprintf(                    
                        'Provided filename -%s- does not match with an existing module list file',
                        $filename
                    )
                );
            }
            
            $success = @copy($distFile, $file);
            
            if (!$success) {
                throw new Exception\RuntimeException(
                    sprintf(
                        'Can not rename -%s-. Permission denied.',
                        $distFile                        
                    )
                );
            }
        }
        
        $moduleList = include $file;
        
        return $moduleList;
    }
    
    protected function writeFile(array $modules, $filename)
    {
        $file = $this->configDir . '/' . $filename;
        
        $configWriter = new PhpArray();
        
        $configWriter->toFile($file, $modules);
    }
}

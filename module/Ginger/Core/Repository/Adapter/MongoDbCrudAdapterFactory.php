<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Repository\Adapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Ginger\Core\Exception\RuntimeException;
/**
 * Factory MongoDbCrudAdapterFactory
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class MongoDbCrudAdapterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('configuration');
        
        if (!isset($config['crud_adapter'])) {
            throw new RuntimeException('Missing configuration key <crud_adapter>.');
        }
        
        $crudAdapterConfig = $config['crud_adapter'];
        
        if (!isset($crudAdapterConfig['mongodb'])) {
            throw new RuntimeException('Missing configuration for the mongoDB CRUD repository adapter.');
        }
        
        if (!isset($crudAdapterConfig['mongodb']['database'])) {
            throw new RuntimeException('Missing database configuration for the mongoDB CRUD repository adapter.');
        }
        
        $mongoDbConfig = array();
        
        if (isset($crudAdapterConfig['mongodb']['server'])) {
            $mongoDbConfig['server'] = $crudAdapterConfig['mongodb']['server'];
        }
        
        if (isset($crudAdapterConfig['mongodb']['options'])) {
            $mongoDbConfig['options'] = $crudAdapterConfig['mongodb']['options'];
        }
        
        return new MongoDbCrudRepositoryAdapter($crudAdapterConfig['mongodb']['database'], $mongoDbConfig);
    }
}

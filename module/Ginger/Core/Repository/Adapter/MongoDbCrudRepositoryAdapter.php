<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Repository\Adapter;

use MongoClient;
use MongoDB;
use MongoId;
use Zend\Stdlib\ArrayUtils;
use Ginger\Core\Exception\InvalidArgumentException;
use Ginger\Core\Repository\Resource;
/**
 *  MongoDbCrudRepositoryAdapter
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class MongoDbCrudRepositoryAdapter implements CrudRepositoryAdapterInterface
{
    /**
     *
     * @var MongoDB
     */
    protected $mongoDb;
    
    /**
     * Construct
     * 
     * @param string $database
     * @param array $mongoConfig
     * 
     * @throws InvalidArgumentException
     */
    public function __construct($database, array $mongoConfig = array())
    {
        if (!is_string($database) || empty($database)) {
            throw new InvalidArgumentException('MongoDB database is not valid.');
        }
        
        $defaultConfig = array(
            'server' => 'mongodb://localhost:27017',
            'options' => array(
                'connect' => true
            )
        );
        
        $mongoConfig = ArrayUtils::merge($defaultConfig, $mongoConfig);
        
        $mongoClient = new MongoClient($mongoConfig['server'], $mongoConfig['options']);
        
        $this->mongoDb = $mongoClient->selectDB($database);
    }

    /**
     * {@inheritDoc}
     */
    public function createResource(Resource\ResourceType $resourceType, Resource\ResourceData $resourceData)
    {
        try {
            $collection = $this->mongoDb->selectCollection($resourceType->getValue());

            $data = $resourceData->getData();

            $collection->insert($data);

            $id = (string)$data['_id'];

            if (empty($id)) {
                throw new RuntimeException('Oooppsss,the MongoDbAdapter returned no _id.');
            }

            return new Resource\ResourceId($id);
        } catch (RuntimeException $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw new RuntimeException('Creating resource failed. See previous exception for more details', null, $ex);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function deleteResource(Resource\ResourceType $resourceType, Resource\ResourceId $resourceId)
    {
        try {
            $mongoId = new MongoId($resourceId->getValue());
        
            $collection = $this->mongoDb->selectCollection($resourceType->getValue());   
            
            $result = $collection->remove(array('_id' => $mongoId), array("justOne" => true));
            
            if ($result['n'] != 1) {
                throw new RuntimeException(
                    sprintf(
                        'Resource with id <%s> could not be deleted, cause resource was not found in database.',
                        $resourceId->getValue()
                    )
                );
            }
        } catch (RuntimeException $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw new RuntimeException('Creating resource failed. See previous exception for more details', null, $ex);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getResource(Resource\ResourceType $resourceType, Resource\ResourceId $resourceId)
    {
        try {
            $collection  = $this->mongoDb->selectCollection($resourceType->getValue());
            
            $mongoId = new MongoId($resourceId->getValue());
            
            $doc = $collection->findOne(array('_id' => $mongoId));
            
            if ($doc) {
                return $this->hydrateResourceData($doc);
            } else {
                return null;
            }
        } catch (RuntimeException $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw new RuntimeException('Get resource failed. See previous exception for more details', null, $ex);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getResources(Resource\ResourceType $resourceType)
    {
        try {
            $collection  = $this->mongoDb->selectCollection($resourceType->getValue());
            
            $docSet =  $collection->find();
            
            $resourceDTOs = array();
            
            foreach ($docSet as $doc) {
                $resourceDTOs[] = $this->hydrateResourceData($doc);
            }
            
            return $resourceDTOs;
        } catch (RuntimeException $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw new RuntimeException('Get resources failed. See previous exception for more details', null, $ex);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function updateResource(Resource\ResourceType $resourceType, Resource\ResourceData $resourceData)
    {
        try {
            $collection = $this->mongoDb->selectCollection($resourceType->getValue());
            
            $updateData = $resourceData->getData();
            
            $mongoId = new MongoId($resourceData->getResourceId()->getValue());
            
            $result = $collection->update(
                array('_id' => $mongoId), 
                array(
                    '$set' => $updateData
                )
            );
            
            if ($result['n'] != 1) {
                throw new RuntimeException(
                    sprintf(
                        'Resource with id <%s> could not be updated, cause resource was not found in database.',
                        $resourceData->getResourceId()
                    )
                );
            }
            
            return $this->getResource($resourceType, $resourceData->getResourceId());
        } catch (RuntimeException $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw new RuntimeException('Updating resource failed. See previous exception for more details', null, $ex);
        }
    }
    
    /**
     * 
     * @param array $mongoDoc
     * 
     * @return Resource\ResourceData
     */
    protected function hydrateResourceData(array $mongoDoc)
    {
        $id = (string)$mongoDoc['_id'];
        
        unset($mongoDoc['_id']);
        
        $resourceId = new Resource\ResourceId($id);
        
        $resourceData = new Resource\ResourceData($resourceId);
        
        $resourceData->setData($mongoDoc);
        
        return $resourceData;
    }
}

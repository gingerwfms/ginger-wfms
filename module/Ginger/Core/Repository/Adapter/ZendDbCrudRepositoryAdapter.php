<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Repository\Adapter;

use Zend\Db\Adapter\Adapter as ZendDbAdapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Json\Json;
use Ginger\Core\Repository\Resource;
use Ginger\Core\Exception\RuntimeException;
/**
 * Class ZendDbCrudRepositoryAdapter
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ZendDbCrudRepositoryAdapter implements CrudRepositoryAdapterInterface
{
    /**
     *
     * @var ZendDbAdapter
     */
    protected $zendDbAdapter;
    
    /**
     *
     * @var TableGateway[]
     */
    protected $tableGateways = array();
    
    public function __construct(ZendDbAdapter $zendDbAdapter)
    {
        $this->zendDbAdapter = $zendDbAdapter;
    }

    /**
     * {@inheritDoc}
     */
    public function createResource(Resource\ResourceType $resourceType, Resource\ResourceData $resourceData)
    {
        try {
            $tableGateway = $this->getTablegateway($resourceType);
            
            $data = $resourceData->getData();
            
            $jsonData = Json::encode($data);
            
            $tableGateway->insert(array('data' => $jsonData));
            
            $lastInsertId = $tableGateway->getLastInsertValue();
            
            if ($lastInsertId <= 0) {
                throw new RuntimeException('Oooppsss,the ZendDbAdapter returned no insertId.');
            }
            
            return new Resource\ResourceId((string)$lastInsertId);
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
            $tableGateway = $this->getTablegateway($resourceType);
            
            $affectedRows = $tableGateway->delete(array('id' => (int)$resourceId->getValue()));
            
            if ($affectedRows <= 0) {
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
            $tableGateway  = $this->getTablegateway($resourceType);
            
            $row = $tableGateway->select(array('id' => $resourceId->getValue()))->current();
            
            if ($row) {
                return $this->hydrateResourceData($row->id, $row->data);
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
            $tableGateway  = $this->getTablegateway($resourceType);
            
            $rowSet =  $tableGateway->select();
            
            $resourceDTOs = array();
            
            foreach ($rowSet as $row) {
                $resourceDTOs[] = $this->hydrateResourceData($row->id, $row->data);
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
            $tableGateway = $this->getTablegateway($resourceType);
            
            $updateData = $resourceData->getData();
            
            $resource = $this->getResource($resourceType, $resourceData->getResourceId());
            $data = $resource->getData();
            
            $mergedData = array_merge($data, $updateData);
            
            $jsonDataStr = Json::encode($mergedData);
            
            $affectedRows = $tableGateway->update(
                array('data' => $jsonDataStr), 
                array('id' => (int)$resourceData->getResourceId()->getValue())
            );
            
            if ($affectedRows <= 0) {
                throw new RuntimeException(
                    sprintf(
                        'Resource with id <%s> could not be updated, cause resource was not found in database.',
                        $resourceData->getResourceId()
                    )
                );
            }
            
            $updatedResource = new Resource\ResourceData($resourceData->getResourceId());
            $updatedResource->setData($mergedData);
            
            return $updatedResource;
        } catch (RuntimeException $ex) {
            throw $ex;
        }
        catch (Exception $ex) {
            throw new RuntimeException('Updating resource failed. See previous exception for more details', null, $ex);
        }
    }
    
    /**
     * Get the corresponding Tablegateway of the given ResourceType
     * 
     * @param Resource\ResourceType $resourceType
     * 
     * @return TableGateway
     */
    protected function getTablegateway(Resource\ResourceType $resourceType)
    {
        $type = $resourceType->getValue();
        
        if (!isset($this->tableGateways[$type])) {
            $this->tableGateways[$type] = new TableGateway($type, $this->zendDbAdapter);
        }
        
        return $this->tableGateways[$type];
    }
    
    /**
     * 
     * @param string $resourceId
     * @param string $jsonDataStr
     * 
     * @return Resource\ResourceData
     */
    protected function hydrateResourceData($resourceId, $jsonDataStr)
    {
        $resourceId = new Resource\ResourceId($resourceId);
        $resourceDTO = new Resource\ResourceData($resourceId);
        $resourceDTO->setData(Json::decode($jsonDataStr, Json::TYPE_ARRAY));
        
        return $resourceDTO;
    }
}

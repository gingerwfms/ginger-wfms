<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Repository;
/**
 *  AbstractCrudRepository
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class AbstractCrudRepository implements CrudRepositoryInterface
{
    /**
     *
     * @var Adapter\CrudRepositoryAdapterInterface
     */
    protected $crudRepositoryAdapter;
    
    /**
     *
     * @var Resource\ResourceType
     */
    protected $resourceType;

    /**
     * Construct
     * 
     * @param Resource\ResourceTpe $resourceType
     * @param Adapter\CrudRepositoryAdapterInterface $adapter
     */
    public function __construct(
        Resource\ResourceType $resourceType,
        Adapter\CrudRepositoryAdapterInterface $adapter)
    {
        $this->resourceType = $resourceType;
        $this->crudRepositoryAdapter = $adapter;
    }
    
    /**
     * Create a new resource
     * 
     * @param Resource\ResourceData $resourceData
     * 
     * @return Resource\ResourceId
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If create could not be performed
     */
    public function create(Resource\ResourceData $resourceData)
    {
        return $this->crudRepositoryAdapter->createResource($this->resourceType, $resourceData);
    }

    /**
     * Delete Resource by it's resource id
     * 
     * @param Resource\ResourceId $resourceId
     * 
     * @return void
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If deletion could not be performed
     */
    public function delete(Resource\ResourceId $resourceId)
    {
        $this->crudRepositoryAdapter->deleteResource($this->resourceType, $resourceId);
    }
    
    /**
     * Update resource data
     * 
     * @param Resource\ResourceData $resourceData Contains all data that should be updated
     * 
     * @return Resource\ResourceData All data of resource including the updated properties
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If update could not be performed
     */
    public function update(Resource\ResourceData $resourceData)
    {
        return $this->crudRepositoryAdapter->updateResource($this->resourceType, $resourceData);
    }

    /**
     * Read data for a single resource
     * 
     * @param Resource\ResourceId $resourceId
     * 
     * @return ResourceData|null
     */
    public function read(Resource\ResourceId $resourceId)
    {
        return $this->crudRepositoryAdapter->getResource($this->resourceType, $resourceId);
    }

    /**
     * Get all resources
     * 
     * @param array $filter Simple Key/Value criteria mapping
     * 
     * @return Resource\ResourceData[]
     */
    public function listAll()
    {
        return $this->crudRepositoryAdapter->getResources($this->resourceType);
    }
}

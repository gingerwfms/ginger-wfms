<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Repository\Adapter;

use Ginger\Core\Repository\Resource;
/**
 * Interface CrudRepositoryAdapterInterface
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
interface CrudRepositoryAdapterInterface
{
    /**
     * Create a new resource of given type
     * 
     * @param Resource\ResourceType $resourceType
     * @param Resource\ResourceData $resourceData
     * 
     * @return Resource\ResourceId
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If create could not be performed
     */
    public function createResource(
        Resource\ResourceType $resourceType,
        Resource\ResourceData $resourceData
    );
    
    /**
     * Update Reource of given type with given data
     * 
     * @param Resource\ResourceType $resourceType
     * @param Resource\ResourceData $resourceData
     * 
     * @return void
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If update could not be performed
     */
    public function updateResource(
        Resource\ResourceType $resourceType,
        Resource\ResourceData $resourceData
    );
    
    /**
     * Delete Resource of given type and ResourceId
     * 
     * @param Resource\ResourceType $resourceType
     * @param Resource\ResourceId   $resourceId
     * 
     * @return void
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If deletion could not be performed
     */
    public function deleteResource(
        Resource\ResourceType $resourceType,
        Resource\ResourceId $resourceId
    );
    
    /**
     * Get Resource of given type and ResourceId
     * 
     * @param Resource\ResourceType $resourceType
     * @param Resource\ResourceId   $resourceId
     * 
     * @return ResourceData|null
     * 
     */
    public function getResource(
        Resource\ResourceType $resourceType,
        Resource\ResourceId $resourceId
    );
    
    /**
     * Get Resources of given type
     * 
     * @param ResourceType $resourceType
     * 
     * @return ResourceData[]
     */
    public function getResources(
        Resource\ResourceType $resourceType
    );
}

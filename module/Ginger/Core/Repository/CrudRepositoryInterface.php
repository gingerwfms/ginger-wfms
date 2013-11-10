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
 * CrudRepositoryInterface
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
interface CrudRepositoryInterface
{
    /**
     * Find data for a single resource
     * 
     * @param ResourceId|string $resourceId
     * 
     * @return ResourceData|null
     */
    public function find($resourceId);
    
    /**
     * Get all/filtered set of resources
     * 
     * @param array $filter Simple Key/Value criteria mapping (all critera must match)
     * @return ResourceData[]
     */
    public function findAll(array $filter);
    
    /**
     * Create new resource from given ResourceData
     * 
     * @param ResourceData $resourceData
     * 
     * @return ResourceData Contains the new assigned ResourceId
     */
    public function create(ResourceData $resourceData);
    
    /**
     * Update resource data
     * 
     * @param ResourceData $resourceData Contains all data that should be updated
     * 
     * @return ResourceData All data of resource including the updated properties
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If update could not be performed
     */
    public function update(ResourceData $resourceData);
    
    /**
     * Delete the resource
     * 
     * @param ResourceId|string $resourceId
     * 
     * @return void
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If deletion could not be performed
     */
    public function delete($resourceId);
}

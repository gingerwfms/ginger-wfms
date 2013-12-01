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
     * @param Resource\ResourceId $resourceId
     * 
     * @return ResourceData|null
     */
    public function read(Resource\ResourceId $resourceId);
    
    /**
     * Get all resources
     *      
     * @return ResourceData[]
     */
    public function listAll();
    
    /**
     * Create new resource from given ResourceData
     * 
     * @param Resource\ResourceData $resourceData
     * 
     * @return Resource\ResourceId
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If create could not be performed
     */
    public function create(Resource\ResourceData $resourceData);
    
    /**
     * Update resource data
     * 
     * @param Resource\ResourceData $resourceData Contains all data that should be updated
     * 
     * @return Resource\ResourceData All data of resource including the updated properties
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If update could not be performed
     */
    public function update(Resource\ResourceData $resourceData);
    
    /**
     * Delete the resource
     * 
     * @param Resource\ResourceId $resourceId
     * 
     * @return void
     * 
     * @throws \Ginger\Core\Exception\RuntimeException If deletion could not be performed
     */
    public function delete(Resource\ResourceId $resourceId);
}

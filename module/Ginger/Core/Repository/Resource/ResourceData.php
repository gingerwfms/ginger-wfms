<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Repository\Resource;

/**
 * Resource class ResourceData
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ResourceData
{
    /**
     *
     * @var ResourceId
     */
    protected $resourceId;
    
    /**
     *
     * @var array
     */
    protected $data;
    /**
     * Construct ResourceData with ResourceId
     * 
     * If it is data of a new resource the ResourceId is null
     * 
     * @param ResourceId $resourceId
     */
    public function __construct(ResourceId $resourceId = null)
    {
        $this->resourceId = $resourceId;
    }
    
    /**
     * Get assigned ResourceId
     * 
     * @return ResourceId|null
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }
    
    /**
     * Set resource data without ResourceId
     * 
     * @param array $resourceData
     * 
     * @return void
     */
    public function setData(array $resourceData)
    {
        $this->data = $resourceData;
    }
    
    /**
     * Get resource data without ResourceId
     * 
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}

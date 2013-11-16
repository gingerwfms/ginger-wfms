<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Repository\Resource;

use Ginger\Core\Exception\InvalidArgumentException;
use Ginger\Core\Util\Util;
/**
 * Resource class ResourceId
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ResourceId
{
    /**
     *
     * @var string
     */
    protected $value;

    /**
     * Construct with the string representation of the ResourceId
     * 
     * @param string $resourceId
     */
    public function __construct($resourceId)
    {
        if (!is_string($resourceId)) {
            throw new InvalidArgumentException(
                sprintf(
                    'ResourceId must be of type string, <%s> given',
                    Util::getType($resourceId)
                )
            );
        }
        
        if (empty($resourceId)) {
            throw new InvalidArgumentException('ResourceId must not be empty');
        }
        
        $this->value = (string)$resourceId;
    }
    
    /**
     * Get the string representation of the ResourceId
     * 
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    
    public function __toString()
    {
        return $this->getValue();
    }
}

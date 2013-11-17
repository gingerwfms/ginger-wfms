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
/**
 * Value Object ResourceType
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class ResourceType
{
    protected $allowedTypes = array(
        'workflow',
        'task',
        'item',
        'action',
        'command',
        'query',
        'event',
        'config',
    );
    
    /**
     * @var string
     */
    protected $type;

    /**
     * Construct
     * 
     * @param string $type
     * @throws InvalidArgumentException
     */
    public function __construct($type)
    {
        if (!in_array($type, $this->allowedTypes)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Given type <%s> is not an allowed resource type.',
                    $type
                )
            );
        }
        
        $this->type = $type;
    }
    
    /**
     * Get string representation of the type
     * 
     * @return string
     */
    public function getValue()
    {
        return $this->type;
    }
}

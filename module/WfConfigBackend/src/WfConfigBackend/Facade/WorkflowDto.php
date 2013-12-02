<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WfConfigBackend\Facade;

/**
 *  Workflow
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class WorkflowDto
{
    /**
     * @var string
     */
    private $id;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $description;
    
    /**
     * Get id.
     * 
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get description
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set id.
     * 
     * @param string $id
     * @return Workflow
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set name.
     * 
     * @param string $name
     * 
     * @return Workflow
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set description
     * 
     * @param string $description
     * @return Workflow
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    
    /**
     * Get data as array.
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        $data = array(            
            'name' => $this->getName(),
            'description' => $this->getDescription()
        );
        
        if (!is_null($this->getId())) {
            $data['id'] = $this->getId();
        }
        
        return $data;
    }
    
    /**
     * Populate Workflow with data. 
     * 
     * @param array $workflowData
     */
    public function populate(array $workflowData)
    {
        if (isset($workflowData['id'])) {
            $this->setId($workflowData['id']);
        }
        
        if (isset($workflowData['name'])) {
            $this->setName($workflowData['name']);
        }
        
        if (isset($workflowData['description'])) {
            $this->setDescription($workflowData['description']);
        }
    }
}

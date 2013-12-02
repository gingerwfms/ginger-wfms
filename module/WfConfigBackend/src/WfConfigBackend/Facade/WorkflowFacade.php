<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WfConfigBackend\Facade;

use WfConfigBackend\Model\Workflow\WorkflowRepository;
use Ginger\Core\Repository\Resource;
/**
 * WorkflowService
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class WorkflowFacade
{
    /**
     *
     * @var WorkflowRepository 
     */
    protected $workflowRepository;
    
    /**
     * Create a new Workflow config.
     * 
     * @param WorkflowDto $workflow
     * 
     * @return Workflow
     */
    public function create(WorkflowDto $workflow)
    {
        $resourceData = new Resource\ResourceData();
        $resourceData->setData($workflow->getArrayCopy());
        $id = $this->workflowRepository->create($resourceData);
        $workflow->setId($id->getValue());
        return $workflow;
    }
    
    /**
     * Get workflow by id.
     * 
     * @param string $id
     * 
     * @return WorkflowDto
     */
    public function get($id)
    {
        $resourceId = new Resource\ResourceId($id);
        
        $data = $this->workflowRepository->read($resourceId);
        
        $workflow = new WorkflowDto();
        $workflow->populate($data->getData());
        $workflow->setId($data->getResourceId()->getValue());
        
        return $workflow;
    }
    
    /**
     * Get list of all workflows.
     * 
     * @return WorkflowDto[]
     */
    public function listAll()
    {
        $list = $this->workflowRepository->listAll();
        
        $workflowCollection = array();
        
        foreach ($list as $workflowData) {
            $workflow = new WorkflowDto();
            $workflow->populate($workflowData->getData());
            $workflow->setId($workflowData->getResourceId()->getValue());
            $workflowCollection[] = $workflow;
        }
        
        return $workflowCollection;
    }
    
    /**
     * Set Worklfow repository
     * 
     * @param WorkflowRepository $workflowRepository
     */
    public function setWorkflowRepository(WorkflowRepository $workflowRepository)
    {
        $this->workflowRepository = $workflowRepository;
    }
}

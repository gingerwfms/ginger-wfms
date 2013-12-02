<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WfConfigFrontend\Rest;

use Ginger\Core\Controller\AbstractRestfulController;
use WfConfigBackend\Facade\WorkflowFacade;
use WfConfigBackend\Facade\WorkflowDto;
use Zend\View\Model\JsonModel;
/**
 *  WorkflowService
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class WorkflowService extends AbstractRestfulController
{
    /**
     * Backend workflow facade
     * 
     * @var WorkflowFacade 
     */
    protected $workflowFacade;
    
    public function create($data)
    {
        $workflow = new WorkflowDto();
        $workflow->populate($data);
        
        $this->getWorkflowFacade()->create($workflow);
        
        return new JsonModel($workflow->getArrayCopy());
    }
    
    public function getList()
    {
        $workflowCollection = $this->getWorkflowFacade()->listAll();
        
        $list = array();
        
        foreach ($workflowCollection as $workflow) {
            $list[] = $workflow->getArrayCopy();
        }
        
        return new JsonModel($list);
    }
    /**
     * Get the backend workflow facade
     * 
     * @return WorkflowFacade
     */
    protected function getWorkflowFacade()
    {
        if (is_null($this->workflowFacade)) {
            $this->workflowFacade = $this->getServiceLocator()->get('workflow_config_facade');
        }
        
        return $this->workflowFacade;
    }
}

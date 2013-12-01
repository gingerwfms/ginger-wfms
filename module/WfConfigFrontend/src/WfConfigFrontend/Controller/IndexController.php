<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WfConfigFrontend\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use WfConfigBackend\Facade\WorkflowFacade;
/**
 * MVC Controller IndexController
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class IndexController extends AbstractActionController
{
    /**
     *
     * @var WorkflowFacade
     */
    protected $workflowFacade;

    /**
     * Display list of all workflows
     * 
     * @return array
     */
    public function indexAction()
    {
        $list = $this->getWorkflowFacade()->listAll();        
        
        return array('workflowList' => $list);
    }
    
    /**
     * Start workflow configurator for given workflow.
     * 
     * @return array
     */
    public function startAction()
    {
        $workflow = $this->getWorkflowFacade()
            ->get($this->getEvent()
            ->getRouteMatch()
            ->getParam('id', ''));
        
        return array('workflow' => $workflow);
    }
    
    /**
     * Autoload and get worklow facade
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
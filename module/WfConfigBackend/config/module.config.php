<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
return array(
    'service_manager' => array(
        'factories' => array(
            'workflow_config_repositoy' => 'WfConfigBackend\Model\Workflow\Service\WorkflowRepositoryFactory',
            'workflow_config_facade' => function($sm) {
                $wfFacade = new \WfConfigBackend\Facade\WorkflowFacade();
                $wfFacade->setWorkflowRepository($sm->get('workflow_config_repositoy'));
                return $wfFacade;
            }
        )
    )
);
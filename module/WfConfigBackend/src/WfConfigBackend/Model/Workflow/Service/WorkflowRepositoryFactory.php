<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WfConfigBackend\Model\Workflow\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use WfConfigBackend\Model\Workflow\WorkflowRepository;
/**
 *  WorkflowRepositoryFactory
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class WorkflowRepositoryFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new WorkflowRepository($serviceLocator->get('crud_repository_adapter'));
    }
}

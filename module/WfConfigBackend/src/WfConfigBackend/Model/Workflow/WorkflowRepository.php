<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WfConfigBackend\Model\Workflow;

use Ginger\Core\Repository\AbstractCrudRepository;
use Ginger\Core\Repository\Adapter\CrudRepositoryAdapterInterface;
/**
 *  WorkflowRepository
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class WorkflowRepository extends AbstractCrudRepository
{
    public function __construct(CrudRepositoryAdapterInterface $adapter)
    {
        parent::__construct(new WorkflowType(), $adapter);
    }
}

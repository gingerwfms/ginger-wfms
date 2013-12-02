<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Controller;

use Zend\Mvc\Controller\AbstractRestfulController as ZendAbstractRestfulController;
use Zend\Mvc\MvcEvent;
/**
 *  AbstractRestfulController
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class AbstractRestfulController extends ZendAbstractRestfulController
{
    /**
     * Handle the request
     *
     * @param  MvcEvent $e
     * @return mixed
    */
    public function onDispatch(MvcEvent $e)
    {
        try {
            parent::onDispatch($e);
        } catch (\Exception $e) {
            return $this->getResponse()->setStatusCode(500)->setContent($e->__toString());
        }
    }
}

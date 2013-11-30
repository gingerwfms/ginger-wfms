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
use Zend\View\Model\ViewModel;
/**
 * MVC Controller IndexController
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('workflow-configurator/index/index.phtml');
        return new $viewModel;
    }
}
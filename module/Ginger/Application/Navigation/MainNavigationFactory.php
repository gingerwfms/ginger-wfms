<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Application\Navigation;

use Zend\Navigation\Service\AbstractNavigationFactory;
/**
 *  MainNavigationFactory
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class MainNavigationFactory extends AbstractNavigationFactory
{
    protected function getName()
    {
        return 'main_navigation';
    }

}

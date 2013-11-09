<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Test;
/**
 * Ginger Test Module
 * 
 * The Ginger\Test\Module is included in the ZF2 setup when Ginger\Core\Bootstrap::init
 * is called with the $activateTestEnv = true flag.
 * It provides some special configuration only used during testing.
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        //autoloading is defined in the composer.json file
        return array();
    }
}

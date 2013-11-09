<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core;

/**
 * Module class for Ginger\Core
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

<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Application\Bootstrap;

/**
 *  Bootstrap
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class BackendBootstrap extends AbstractBootstrap
{
    public static function getModulesList()
    {
        return static::getModuleIncludeManager()->getBackendModulesList();
    }
}

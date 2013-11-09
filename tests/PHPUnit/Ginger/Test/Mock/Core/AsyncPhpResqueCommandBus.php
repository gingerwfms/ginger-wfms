<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Test\Mock\Core;

use Ginger\Core\Cqrs\Bus\AsyncPhpResqueCommandBus as RealAsyncPhpResqueCommandBus;
/**
 *  AsyncPhpResqueCommandBus
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class AsyncPhpResqueCommandBus extends RealAsyncPhpResqueCommandBus
{
    /**
     * We override the parent method to bootstrap the Ginger\Core 
     * with the activateTestEnv flag set to true
     */
    public function setUp()
    {
        chdir(__DIR__ . '/../../../../../../');

        require_once 'module/Ginger/Core/Bootstrap.php';
        
        $activateTestEnv = true;

        \Ginger\Core\Bootstrap::init($activateTestEnv);
    }
}

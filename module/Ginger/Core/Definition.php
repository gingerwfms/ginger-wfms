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
 * Definition class
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class Definition
{
    const ASYNC_COMMAND_BUS = 'async-command-bus';
    
    const ASYNC_COMMAND_QUEUE = 'ginger-command-queue';
    
    const SYNC_BUS = 'sync-bus';
}

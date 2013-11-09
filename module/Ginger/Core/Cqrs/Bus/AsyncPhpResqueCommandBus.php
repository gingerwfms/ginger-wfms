<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Cqrs\Bus;

use Cqrs\Command\CommandInterface;
use Ginger\Core\Definition;
/**
 * Special async CQRS CommandBus with a link to Php_Resque
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class AsyncPhpResqueCommandBus extends AbstractAsyncCommandBus
{
    /**
     * Setup the environment to perform a command
     * 
     * This method is required by Php_Resque and is called before a worker perfoms a job
     */
    public function setUp()
    {
        chdir(__DIR__ . '/../../../../../');

        require_once 'module/Ginger/Core/Bootstrap.php';

        \Ginger\Core\Bootstrap::init();
    }
    
    /**
     * Perform an async command
     * 
     * This method is required by Php_Resque and is called by a worker when performing a job
     */
    public function perform()
    {
        $commandClass = $this->args['command'];
        $payload = $this->args['payload'];
        $id = $this->args['id'];
        $timestamp = $this->args['timestamp'];
        $version = $this->args['version'];
        
        $command = new $commandClass($payload, $id, $timestamp, $version);
        
        \Ginger\Core\Bootstrap::getServiceManager()
            ->get('cqrs.gate')
            ->getBus(Definition::SYNC_BUS)
            ->invokeCommand($command);
    }
    
    /**
     * Commands are not invoked directly, they are pushed to a Php_Resque queue
     * 
     * A worker will handle the command in a background thread and send it back
     * to the AsyncPhpResqueCommandBus::perform method.
     * 
     * @param CommandInterface $command
     */
    public function invokeCommand(CommandInterface $command)
    {
        $commandClass = get_class($command);
        
        $args = array(
            'command' => $commandClass,
            'payload' => $command->getPayload(),
            'id' => $command->getId(),
            'timestamp' => $command->getTimestamp(),
            'version' => $command->getVersion()
        );
        
        \Resque::enqueue(Definition::ASYNC_COMMAND_QUEUE, get_class($this), $args);
    } 
}

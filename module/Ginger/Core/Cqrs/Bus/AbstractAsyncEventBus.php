<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Cqrs\Bus;

use Ginger\Core\Definition;
use Ginger\Core\Exception;
use Cqrs\Bus\BusInterface;
use Cqrs\Gate;
/**
 * AbstractAsyncEventBus
 * 
 * An async CQRS event bus in the ginger system just implements the publishEvent-Method.
 * The bus should send each event to the Ginger\Core\Definition::ASYNC_EVENT_QUEUE and
 * register itself as the listener of the event. 
 * In the handle/perform/proccess method, the bus should bootstrap the ginger core, take the
 * "cqrs.gate" and publish the event to the Ginger\Core\Definition::SYNC_BUS.
 * The sync-bus knows the responsible event listener and invoke it immediately.
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
abstract class AbstractAsyncEventBus implements BusInterface
{
    /**
     * @var Gate
     */
    protected $gate;

    /**
     * 
     * @return string
     */
    public function getName()
    {
        return Definition::ASYNC_EVENT_BUS;
    }
    
    /**
     * 
     * @param Gate $gate
     * @return void
     */
    public function setGate(Gate $gate)
    {
        $this->gate = $gate;
    }
    
    /**
     * 
     * @return Gate
     */
    public function getGate()
    {
        return $this->gate;
    }
        
    public function getCommandHandlerMap()
    {
        throw new Exception\BadMethodCallException('getCommandHandlerMap is not implemented by the async-event-bus');
    }
    
    public function mapCommand($commandClass, $callableOrDefinition)
    {
        throw new Exception\BadMethodCallException('mapCommand is not implemented by the async-event-bus');
    }
    
    public function invokeCommand(\Cqrs\Command\CommandInterface $command)
    {
        throw new Exception\BadMethodCallException('invokeCommand is not implemented by the async-event-bus');
    }
    
    public function getQueryHandlerMap()
    {
        throw new Exception\BadMethodCallException('getQueryHandlerMap is not implemented by the async-event-bus');
    } 
    
    public function mapQuery($queryClass, $callableOrDefinition)
    {
        throw new Exception\BadMethodCallException('mapQuery is not implemented by the async-event-bus');
    }
    
    public function executeQuery(\Cqrs\Query\QueryInterface $query)
    {
        throw new Exception\BadMethodCallException('ExecuteQuery is not implemented by the async-event-bus');
    }

    public function getEventListenerMap()
    {
        throw new Exception\BadMethodCallException(
            "getEventListenerMap is not implemented by the async-event-bus.\n"
            . "Please use the Ginger\\Core\\Definition::SYNC_BUS to register your event-listeners."
        );
    }

    public function registerEventListener($eventClass, $callableOrDefinition)
    {
        throw new Exception\BadMethodCallException(
            "registerEventListener is not implemented by the async-event-bus.\n"
            . "Please use the Ginger\\Core\\Definition::SYNC_BUS to register your event-listeners."
        );
    }
}

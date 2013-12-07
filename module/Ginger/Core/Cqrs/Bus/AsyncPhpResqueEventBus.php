<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Core\Cqrs\Bus;

use Malocher\Cqrs\Event\EventInterface;
use Ginger\Core\Definition;
/**
 * Special async CQRS EventBus with a link to Php_Resque
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class AsyncPhpResqueEventBus extends AbstractAsyncEventBus
{
    /**
     * Setup the environment to perform an event
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
     * Perform an async event
     * 
     * This method is required by Php_Resque and is called by a worker when performing a job
     */
    public function perform()
    {
        $eventClass = $this->args['event'];
        $payload = $this->args['payload'];
        $id = $this->args['id'];
        $timestamp = $this->args['timestamp'];
        $version = $this->args['version'];
        
        $event = new $eventClass($payload, $id, $timestamp, $version);
        
        \Ginger\Core\Bootstrap::getServiceManager()
            ->get('malocher.cqrs.gate')
            ->getBus(Definition::SYNC_BUS)
            ->publishEvent($event);
    }
    
    /**
     * Events are not published directly, they are pushed to a Php_Resque queue
     * 
     * A worker will handle the event in a background thread and send it back
     * to the AsyncPhpResqueEventBus::perform method.
     * 
     * @param EventInterface $event
     */
    public function publishEvent(EventInterface $event)
    {
        $eventClass = get_class($event);
        
        $args = array(
            'event' => $eventClass,
            'payload' => $event->getPayload(),
            'id' => $event->getId(),
            'timestamp' => $event->getTimestamp(),
            'version' => $event->getVersion()
        );
        
        \Resque::enqueue(Definition::ASYNC_EVENT_QUEUE, get_class($this), $args);
    } 
}

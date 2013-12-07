<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Test\Mock\Core;

/**
 * Mock EventListener
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class EventListener 
{
    use \Malocher\Cqrs\Adapter\AdapterTrait;
    
    public function onCheckEventPublished(CheckEventPublishedEvent $event) {
        $checkPayload = array('check event args');
        $checkId = 2;
        $checkTime = 1000100;
        $checkVersion = 1.3;
        if ($event->getPayload() == $checkPayload
            && $event->getId() == $checkId
            && $event->getTimestamp() == $checkTime
            && $event->getVersion() == $checkVersion) {
            unlink('tests/PHPUnit/Ginger/Test/Mock/Core/touch-file.txt');
        }
    }
    
    static public function isEventPublished() {
        return !file_exists('tests/PHPUnit/Ginger/Test/Mock/Core/touch-file.txt');  
    }
    
    static public function reset()
    {
        file_put_contents('tests/PHPUnit/Ginger/Test/Mock/Core/touch-file.txt', 'touch it');
    }
}

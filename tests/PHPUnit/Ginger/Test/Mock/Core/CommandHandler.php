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
 *  CommandHandler
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class CommandHandler
{
    use \Cqrs\Adapter\AdapterTrait;
    
    static private $commandInvoked = false;
    
    public function checkCommandInvocation(CheckCommandInvocationCommand $command) {
        $checkPayload = array('check args');
        $checkId = 1;
        $checkTime = 1000000;
        $checkVersion = 1.2;
        if ($command->getPayload() == $checkPayload
            && $command->getId() == $checkId
            && $command->getTimestamp() == $checkTime
            && $command->getVersion() == $checkVersion) {
            unlink('tests/PHPUnit/Ginger/Test/Mock/Core/touch-file.txt');
        }
    }
    
    static public function isCommandInvoked() {
        return !file_exists('tests/PHPUnit/Ginger/Test/Mock/Core/touch-file.txt');  
    }
    
    static public function reset()
    {
        file_put_contents('tests/PHPUnit/Ginger/Test/Mock/Core/touch-file.txt', 'touch it');
    }
}

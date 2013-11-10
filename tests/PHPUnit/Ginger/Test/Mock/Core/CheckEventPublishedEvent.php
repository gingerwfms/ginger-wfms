<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Ginger\Test\Mock\Core;

use Cqrs\Event\EventInterface;
use Cqrs\Message\Message;
/**
 * Event CheckEventPublishedEvent
 * 
 * @author Alexander Miertsch <kontakt@codeliner.ws>
 */
class CheckEventPublishedEvent extends Message implements EventInterface
{
}

<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
return array(
    'service_manager' => array(
        'invokables' => array(
            'test.core.command_handler' => 'Ginger\Test\Mock\Core\CommandHandler',
            'test.core.event_listener' => 'Ginger\Test\Mock\Core\EventListener',
        ),
    ),
    'cqrs' => array(
        'adapters' => array(
            'Malocher\Cqrs\Adapter\ArrayMapAdapter' => array(
                'buses' => array(
                    'Ginger\Core\Cqrs\Bus\CoreSyncBus' => array(
                        'Ginger\Test\Mock\Core\CheckCommandInvocationCommand' => array(
                            'alias' => 'test.core.command_handler',
                            'method' => 'checkCommandInvocation'
                        ),
                        'Ginger\Test\Mock\Core\CheckEventPublishedEvent' => array(
                            'alias' => 'test.core.event_listener',
                            'method' => 'onCheckEventPublished'
                        )
                    )
                )
            )
        )    
    )
);
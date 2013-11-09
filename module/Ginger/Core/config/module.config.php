<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
return array(
    'cqrs' => array(
        'default_bus' => \Ginger\Core\Definition::SYNC_BUS,
        'adapters' => array(
            'Cqrs\Adapter\ArrayMapAdapter' => array(
                'buses' => array(
                    'Ginger\Core\Cqrs\Bus\CoreSyncBus' => array(
                        
                    ),
                    'Ginger\Core\Cqrs\Bus\AsyncPhpResqueCommandBus' => array(
                        //do not map commands here, use the Ginger\Core\Cqrs\Bus\CoreSyncBus
                        //to register command handlers
                        //the async bus works as a proxy to handle commands in background threads
                    )
                )
            )
        )
    )
);
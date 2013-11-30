<?php
/*
 * This file is part of the codeliner/ginger-wfms package.
 * (c) Alexander Miertsch <kontakt@codeliner.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
return array(
    'router' => array(
        'routes' => array(
            'workflow-configuratior' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/workflow-configurator',
                    'defaults' => array(
                        'controller' => 'WfConfigFrontend\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'WfConfigFrontend\Controller\Index' => 'WfConfigFrontend\Controller\IndexController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'navigation' => array(
        'main_navigation' => array(
            'wf_configurator' => array(
                'label' => 'Workflow Configurator',
                'route' => 'workflow-configuratior'
            )
        )
    ),
    'asset_manager' => array(
        'resolver_configs' => array(
            'collections' => array(
                'js/wf-config-app.js' => array(
                    'js/backbone-1.1.0.js',
                    'js/app.js'
                ),
            ),
            'paths' => array(
                __DIR__ . '/../public',
            ),
        ),        
        'caching' => array(
            'js/wf-config-app.js' => array(
                'cache'     => 'FilePath',
                'options' => array(
                    'dir' => 'public', 
                ),
            ),
        ),
    ),
);
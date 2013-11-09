<?php
return array(
    'modules' => array(
        //modules are defined in the *.modules.php files
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './module',
            './module/Ginger',
            './vendor',
        ),
    ),
);
<?php

/**
 * Include RainTpl config files
 */
spl_autoload_register(function ($class_name) {
    $filename = $class_name . '.php';

    require_once $filename;
});

/**
 * Include controller files
 */
spl_autoload_register(function ($class_name) {
    $filename = 'controllers' . DIRECTORY_SEPARATOR . $class_name . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }
});

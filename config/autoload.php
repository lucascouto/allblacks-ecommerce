<?php

/**
 * Include RainTpl config files
 */
spl_autoload_register(function ($class_name) {
    $filename = 'config' . DIRECTORY_SEPARATOR . $class_name . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }
});

/**
 * Include controller files
 */
spl_autoload_register(function ($class_name) {
    $filename = 'models' . DIRECTORY_SEPARATOR . $class_name . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }
});

spl_autoload_register(function ($class_name) {
    $filename = 'controllers' . DIRECTORY_SEPARATOR . $class_name . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }
});

spl_autoload_register(function ($class_name) {
    $filename = 'DB' . DIRECTORY_SEPARATOR . $class_name . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }
});

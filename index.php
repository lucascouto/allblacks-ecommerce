<?php

use Slim\Slim;

require_once 'vendor/autoload.php';

$app = new Slim();

$app->config('debug', true);

$app->get('/', function () {
    echo "<h1>Hey there, all blacks! What's up?</h1>";
});

$app->run();

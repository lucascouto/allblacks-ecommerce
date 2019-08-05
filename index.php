<?php

use Slim\Slim;

require_once 'vendor/autoload.php';
require_once 'config/autoload.php';

$app = new Slim();

$app->config('debug', true);

$app->get('/', function () {
    $page = new Page;
    $page->view('index');
});

$app->run();

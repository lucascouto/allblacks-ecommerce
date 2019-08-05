<?php

require_once 'config/autoload.php';

use Slim\Slim;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function () {
    MainController::home();
});

$app->get('/admin/clients/report', function () {
    AdminController::generateSpreadsheet();
});

$app->get('/admin/clients', function () {
    ClientController::showAll();
});



$app->run();

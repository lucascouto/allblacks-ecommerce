<?php

require_once 'config/autoload.php';

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app = new App();

$app->config('debug', true);

$app->get('/', function () {
    MainController::home();
});

$app->get('/admin/clients/report', function ($req, $res) {
    $response = $res->withHeader('Content-Type', 'application/octet-stream; charset=utf-8')
        ->withHeader('Content-Disposition', 'attachment; filename="clientes.xlsx"');
    AdminController::generateSpreadsheet();
    return $response;
});

$app->get('/admin/clients', function () {
    ClientController::showAll();
});



$app->run();

<?php

require_once 'config/autoload.php';

use Slim\App;

$app = new App();

/* ROUTE TO HOME PAGE */
$app->get('/', function () {
    MainController::home();
});

/* ROUTE TO DOWNLOAD THE EXCEL FILE */
$app->get('/admin/clients/report', function ($req, $res) {
    $response = $res->withHeader('Content-Type', 'application/octet-stream; charset=utf-8')
        ->withHeader('Content-Disposition', 'attachment; filename="clientes_relatorio.xlsx"');
    AdminController::generateSpreadsheet();
    return $response;
});

/* ROUTE TO UPLOAD A REPORT FILE */
$app->post('/admin/clients/report', function ($req, $res) {

    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');

    $spreadsheet = $_FILES['spreadsheet']['tmp_name'];
    AdminController::uploadSpreadsheet($spreadsheet);

    return $response;
});

/* ROUTE TO UPLOAD A XML REPORT FILE */
$app->post('/admin/clients/reportxml', function ($req, $res) {

    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');

    $xml = $_FILES['xml']['tmp_name'];
    AdminController::uploadXML($xml);

    return $response;
});



/* ROUTE TO LIST ALL CLIENTS IN A TABLE */
$app->get('/admin/clients', function () {
    ClientController::showAll();
});



$app->run();

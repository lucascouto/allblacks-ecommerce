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

/* ROUTE TO SEND DIRECT MAIL */
$app->get('/admin/clients/sendmail', function ($req, $res) {
    AdminController::sendEmail('Promoção AllBlacks!', 'sample');
});

/* ------------------------------------- */

/* ROUTE TO DELETE A CLIENT */
$app->get('/admin/clients/{id}/delete', function ($req, $res, $args) {
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');
    ClientController::destroy($args['id']);

    return $response;
});

/* ROUTE TO SHOW THE FORM TO UPDATE A CLIENT */
$app->get('/admin/clients/{id}/edit', function ($req, $res, $args) {
    ClientController::edit($args['id']);
});

/* ROUTE TO STORE A CLIENT UPDATE */
$app->post('/admin/clients/{id}/edit', function ($req, $res, $args) {
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');
    ClientController::update($args['id'], $_POST);

    return $response;
});

/* ROUTE TO VIEW A SPECIFIC CLIENT */
$app->get('/admin/clients/{id}', function ($req, $res, $args) {
    ClientController::show($args['id']);
});

/* ROUTE TO SHOW THE FORM FOR CREATE A NEW CLIENT */
$app->get('/create-client', function () {
    ClientController::create();
});

/* ROUTE TO STORE A NEW CLIENT */
$app->post('/create-client', function ($req, $res) {
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');
    ClientController::store($_POST);

    return $response;
});


/* ROUTE TO LIST ALL CLIENTS IN A TABLE */
$app->get('/admin/clients', function () {
    ClientController::showAll();
});



$app->run();

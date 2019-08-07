<?php
session_start();

require_once 'config/autoload.php';

use Slim\App;

$app = new App();

/********************** ROUTES TO ADMIN! ************************/

/* ROUTE TO ADMIN LOGIN */
$app->get('/admin', function () {
    AdminController::showLogin();
});

/* ROUTE TO VALIDATE ADMIN LOGIN */
$app->post('/admin/validate', function ($req, $res) {
    $validated = AdminController::login($_POST['login'], $_POST['password']);
    if ($validated) {
        $response = $res->withHeader('Location', "/allblacks-ecommerce/admin/clients");
    } else {
        $response = $res->withHeader('Location', "/allblacks-ecommerce/admin");
    }

    return $response;
});

/* ROUTE TO LOGOUT THE ADMIN */
$app->get('/admin/logout', function ($req, $res) {
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin');
    AdminController::logout();

    return $response;
});

/* ROUTE TO LIST ALL CLIENTS IN A TABLE */
$app->get('/admin/clients', function () {
    AdminController::verifyAdminLogin();
    AdminController::showAll();
});

/* ROUTE TO DOWNLOAD THE EXCEL FILE */
$app->get('/admin/clients/report', function ($req, $res) {
    AdminController::verifyAdminLogin();
    $response = $res->withHeader('Content-Type', 'application/octet-stream; charset=utf-8')
        ->withHeader('Content-Disposition', 'attachment; filename="clientes_relatorio.xlsx"');
    AdminController::generateSpreadsheet();
    return $response;
});

/* ROUTE TO SHOW THE SCREEN WITH UPLOAD REPORT BUTTONS */
$app->get('/admin/upload_report', function ($req, $res) {
    AdminController::verifyAdminLogin();
    AdminController::showReportUploadButtons();
});

/* ROUTE TO UPLOAD A REPORT FILE */
$app->post('/admin/clients/report', function ($req, $res) {
    AdminController::verifyAdminLogin();
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');

    $spreadsheet = $_FILES['spreadsheet']['tmp_name'];
    AdminController::uploadSpreadsheet($spreadsheet);

    return $response;
});

/* ROUTE TO UPLOAD A XML REPORT FILE */
$app->post('/admin/clients/reportxml', function ($req, $res) {
    AdminController::verifyAdminLogin();
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');

    $xml = $_FILES['xml']['tmp_name'];
    AdminController::uploadXML($xml);

    return $response;
});

/* ROUTE TO SHOW FORM FOR COMPOSE MAIL */
$app->get('/admin/clients/sendmail', function ($req, $res) {
    AdminController::verifyAdminLogin();
    AdminController::showEmailForm();
});

/* ROUTE TO SEND DIRECT MAIL */
$app->post('/admin/clients/sendmail', function ($req, $res) {
    AdminController::verifyAdminLogin();
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');
    AdminController::sendEmail($_POST['subject'], 'email-template', $_POST);

    return $response;
});


/* ROUTE TO DELETE A CLIENT */
$app->get('/admin/clients/{id}/delete', function ($req, $res, $args) {
    AdminController::verifyAdminLogin();
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');
    ClientController::destroy($args['id']);

    return $response;
});

/* ROUTE TO SHOW THE FORM TO UPDATE A CLIENT */
$app->get('/admin/clients/{id}/edit', function ($req, $res, $args) {
    AdminController::verifyAdminLogin();
    AdminController::edit($args['id']);
});

/* ROUTE TO STORE A CLIENT UPDATE */
$app->post('/admin/clients/{id}/edit', function ($req, $res, $args) {
    AdminController::verifyAdminLogin();
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');
    ClientController::update($args['id'], $_POST);

    return $response;
});

/* ROUTE TO VIEW A SPECIFIC CLIENT */
$app->get('/admin/clients/{id}', function ($req, $res, $args) {
    AdminController::verifyAdminLogin();
    AdminController::show($args['id']);
});

/* ROUTE TO SHOW THE FORM FOR CREATE A NEW CLIENT */
$app->get('/admin/create-client', function () {
    AdminController::verifyAdminLogin();
    AdminController::create();
});

/* ROUTE TO STORE A NEW CLIENT */
$app->post('/admin/create-client', function ($req, $res) {
    AdminController::verifyAdminLogin();
    $response = $res->withHeader('Location', '/allblacks-ecommerce/admin/clients');
    ClientController::store($_POST);

    return $response;
});


/********************** ROUTES TO CLIENTS! ************************/
/* ROUTE TO HOME PAGE */
$app->get('/', function () {
    MainController::home();
});

/* ROUTE TO SHOW THE CLIENT LOGIN FORM */
$app->get('/login', function () {
    ClientController::showLogin();
});

/* ROUTE TO VALIDATE THE LOGIN */
$app->post('/login/validate', function ($req, $res) {
    $validated = ClientController::login($_POST['login'], $_POST['password']);
    if ($validated) {
        $user = $validated->getValues();
        $response = $res->withHeader('Location', "/allblacks-ecommerce/client/{$user['idclient']}");
    } else
        $response = $res->withHeader('Location', '/allblacks-ecommerce/login/error');

    return $response;
});

/* ROUTE TO SHOW THE LOGIN ERROR PAGE */
$app->get('/login/error', function ($req, $res, $args) {
    ClientController::showLoginError();
});

/* ROUTE TO LOGOUT */
$app->get('/client/logout', function ($req, $res) {
    $response = $res->withHeader('Location', '/allblacks-ecommerce/login');
    ClientController::logout();

    return $response;
});

/* ROUTE TO GO TO THE CLIENT PAGE */
$app->get('/client/{id}', function ($req, $res, $args) {
    ClientController::verifyClientLogin($args['id']);
    ClientController::show($args['id']);
});

/* ROUTE TO SHOW THE FORM FOR CREATE A NEW CLIENT */
$app->get('/create-client', function () {
    ClientController::create();
});

/* ROUTE TO STORE A NEW CLIENT */
$app->post('/create-client', function ($req, $res) {
    $response = $res->withHeader('Location', '/allblacks-ecommerce/login');
    ClientController::store($_POST);

    return $response;
});

/* ROUTE TO EDIT INFO OF A CLIENT */
$app->get('/client/{id}/edit', function ($req, $res, $args) {
    ClientController::verifyClientLogin($args['id']);
    ClientController::edit($args['id']);
});

/* ROUTE TO STORE THE EDITED INFO OF A CLIENT */
$app->post('/client/{id}/edit', function ($req, $res, $args) {
    ClientController::verifyClientLogin($args['id']);
    $response = $res->withHeader('Location', "/allblacks-ecommerce/client/{$args['id']}");
    ClientController::update($args['id'], $_POST);

    return $response;
});

/* ROUTE TO DELETE A CLIENT */
$app->get('/client/{id}/delete', function ($req, $res, $args) {
    ClientController::verifyClientLogin($args['id']);
    $response = $res->withHeader('Location', '/allblacks-ecommerce/login');
    ClientController::destroy($args['id']);

    return $response;
});


$app->run();

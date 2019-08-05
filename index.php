<?php

use Slim\Slim;

require_once 'vendor/autoload.php';
require_once 'DB/Sql.php';

$app = new Slim();

$app->config('debug', true);

$app->get('/', function () {
    $sql = new Sql;
    $results = $sql->select('SELECT * FROM clients');

    echo json_encode($results);
});

$app->run();

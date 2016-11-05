<?php

use App\Controllers\PagesController;

require '../vendor/autoload.php';

session_start();

$app = new \Slim\App([
    'setting' => [
        'displayErrorDetails' => true
    ]
]);

require('../app/container.php');

$app->get('/', PagesController::class . ':home');
$app->get('/nous-contacter', PagesController::class . ':getContact')->setName('contact');
$app->post('/nous-contacter', PagesController::class . ':postContact');

$app->run();

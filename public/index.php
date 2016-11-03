<?php

require '../vendor/autoload.php';

$app = new \Slim\App([
    'setting' => [
        'displayErrorDetails' => true
    ]
]);

require('../app/container.php');

$app->get('/', \App\Controllers\PagesController::class . ':home');
$app->get('/nous-contacter', \App\Controllers\PagesController::class . ':getContact')->setName('contact');

$app->run();

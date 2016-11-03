<?php

require '../vendor/autoload.php';

$app = new \Slim\App([
    'setting' => [
        'displayErrorDetails' => true
    ]
]);

$app->get('/', \App\Controllers\PagesController::class . ':home');

$app->run();

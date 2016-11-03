<?php

require '../vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function(\Slim\Http\Request $request, \Slim\Http\Response $response) {
   return $response->getBody()->write("Bonjour les gens.");
});

$app->run();
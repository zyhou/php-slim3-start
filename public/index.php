<?php

require '../vendor/autoload.php';

class DemoMiddleware {

    public function __invoke(\Slim\Http\Request $request, \Slim\Http\Response $response, $next) {
        $response->write('<h1>Bienvenue</h1>');
        $response = $next($request, $response);
        $response->write('<h1>Au revoir</h1>');
        return $response;
    }
}

$app = new \Slim\App();

$container = $app->getContainer();
$container['pdo'] = function() {
    $pdo = new PDO('mysql:dbname=slim3;host=localhost', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$app->add(new DemoMiddleware());


$app->get('/salut/{nom}', function(\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {
    $req = $this->pdo->prepare("select * from posts");
    $req->execute();
    $posts = $req->fetchAll();
    var_dump($posts);

    return $response->write("Bonjour ".$args['nom']);
});


$app->run();

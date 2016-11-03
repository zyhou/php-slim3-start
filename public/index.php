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

class DataBaseContainer {

    /**
     * @var PDO
     */
    private $pdo;

    public  function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function query($sql) {
        $req = $this->pdo->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}

class PagesController {

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public  function salut(\Slim\Http\Request $request, \Slim\Http\Response $response, $args){
        $posts = $this->container->db->query("select * from posts");
        var_dump($posts);
        return $response->write("Bonjour ".$args['nom']);
    }
}

$app = new \Slim\App();

$container = $app->getContainer();
$container['pdo'] = function() {
    $pdo = new PDO('mysql:dbname=slim3;host=localhost', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};

$container['db'] = function($container) {
    return new DataBaseContainer($container->pdo);
};

$app->add(new DemoMiddleware());

$app->get('/salut/{nom}', 'PagesController:salut');

$app->run();

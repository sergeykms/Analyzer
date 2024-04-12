<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Middleware\MethodOverrideMiddleware;
use Slim\Factory\AppFactory;
use DI\Container;
use Slim\Views\PhpRenderer;

$autoloadPath1 = __DIR__ . '/../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

$container = new Container();
$container->set('renderer', function () {
    return new PhpRenderer(__DIR__ . '/../templates');
});

AppFactory::setContainer($container);
$app = AppFactory::create();
$app->add(MethodOverrideMiddleware::class);

$app->get('/', function ($request, $response) {
    return $this->get('renderer')->render($response, 'index.phtml');
})->setName('main');

$app->run();

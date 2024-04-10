<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;

$autoloadPath1 = __DIR__ . '/../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);


$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello!");

    return $response;
});

$app->run();

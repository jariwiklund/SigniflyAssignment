<?php
require __DIR__ . '/../../vendor/autoload.php';

use GuzzleHttp\Psr7\ServerRequest;
use SigniflyAssignment\Routing\Router;
$request = ServerRequest::fromGlobals();
$router = new Router($request);
$controller = $router->routeRequestToController();
$response = $controller->handleRequest($request);
$response->send();

exit();
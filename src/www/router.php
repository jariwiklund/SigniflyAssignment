<?php

use GuzzleHttp\Psr7\ServerRequest;
use SigniflyAssignment\Routing\Router;

$router = new Router(ServerRequest::fromGlobals());
$controller = $router->routeRequestToController();
$response = $controller->handleRequest($request);
$response->send();

exit();
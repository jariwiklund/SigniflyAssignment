<?php
namespace SigniflyAssignment\Controllers;

use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Response;

class RootController implements ControllerInterface
{

    public function handleRequest(RequestInterface $request): Response
    {
        return new Response($request->getUri()->getPath());
    }
}
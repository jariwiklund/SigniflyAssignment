<?php
namespace SigniflyAssignment\Routing;

use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Response;

class RootController implements ControllerInterface
{

    public function handleRequest(RequestInterface $request): Response
    {
        // TODO: Implement handleRequest() method.
    }
}
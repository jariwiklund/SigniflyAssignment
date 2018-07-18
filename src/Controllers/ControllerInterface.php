<?php

namespace SigniflyAssignment\Controllers;


use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Response;

interface ControllerInterface
{
    public function handleRequest(RequestInterface $request): Response;
}
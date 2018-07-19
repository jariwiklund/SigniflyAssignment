<?php

namespace SigniflyAssignment\Controllers;


use Psr\Http\Message\RequestInterface;
use Symfony\Component\HttpFoundation\Response;

class ErrorController implements ControllerInterface
{

    /**
     * @var int
     */
    private $status_code;

    /**
     * @var string
     */
    private $error_message;

    public function __construct(int $status_code, string $error_message)
    {
        $this->status_code = $status_code;
        $this->error_message = $error_message;
    }

    public function handleRequest(RequestInterface $request): Response
    {
        return new Response($this->error_message, $this->status_code);
    }
}
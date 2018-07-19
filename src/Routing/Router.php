<?php
namespace SigniflyAssignment\Routing;

use Psr\Http\Message\RequestInterface;
use SigniflyAssignment\Controllers\ControllerInterface;
use SigniflyAssignment\Controllers\ErrorController;
use SigniflyAssignment\Controllers\RootController;

/**
 * Class Router
 * @package SigniflyAssignment\Routing
 * Very basic convention: /foo will route to Controllers/FooController
 */
class Router
{

    /** @var RequestInterface  */
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function routeRequestToController(): ControllerInterface
    {
        $path_parts = explode('/', $this->request->getUri()->getPath());
        $controller_name = $path_parts[1];
        if($controller_name === ''){
            return new RootController($this->request);
        }
        //todo: better path-to-controller conversion
        $controller_name = ucfirst($controller_name);
        $controller_fqn = 'SigniflyAssignment\\Controllers\\'.$controller_name.'Controller';

        if(!class_exists($controller_fqn)){
            return new ErrorController(404, $controller_name.' does not exists');
        }

        return new $controller_fqn();
    }
}
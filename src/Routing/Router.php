<?php
namespace SigniflyAssignment\Routing;

use Psr\Http\Message\RequestInterface;

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
        $controller_name = $path_parts[0];
        if($controller_name === ''){
            return new RootController($this->request);
        }
        $controller_fqn = 'SigniflyAssignment\\Controllers\\'.$controller_name;

        if(!class_exists($controller_fqn)){
            return new ErrorController(404, $controller_name.' does not exists');
        }

        return new $controller_name($this->request);
    }
}
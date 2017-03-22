<?php

namespace Walker;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pimple\Container;
use Walker\Interfaces\Controller;
use Walker\Provider;
use Walker\Traits;

class Walker
{
    use Traits\Middleware;

    private $container;

    public function init($container = null)
    {
        if (!$container instanceof Container) {
            $this->container = new Container();
        }
        Provider\DefaultServices::register($this->container);
    }

    public function add($callable)
    {
        $this->addMiddleware($callable);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function run()
    {
        $this->process($this->container['request'], $this->container['response']);
    }

    public function process(RequestInterface $request, ResponseInterface $response)
    {
        $this->callMiddleware($request, $response);
    }

    public function dispatch(RequestInterface $request)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        return explode('/', ltrim($path, '/'));
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $result = $this->dispatch($request);
        if (count($result) < 2) {
            die("invalid url\n");
        }
        list($controller_name, $action_name) = $result;
        $controller_name = 'App\\Controller\\' . ucfirst($controller_name);
        $action_name = lcfirst($action_name);
        if (!class_exists($controller_name)) {
            die("controller not exists\n");
        }
        $controller = new $controller_name($request, $response);
        $action = array($controller, $action_name);
        if (!is_callable($action)) {
            die("action not callable\n");
        }
        call_user_func($action);
    }


}
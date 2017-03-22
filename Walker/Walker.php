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

    private $routeMap;

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

    public function map($pattern, $callable)
    {
        $this->routeMap[$pattern] = $callable;
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
        $path = $request->getUri()->getPath();
        if (isset($this->routeMap[$path])) {
            $callable = $this->routeMap[$path];
            call_user_func($callable, $request, $response);
        } else {
            die("url invalid\n");
        }
    }


}
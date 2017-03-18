<?php

namespace Walker;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pimple\Container;
use Walker\Interfaces\Controller;
use Walker\Provider;

class Walker
{
    protected $container;

    public function init()
    {
        $this->container = new Container();
        Provider\DefaultServices::register($this->container);
    }

    public function run()
    {
        $this->process($this->container['request'], $this->container['response']);
    }

    public function process(RequestInterface $request, ResponseInterface $response)
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
        if(!$controller instanceof Controller) {
            die("not instance of controller\n");
        }
        $action = array($controller, $action_name);
        if (!is_callable($action)) {
            die("action not callable\n");
        }
        call_user_func(array($controller, 'before'));
        call_user_func($action);
        call_user_func(array($controller, 'after'));
    }

    public function dispatch(RequestInterface $request)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        return explode('/', ltrim($path, '/'));
    }


}
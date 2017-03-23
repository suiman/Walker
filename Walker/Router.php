<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/23
 * Time: 下午7:14
 */

namespace Walker;

use FastRoute;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

class Router
{
    private $routeMap = null;

    public function map($pattern, callable $callable)
    {
        $this->routeMap[$pattern] = array('GET', $pattern, $callable);
    }

    public function dispatch($uri)
    {
        $dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $collector) {
            foreach ($this->routeMap as $route) {
                $collector->addRoute($route[0], $route[1], $route[2]);
            }
        });
        $routeInfo = $dispatcher->dispatch('GET', $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                die("uri not match\n");
            case Dispatcher::METHOD_NOT_ALLOWED:
                die("method not allowed\n");
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $params = $routeInfo[2];
                return array($handler, $params);
        }

    }

}
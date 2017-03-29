<?php

namespace Walker;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pimple\Container;
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
        } else {
            $this->container = $container;
        }
        Provider\DefaultServices::register($this->container);
    }

    public function add($callable)
    {
        $this->addMiddleware($callable);
    }

    public function map($pattern, $callable)
    {
        $this->container['router']->map($pattern, $callable);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function run()
    {
        $response = $this->process($this->container['request'], $this->container['response']);
        $this->finish($response);
    }

    private function process(RequestInterface $request, ResponseInterface $response)
    {
        $response = $this->callMiddleware($request, $response);
        return $response;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response)
    {
        $path = $request->getUri()->getPath();
        list($handler, $params) = $this->container['router']->dispatch($path);
        $response = call_user_func($handler, $request, $response, $params);
        return $response;
    }

    public function finish(ResponseInterface $response)
    {
        $body = $response->getBody();
        $body->rewind();
        $data = $body->read($body->getSize());
        echo $data;
    }


}
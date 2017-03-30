<?php

namespace Walker;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Pimple\Container;
use Walker\Provider;
use Walker\Traits;
use Walker\Exception\NotFoundException;

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

    private function process(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response = $this->callMiddleware($request, $response);
        return $response;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $path = $request->getUri()->getPath();
        try {
            list($handler, $params) = $this->container['router']->dispatch($path, $request, $response);
            $response = call_user_func($handler, $request, $response, $params);
        } catch (\Exception $e) {
            if ($e instanceof NotFoundException) {
                $response = $e->getResponse();
                $response->getBody()->write("404 NOT FOUND\n");
            }
        }
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
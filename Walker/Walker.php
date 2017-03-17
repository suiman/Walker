<?php

namespace Walker;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Walker\Http\Environment;
use Walker\Http\Request;
use Walker\Http\Response;

class Walker
{
    protected $environment;

    protected $request;

    protected $response;

    public function init() {
        $this->environment = new Environment($_SERVER);
        $this->request = new Request($this->environment);
        $this->response = new Response();
    }

    public function run() {
        $this->process($this->request, $this->response);
    }

    public function process(RequestInterface $request, ResponseInterface $response) {
        $uri = $request->getUri();
        $path = $uri->getPath();
        echo $path;

    }


}
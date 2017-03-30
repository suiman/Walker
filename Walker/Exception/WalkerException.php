<?php

namespace Walker\Exception;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;


class WalkerException extends \Exception
{
    private $resquest;

    private $response;

    public function __construct(ServerRequestInterface $request, ResponseInterface $response)
    {
        parent::__construct();
        $this->resquest = $request;
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

}
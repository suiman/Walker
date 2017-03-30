<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/17
 * Time: 下午2:01
 */

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Base
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    public function __construct(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * set default action
     */
    public function index()
    {
        echo "^_^\n";
    }

}
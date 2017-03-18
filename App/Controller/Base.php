<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/17
 * Time: 下午2:01
 */

namespace App\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Walker\Interfaces;

class Base implements Interfaces\Controller
{
    protected $request;

    protected $response;

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function before()
    {

    }

    /**
     * set default action
     */
    public function index()
    {
        echo "^_^\n";
    }

    public function after()
    {

    }

}
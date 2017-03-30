<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 2017/3/21
 * Time: 下午10:39
 */

namespace Walker\Traits;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

trait Middleware
{
    /**
     * Middleware call stack
     *
     * @var  \SplStack
     */
    private $stack = null;

    private function addMiddleware($callable)
    {
        if (is_null($this->stack)) {
            $this->initMiddleware();
        }
        $next = $this->stack->top();
        $this->stack[] = function (
            ServerRequestInterface $request,
            ResponseInterface $response
        ) use (
            $callable,
            $next
        ) {
            $result = call_user_func($callable, $request, $response, $next);
            return $result;
        };
        return $this;
    }


    private function initMiddleware()
    {
        $this->stack = new \SplStack();
        $this->stack[] = $this;
    }


    public function callMiddleware(ServerRequestInterface $request, ResponseInterface $response)
    {
        if (is_null($this->stack)) {
            $this->initMiddleware();
        }
        $middleware = $this->stack->top();
        $response = $middleware($request, $response);
        return $response;
    }

}
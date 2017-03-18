<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/18
 * Time: 下午3:25
 */

namespace Walker\Provider;

use Pimple\Container;
use Walker\Http\Environment;
use Walker\Http\Request;
use Walker\Http\Response;

class DefaultServices
{
    public static function register(Container $container)
    {
        if (!isset($container['environment'])) {
            $container['environment'] = function () {
                return new Environment($_SERVER);
            };
        }

        if (!isset($container['request'])) {
            $container['request'] = function ($container) {
                return new Request($container['environment']);
            };
        }

        if (!isset($container['response'])) {
            $container['response'] = function ($container) {
                return new Response();
            };
        }
    }

}
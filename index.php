<?php
require "vendor/autoload.php";

date_default_timezone_set('Asia/Shanghai');

$walker = new Walker\Walker();
$walker->init();

$walker->add(function ($request, $response, $next) {
    $response->getBody()->write("before\n");
    $next($request, $response);
    $response->getBody()->write("\nafter\n");
    return $response;
});

$walker->map('/{ctrl}/{act}', function ($request, $response, $params) {
    $controller = 'App\\Controller\\'.ucfirst($params['ctrl']);
    $action = $params['act'];
    $callable = array(new $controller($request, $response), $action);
    if (is_callable($callable)) {
        call_user_func($callable, $params);
    } else {
        die("not callable\n");
    }
});

$walker->run();
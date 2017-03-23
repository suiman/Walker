<?php
require "vendor/autoload.php";

date_default_timezone_set('Asia/Shanghai');

$walker = new Walker\Walker();
$walker->init();

$walker->add(function ($request, $response, $next) {
    echo "before\n";
    $next($request, $response);
    echo "after\n";
    return $response;
});

$walker->map('/{ctrl}/{act}', function ($request, $response, $params) {
    $controller = 'App\\Controller\\'.ucfirst($params['ctrl']);
    $action = $params['act'];
    call_user_func(array(new $controller($request, $response), $action), $params);
});

$walker->run();
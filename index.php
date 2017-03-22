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

$walker->map('/home/error', function ($request, $response) {
    $controller = new \App\Controller\Home($request, $response);
    $controller->error();
});

$walker->run();
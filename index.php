<?php
require "vendor/autoload.php";

date_default_timezone_set('Asia/Shanghai');

$walker = new Walker\Walker();
$walker->init();
$container = $walker->getContainer();

$callable = function ($request, $response, $next) use ($container) {
    echo "first middleware before\n";
    $next($request, $response);
    echo "first middleware after\n";
//    var_dump($container['environment']);
    return $response;
};
$walker->add($callable);
$walker->add(
    function ($request, $response, $next) {
        echo "second middleware before\n";
        $next($request, $response);
        echo "second middleware after\n";
        return $response;
    }
);

$walker->run();
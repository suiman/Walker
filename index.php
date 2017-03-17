<?php
require "vendor/autoload.php";

use App\Controller;

$walker = new Walker\Walker();
$walker->init();

$callable = array(new Controller\Home(), 'test');
call_user_func($callable);


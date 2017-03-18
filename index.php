<?php
require "vendor/autoload.php";

date_default_timezone_set('Asia/Shanghai');

$walker = new Walker\Walker();
$walker->init();
$walker->run();
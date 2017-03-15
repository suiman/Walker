<?php

namespace Walker;

class App
{
    public function init() {
        $request_uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($request_uri, PHP_URL_PATH);
    }

    public function run() {

    }


}
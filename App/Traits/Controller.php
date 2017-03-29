<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 2017/3/19
 * Time: 下午5:53
 */

namespace App\Traits;


trait Controller
{
    private function responseJson($code, array $data)
    {
        $ret = array(
            'code' => (int)$code,
            'json' => $data
        );
        $this->response->getBody()->write(json_encode($ret));
    }

}
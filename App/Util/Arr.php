<?php

namespace App\Util;

class Arr
{
    public static function get(array $arr, $key, $default = null)
    {
        if (isset($arr[$key])) {
            return $arr[$key];
        } else {
            return $default;
        }
    }

}
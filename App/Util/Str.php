<?php

namespace App\Util;

class Str
{
    public static function withNL($str, $count = 1)
    {
        return rtrim($str) . str_repeat("\n", $count);
    }

}
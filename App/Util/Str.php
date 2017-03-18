<?php

namespace App\Util;

class Str
{
    public static function withNL($str)
    {
        return rtrim($str) . "\n";
    }

}
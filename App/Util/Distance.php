<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/18
 * Time: 上午10:26
 */

namespace App\Util;


class Distance
{
    /**
     * 根据经纬度计算距离 其中A($lat1,$lng1)、B($lat2,$lng2)
     */
    public static function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        //地球半径
        $R = 6378137;

        //将角度转为狐度
        $radLat1 = deg2rad($lat1);
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);

        //结果
        $s = acos(cos($radLat1) * cos($radLat2) * cos($radLng1 - $radLng2) + sin($radLat1) * sin($radLat2)) * $R;

        //精度
        $s = round($s * 10000) / 10000;

        return round($s);
    }

    /**
     * 得到一个友好显示的距离
     */
    public static function conversion_of_units($distance = -1)
    {
        if ($distance < 0) {
            return '遥远的远方';
        }
        if ($distance < 100) {
            return '少于100米';
        }
        if ($distance > 10000000) {
            return '火星';
        }
        if ($distance > 1000) {
            return round(($distance / 1000), 2) . "公里";
        }
        return $distance . "米";
    }

}
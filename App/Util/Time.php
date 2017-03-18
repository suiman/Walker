<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/18
 * Time: 上午10:21
 */

namespace App\Util;


class Time
{
    /**
     * 得到一个友好显示的时间
     *
     * • 1分钟以内发布，显示“刚刚”
     * • 发布1分钟后~1小时内，显示“N分钟前”
     * • 发布1小时后~次日0点内，显示“N小时前”
     * • 发布后的次日0点后，显示“昨天+时+分”
     * • 发布后的第3天~1年内，显示“月-日”, 没有前导零, 如"1-1"
     * • 发布后的1年后，显示“年-月-日”
     *
     * @param $ts
     * @return string
     */
    public static function date_friendly($ts)
    {
        if (empty($ts) || (int)$ts <= 0) {
            return '-';
        }
        $now = time(); //当前时间
        $span = $now - $ts; //距离现在多长时间
        $today = strtotime(date('Y-m-d', $now)); //今天开始的时间
        $this_year = strtotime(date('Y', $now) . '-1-1 00:00:00'); //今年开始的时间

        $MINUTE = 60; //1分钟
        $HOUR = 3600; //1小时
        $DAY = 86400; //1天

        if ($span < $MINUTE) {
            $friendly_date = '刚刚';
        } elseif ($span < $HOUR) {
            $friendly_date = floor($span / $MINUTE) . '分钟前';
        } elseif ($span < ($now - $today)) {
            $friendly_date = floor($span / $HOUR) . '小时前';
        } elseif ($span < ($now - $today + $DAY)) {
            $friendly_date = '昨天 ' . date('H:i', $ts);
        } elseif ($span < ($now - $this_year)) {
            $friendly_date = date('n-j', $ts);
        } else {
            $friendly_date = date('Y-n-j', $ts);
        }

        return $friendly_date;
    }


}
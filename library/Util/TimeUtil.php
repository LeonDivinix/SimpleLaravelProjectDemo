<?php
/**
 * Created by leon
 * Date: 2016-11-15 20:43
 */

namespace Library\Util;

/**
 * Created by leon
 * Date: 2016-11-10 20:46
 */
class TimeUtil
{
    /**
     * 创建当前时间戳
     * 默认当前日期
     * @param int $zoneFixed 时间修正
     * @return int
     */
    public static function now($zoneFixed = 0) {
        return time() + $zoneFixed;
    }

    /**
     * 创建日期
     * 默认当前日期
     * @param string $format
     * @param int $timestamp 0默认为当前时间戳
     * @param int $zoneFixed 时间修正
     * @return bool|string
     */
    public static function date($format = "Y-m-d H:i:s", $timestamp = 0, $zoneFixed = 0) {
        if (empty($timestamp)) {
            $timestamp = time();
        }
        return date($format, $timestamp + $zoneFixed);
    }

    /**
     * 字符串时间转数字数字时间戳
     * @param $str
     * @param int $zoneFixed 时间修正
     * @return string
     */
    public static function strToTime($str, $zoneFixed = 0) {
        return strtotime($str) + $zoneFixed;
    }

    /**
     * 计算过期日期
     * @param $str
     * @param $days
     * @return bool|string
     */
    public static function expireDate($str, $days) {
        if ($days > 0) {
            $days = "+" . $days;
        }
        return self::date("Y-m-d", strtotime($days . " day", self::strToTime($str)));
    }

    /**
     * 构建dojo的字符串时间戳
     * @param $standardTime
     * @return string
     */
    public static function dojoTimeStr($standardTime) {
        $i = strpos($standardTime, "GMT");
        if (false !== $i) {
            $standardTime = substr($standardTime, 0, $i + 8); // . "+0800";
        }
        return $standardTime;
    }

    /**
     * dojo字符时间戳转日期格式
     * @param $standardTime
     * @return string
     */
    public static function dojoStrToDate($standardTime) {
        $standardTime = self::dojoTimeStr($standardTime);
        return self::date("Y-m-d", self::strToTime($standardTime));
    }
}
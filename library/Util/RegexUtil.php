<?php
/**
 * Created by leon
 * Date: 2017-01-04 12:19
 */

namespace Library\Util;


class RegexUtil
{

    /**
     * 按大写字符分隔字符串
     * @param $str
     * @return array
     */
    public static function splitUpper($str) {
        return preg_split('/(?=[A-Z])/', $str);
    }

    /**
     * 正则表达式判断
     * @param $pattern
     * @param $subject
     * @return bool
     */
    function isByPreg($pattern, $subject) {
        return preg_match($pattern, $subject) === 1;
    }

    /**
     * 是否是整数
     * 带正负号
     * @param $value
     * @return bool
     */
    public static function isInt($value) {
        return self::isByPreg('/^[+-]?\d+$/', $value);
    }

    /**
     * 是否整数
     * 不带带正负号
     * @param $value
     * @return bool
     */
    public static function isUnsignedInt($value) {
        return self::isByPreg('/^\d+$/', $value);
    }
}
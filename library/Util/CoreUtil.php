<?php
namespace Library\Util;
/**
 * Created by leon
 * Date: 2016-11-10 20:47
 */
class CoreUtil
{
    /**
     * 空值判断
     * @param mixed $param 传入参数
     * @return bool
     */
    public static function isEmpty($param) {
        return empty($param)
        || (strcasecmp("NaN", $param) === 0)
        || (strcasecmp("null", $param) === 0)
        || (strcasecmp("false", $param) === 0);
    }
}
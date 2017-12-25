<?php
/**
 * Created by leon
 * Date: 2016-11-15 20:43
 */

namespace Library\Util;


use Library\Constant\TitleMap;

class ConstantUtil
{
    /**
     * 构建错误信息
     * @param $errorCode
     * @return array
     */
    public static function flagMessage($errorCode) {
        return array("flag" => $errorCode, "message" => TitleMap::$FLAG_MAP[$errorCode]);
    }
}
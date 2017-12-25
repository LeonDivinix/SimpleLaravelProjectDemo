<?php
/**
 * Created by leon
 * Date: 2016-12-01 11:22
 */

namespace Library\Constant;


class BusinessConstant
{
    public static $CURRENCY = array(
        1 => "人民币",
        2 => "加元",
        3 => "美元",
    );

    public static $CURRENCY_MAP = array(
        "CAD" => 2, // 加元
        "USD" => 3, // 美元
    );

    public static $CURRENCY_RATE = array(
        2 => 529.1900, // 加元
        3 => 687.7500, // 美元
    );

    public static $WEIGHT = array(
        1 => "公斤",
        2 => "磅",
    );

    public static $WEIGHT_EXCHANGE = array( // 转KG
        1 => 1,
        2 => 0.4535924,
    );

    public static $PRODUCT_UNIT = array(
        1 => "箱",
        2 => "罐",
        3 => "瓶",
        4 => "盒",
        5 => "包",
        6 => "支",
    );

    public static $EXPRESS_COMPANY = array(
        1 => "顺丰",
        2 => "圆通"
    );
    
    const STATUS_INIT = 0; // 初始
    const STATUS_RECEIVE_PART = 5; // 部分到货
    const STATUS_RECEIVE_COMPLETE = 6; // 到货完毕
}
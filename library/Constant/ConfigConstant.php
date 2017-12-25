<?php
/**
 * Created by leon
 * Date: 2016-10-28 10:25
 */

namespace Library\Constant;


class ConfigConstant
{
    // 权限值定义
    const ADMIN_PERMISSION_QUERY = 0;
    const ADMIN_PERMISSION_EDIT = 1;
    const ADMIN_PERMISSION_EXPORT = 10;
    const ADMIN_PERMISSION_IMPORT = 100;

    /**
     * 权限说明
     * @var array
     */
    public static $ADMIN_PERMISSION = array(
        self::ADMIN_PERMISSION_EDIT => "增改",
        self::ADMIN_PERMISSION_EXPORT => "导出",
        self::ADMIN_PERMISSION_IMPORT => "导入"
    );

    /**
     * 请求路由中module名
     * 全小写
     * @var array array("Module名称"=>"权限值")
     */
    public static $ADMIN_OPERATE_PERMISSION = array(
        "own" => self::ADMIN_PERMISSION_QUERY,
        "list" => self::ADMIN_PERMISSION_QUERY,
        "info" => self::ADMIN_PERMISSION_QUERY,
        "tree" => self::ADMIN_PERMISSION_QUERY,

        "add" => self::ADMIN_PERMISSION_EDIT,
        "update" => self::ADMIN_PERMISSION_EDIT,
        "copy" => self::ADMIN_PERMISSION_EDIT,
        "save" => self::ADMIN_PERMISSION_EDIT,
        "image" => self::ADMIN_PERMISSION_EDIT,
//        "upload" => self::ADMIN_PERMISSION_EDIT,

        "export" => self::ADMIN_PERMISSION_EXPORT,
        "import" => self::ADMIN_PERMISSION_IMPORT
    );
}
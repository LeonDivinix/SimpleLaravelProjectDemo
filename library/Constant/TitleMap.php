<?php
/**
 * Created by leon
 * Date: 2016-11-15 19:33
 */

namespace Library\Constant;


class TitleMap
{
    public static $FLAG_MAP = array(
        FlagConstant::ADMIN_REDIRECT_LOG_IN => "/Login",
        FlagConstant::INSERT_FAIL => "保存失败",
        FlagConstant::UPDATE_FAIL => "更新失败",
        FlagConstant::COPY_FAIL => "复制失败",
        FlagConstant::ERROR_PATH => "路径不存在",
        FlagConstant::NEED_NAME => "请填写用户名",
        FlagConstant::NEED_PWD => "请填写密码",
        FlagConstant::NEED_ROLE => "请填选角色",

        FlagConstant::NOT_EXIST_USER => "用户不存在",

        FlagConstant::ERROR_PWD => "密码错误",

        FlagConstant::FREEZE_USER => "用户已停用",

        FlagConstant::CODE_NOT_EXIT => "编号不存在",
        FlagConstant::CODE_NOT_VALID => "非有效编号",
    );
}
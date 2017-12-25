<?php
/**
 * Created by leon
 * Date: 2016-10-25 18:36
 */

namespace Library\Constant;


class FlagConstant
{
    const ADMIN_REDIRECT_LOG_IN = 999; // 后台未登录状态 /Login

    const INSERT_FAIL = 1001; // 保存失败
    const UPDATE_FAIL = 1002; // 更新失败
    const COPY_FAIL = 1003; // 复制失败
    const CODE_NOT_EXIT = 1011; // 编号不存在
    const CODE_NOT_VALID = 1012; // 非有效编号
    const ERROR_PATH = 1001; // 路径不存在

    const NEED_NAME = 2001; // 请填写用户名
    const NEED_PWD = 2002; // 请填写密码
    const NEED_ROLE = 2003; // 请填选角色

    const NOT_EXIST_USER = 3001; // 用户不存在

    const ERROR_PWD = 4001; // 密码错误

    const FREEZE_USER = 5001; // 用户已停用
}
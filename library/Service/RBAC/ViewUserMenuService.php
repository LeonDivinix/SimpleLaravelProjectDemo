<?php
/**
 * Created by leon
 * Date: 2016-11-08 09:16
 */

namespace Library\Service\RBAC;

use Library\Constant\ConfigConstant;
use Library\Dao\RBAC\ViewUserMenuDao;
use Library\Inherit\Service\Admin\AdminService;

class ViewUserMenuService extends AdminService
{
    /**
     * 创建Dao
     * 使用XXX::class
     * @return string 继承自该类的Dao
     */
    public function buildDaoName()
    {
        return ViewUserMenuDao::class;
    }

    /**
     * 获得自己的权限菜单
     * @param $userId
     * @param int $module 大模块
     * @return array
     */
    public function getOwnMenus($userId)
    {
        $result = $this->query(
            "menu_status = ? and parent_menu_status = ? and role_status = ? and user_status = ? and user_id = ?",
            array(1, 1, 1, 1, $userId),
            "*",
            "menu_p_sort, menu_sort");
        return $result;
    }

    /**
     * 检查权限
     * @param $userId
     * @param $requestUri
     * @return mixed 失败返回false否则返回权限值
     */
    public function checkAuth($userId, $requestUri) {
        // 查找出用户所有的模块功能，并组装成 模块名=>权限值 的map
        $list = $this->query(
            "menu_status = ? and parent_menu_status = ? and role_status = ? and user_status = ? and user_id = ?",
            array(1, 1, 1, 1, $userId),
            "url, permission"
            );
        $userPermissionMap = array(); // 用户权限map
        foreach ($list as $v) {
            $userPermissionMap[strtolower($v["url"])] = $v["permission"];
        }
        unset($list);

        // 处理Uri(/模块/操作[?参数=....])，摘要出模块及操作
        $requestUri = strtolower(ltrim($requestUri, "/"));
        $uri = explode("?", $requestUri);
        $uri = explode("/", $uri[0]); // array("模块", "操作(可能有也可能没有)")

        // 所有权限基于模块，模块一定判断。
        if (!isset($userPermissionMap[$uri[0]])) {
            return false;
        }

        // 用户模块权限
        $userPermission = $userPermissionMap[$uri[0]]; // 用户指定module的操作权限
        // 无操作或操作为index或没有配置操作，则判断为查询权限即可，因为已经判断了模块，此处必返回true
        if (empty($uri[1]) || !isset(ConfigConstant::$ADMIN_OPERATE_PERMISSION[$uri[1]])) {
            return $userPermission;
        }

        $needPermission = ConfigConstant::$ADMIN_OPERATE_PERMISSION[$uri[1]]; // 需要的的操作权限值
        if ($needPermission === ConfigConstant::ADMIN_PERMISSION_QUERY
            || (($needPermission & $userPermission) == $needPermission)) { // 仅查询无需再判断明细权限其它则需判断
            return $userPermission;
        }
    }
}
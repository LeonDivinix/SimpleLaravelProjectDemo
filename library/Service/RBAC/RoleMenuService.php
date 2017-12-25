<?php
/**
 * Created by leon
 * Date: 2016-11-25 23:30
 */

namespace Library\Service\RBAC;


use Library\Dao\RBAC\RoleMenuDao;
use Library\Inherit\Service\Admin\AdminService;

class RoleMenuService extends AdminService
{
	/**
     * 创建Dao
     * 使用XXX::class
     * @return string 继承自该类的Dao
     */
    public function buildDaoName()
    {
        return RoleMenuDao::class;
    }

    /**
     * 获得角色的菜单及权限
     * @param $id
     * @return array
     */
    public function getMenuByRoleId($id) {
        return $this->query("role_id = ?", array($id), "menu_id, permission");
    }

    /**
     * 保存角色权限
     * @param $roleId
     * @param $operatorId
     * @param $roleMenuAry
     */
    public function saveAll($roleId, $operatorId, $roleMenuAry) {
        $this->querySql("delete from " . $this->getTableName() . " where role_id = ?", array($roleId));
        $data = array(
            "role_id" => $roleId,
            "create_at" => "now()",
            "create_by" => $operatorId
        );
        foreach ($roleMenuAry as $menuId => $permission) {
            $data["menu_id"] = $menuId;
            $data["permission"] = $permission;
            $this->insert($data);
        }
    }
}
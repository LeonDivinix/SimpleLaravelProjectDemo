<?php
/**
 * Created by leon
 * Date: 2016-11-22 20:59
 */

namespace Library\Service\RBAC;


use Library\Dao\RBAC\RoleDao;
use Library\Inherit\Service\Admin\AdminService;

class RoleService extends AdminService
{
    /**
     * 创建Dao
     * 使用XXX::class
     * @return string 继承自该类的Dao
     */
    public function buildDaoName()
    {
        return RoleDao::class;
    }

    /**
     * 获得有效的角色列表
     * @return array|bool|int|string
     */
    public function getRoles() {
        return $this->query("status = ?", array(1), "id, title", "sort, id");
    }
}
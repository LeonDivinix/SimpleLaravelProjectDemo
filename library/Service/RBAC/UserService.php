<?php
/**
 * Created by leon
 * Date: 2016-11-08 09:16
 */

namespace Library\Service\RBAC;

use Library\Dao\RBAC\UserDao;
use Library\Inherit\Service\Admin\AdminService;

class UserService extends AdminService
{
    /**
     * 创建Dao
     * 使用XXX::class
     * @return string 继承自该类的Dao
     */
    public function buildDaoName()
    {
        return UserDao::class;
    }

    /**
     * 根据用户名获得用户信息
     * @param $userName
     * @return array|bool|int|string
     */
    public function getAdminUserByName($userName) {
        return $this->find("name = ?", array($userName));
    }
}
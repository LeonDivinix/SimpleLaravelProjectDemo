<?php
/**
 * Created by leon
 * Date: 2016-11-25 23:18
 */

namespace Library\Dao\RBAC;


use Library\Inherit\Dao\Admin\AdminDao;

class RoleMenuDao extends AdminDao
{
	/**
     * 构建表名
     * @return string
     */
    function buildTableName()
    {
        return "r_role_menu";
    }

}
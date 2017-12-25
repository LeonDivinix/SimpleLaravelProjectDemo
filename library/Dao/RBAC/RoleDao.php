<?php
/**
 * Created by leon
 * Date: 2016-11-22 20:59
 */

namespace Library\Dao\RBAC;


use Library\Inherit\Dao\Admin\AdminDao;

class RoleDao extends AdminDao
{
    /**
     * 构建表名
     * @return string
     */
    function buildTableName()
    {
        return "t_role";
    }

}
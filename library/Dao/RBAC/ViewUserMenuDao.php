<?php
/**
 * Created by leon
 * Date: 2016-11-08 09:14
 */

namespace Library\Dao\RBAC;

use Library\Inherit\Dao\Admin\AdminDao;

class ViewUserMenuDao extends AdminDao
{
    /**
     * 构建表名
     * @return string
     */
    function buildTableName()
    {
        return "admin_view_user_menu";
    }

}
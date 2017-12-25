<?php
/**
 * Created by leon
 * Date: 2016-11-22 20:46
 */

namespace App\Http\Controllers\RBAC;

use Library\Inherit\Controller\Admin\AdminEditController;
use Library\Service\RBAC\MenuService;
use Library\Service\RBAC\RoleMenuService;
use Library\Service\RBAC\RoleService;
use Library\Util\CoreUtil;

class RoleController extends AdminEditController
{
    /**
     * 构建模型名称
     * @return string
     */
    function buildBandName()
    {
        return RoleService::class;
    }

    /**
     * 创建额外的展示信息，用于增加、修改或信息展示
     * @param array $data 查询结果记录，key值为使用字段
     * @param int $operate 1增加 2修改 3信息展示
     */
    protected function buildDisplayInfo(&$data, $operate)
    {
        $menuService = app(MenuService::class);
        $this->assign("menuList", $menuService->getValidMenuTree());
        $roleMenuMap = array();
        if (!empty($data["id"])) {
            $roleMenuService = app(RoleMenuService::class);
            $roleMenuList = $roleMenuService->getMenuByRoleId($data["id"]);
            foreach ($roleMenuList as $v) {
                $roleMenuMap[$v["menu_id"]] = $v["permission"];
            }
        }
        $this->assign("roleMenuMap", $roleMenuMap);
    }

    /**
     * 构造Grid数据集查询sql配置
     * @return array("listModel"=>"不填则用默认Service查询",
     * "condition" => "条件", "values" => "值", "orderBy" => "排序字段")
     */
    protected function buildGridDataConfig()
    {
        $condition = "1=1";
        $values = array();
        $this->buildRightLikeCondition($condition, $values, array("title" => "title"));
        $this->buildEqualCondition($condition, $values, array("status" => "status"));
        return array(
            // "listModel"=>"",
            "condition" => $condition,
            "values" => $values,
            "orderBy" => "sort"
        );
    }


    /**
     * 构建导出数据结构
     * @return array|null 查询数据集，返回null，用默认的查询结果
     */
    protected function buildExportData()
    {
        // TODO: Implement buildExcelData() method.
    }

    /**
     * 验证保存数据
     * @param array $data 保存数据
     * @param int $operate 操作类型
     * * @return int flag ("flag"=>来自FlagConstant)
     */
    protected function validSaveData(&$data, $operate)
    {
        $result = 0;
        return $result;
    }

    /**
     * 构建保存数据
     * @param array $data 保存数据
     * @param int $operate 操作类型
     */
    protected function buildSaveData(&$data, $operate)
    {
        // TODO: Implement buildSaveData() method.
    }

    /**
     * 保存后的操作
     * @param $data
     * @param $operate
     * @param $old
     */
    protected function afterSaveData($data, $operate, $old)
    {
        $prefix = $data["role_menu_prefix"];
        $roleMenuAry = array();

        foreach ($data as $k => $v) {
            if (strpos($k, $prefix) !== false && !CoreUtil::isEmpty($v)) {
                $tmp = str_replace($prefix, "", $k);
                list($menuId, $permission) = explode("_", $tmp);
                if (isset($roleMenuAry[$menuId])) {
                    $roleMenuAry[$menuId] = $roleMenuAry[$menuId] + $permission;
                }
                else {
                    $roleMenuAry[$menuId] = $permission;
                }
            }
        }
        if (!empty(($roleMenuAry))) {
            $roleMenuService = app(RoleMenuService::class);
            if ($operate == self::DB_OPERATE_INSERT || $operate == self::DB_OPERATE_COPY) {
                $operatorId = $data["create_by"];
            }
            else {
                $operatorId = $data["update_by"];
            }
            $roleMenuService->saveAll($data["id"], $operatorId, $roleMenuAry);
        }
    }

}
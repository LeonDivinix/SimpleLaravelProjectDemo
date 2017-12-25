<?php
/**
 * Created by leon
 * Date: 2016-11-15 15:23
 */

namespace App\Http\Controllers\RBAC;

use Library\Constant\ConfigConstant;
use Library\Inherit\Controller\Admin\AdminBaseController;
use Library\Service\RBAC\MenuService;
use Library\Service\RBAC\ViewUserMenuService;

class MenuController extends AdminBaseController
{
    /**
     * 获得我的菜单
     */
    public function ownAction() {
        $service = app(ViewUserMenuService::class);
        $result["flag"] = 0;
        $result["result"] = $service->getOwnMenus($this->getSessionOperatorId());
        $this->returnJson($result);
    }

    /**
     * 菜单页面
     * 树形
     */
    public function indexAction()
    {
        $op = $this->getSessionOperatorPermission(); // 操作员权限值
        $this->assign(
            "canEdit",
            $op === false || (ConfigConstant::ADMIN_PERMISSION_EDIT & $op) != ConfigConstant::ADMIN_PERMISSION_EDIT
                ? false : true);
        $this->display();
    }

    /**
     * 获得菜单数据
     */
    public function treeAction()
    {
        $service = app(MenuService::class);
        $this->returnJson(array("flag" => 0, "result" => $service->getAll()));
    }

    /**
     * 保存数据
     */
    public function saveAction()
    {
        $data = $this->request();
        foreach ($data as $k => $v) {
            if (strcasecmp("NaN", $v) === 0) {
                $data[$k] = 0;
            }
        }
        $service = app(MenuService::class);
        $data["operator"] = $this->getSessionOperatorId();
        $result = $service->save($data);
        $this->returnJson($result);
    }
}
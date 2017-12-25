<?php
/**
 * Created by leon
 * Date: 2016-11-08 11:41
 */

namespace App\Http\Controllers\RBAC;


use Library\Constant\FlagConstant;
use Library\Inherit\Controller\Admin\AdminEditController;
use Library\Service\RBAC\RoleService;
use Library\Service\RBAC\UserService;
use Library\Util\TimeUtil;
use Library\Util\StringUtil;

class UserController extends AdminEditController
{
    /**
     * 构建模型名称
     * @return string
     */
    function buildBandName()
    {
        return UserService::class;
    }

    /**
     * 创建额外的展示信息，用于增加、修改或信息展示
     * @param array $data 查询结果记录，key值为使用字段
     * @param int $operate 1增加 2修改 3信息展示
     */
    protected function buildDisplayInfo(&$data, $operate)
    {
        if ($operate == self::DB_OPERATE_INFO) {
            $roleService = app(RoleService::class);
            $this->assign("roleName", $roleService->getById($data["role_id"], "title"));
        }
        else {
            $data["roles"] = app(RoleService::class)->getRoles();
        }
    }

    /**
     * 构造Grid数据集查询sql配置
     * @return array("listModel"=>"不填则用默认Service查询",
     * "condition" => "条件", "values" => "值", "orderBy" => "排序字段")
     */
    protected function buildGridDataConfig()
    {
        return array(
            // "listModel"=>"",
            "condition" => "1=1",
            "values" => array(),
            "orderBy" => "create_at desc"
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
     * @param $data
     * @return array array("flag"=>)
     */
    private function _validInsertData(&$data) {
        $result = 0;
        if (empty($data["password"])) {
            $result = FlagConstant::NEED_PWD;
        }
        return $result;
    }


    /**
     * 验证保存数据
     * @param array $data 保存数据
     * @param int $operate 操作类型
     * @return int flag 来自FlagConstant
     */
    protected function validSaveData(&$data, $operate)
    {
        $result = 0;
        if (self::DB_OPERATE_INSERT == $operate) {
            $result = $this->_validInsertData($data);
        }
        if ($result !== 0) {
            return $result;
        }
        if (empty($data["role_id"])) {
            return FlagConstant::NEED_ROLE;
        }
        return $result;
    }

    /**
     * 构建保存数据
     * @param array $data 保存数据
     * @param int $operate 操作类型
     */
    protected function buildSaveData(&$data, $operate)
    {
        switch($operate)
        {
            case self::DB_OPERATE_INSERT:
                $this->_buildInsertData($data);
                break;
            case self::DB_OPERATE_UPDATE:
                $this->_buildUpdateData($data);
                break;
        }

        if (!empty($data["birth"])) {
            $data["birth"] = TimeUtil::dojoStrToDate($data["birth"]);
        }
        else {
            $data["birth"] = null; // 不保存生日
        }

        if (!empty($data["password"])) {
            $data["complex_value"] = StringUtil::randomString(16);
            $data["password"] = md5($data["password"] . $data["complex_value"]);
        }
        else {
            unset($data["password"]); // 不保存密码
        }
    }

    /**
     * 构建插入数据
     * @param $data
     */
    private function _buildInsertData(&$data)
    {
        //
    }

    /**
     * 构建修改数据
     * @param $data
     */
    private function _buildUpdateData(&$data)
    {
        //
    }


    /**
     * 保存后的操作
     * @param $data
     * @param $operate
     * @param $old
     */
    protected function afterSaveData($data, $operate, $old)
    {
        // TODO: Implement afterSaveData() method.
    }


}
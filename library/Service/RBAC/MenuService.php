<?php
/**
 * Created by leon
 * Date: 2016-11-02 09:12
 */

namespace Library\Service\RBAC;


use Library\Constant\FlagConstant;
use Library\Dao\RBAC\MenuDao;
use Library\Inherit\Service\Admin\AdminService;

class MenuService extends AdminService
{
    /**
     * 构建模型名称
     * @return string XXX:class
     */
    function buildDaoName()
    {
        return MenuDao::class;
    }

    /**
     * 获得所有的菜单
     * @return array
     */
    public function getAll()
    {
        return $this->query("", array(), '*', "level, sort");
    }

    /**
     * 保存数据
     * @param $data
     * @return array
     */
    public function save($data)
    {
        $result = array("flag" => 0);
        if (empty($data["id"]))
        {
            unset($data["id"]);
            $data["create_by"] = $data["operator"];
            $data["create_at"] = "now()";
            $data = $this->create($data);
            $data["id"] = $this->insert($data);
            if (empty($data["id"]))
            {
                $result["flag"] = FlagConstant::INSERT_FAIL;
            }
        }
        else {
            $data["update_by"] = $data["operator"];
            $data["update_at"] = "now()";
            $data = $this->create($data);
            $count = $this->updateById($data["id"], $data);
            if ($count === false)
            {
                $result["flag"] = FlagConstant::UPDATE_FAIL;
            }
        }
        if (0 === $result["flag"]) {
            $result["result"] = $this->findById($data["id"]);
        }
        return $result;
    }

    /**
     * 构建有效菜单树
     */
    public function getValidMenuTree() {
        $result = array();
        $list = $this->query("status = ? and level > ?", array(1, 0), "id, pid, level, tag, title, url", "level, sort");
        foreach ($list as $v) {
            if ($v["level"] == 1) {
                $v["children"] = array();
                $result[$v["id"]] = $v;
            }
            else {
                $result[$v["pid"]]["children"][$v["id"]] = $v;
            }
        }
        return $result;
    }
}
<?php
/**
 * Created by leon
 * Date: 2016-11-02 20:38
 */

namespace Library\Inherit\Service\Admin;


use Library\Inherit\Service\CommonService;

abstract class AdminService extends CommonService
{
    /**
     * 创建Dao
     * 使用XXX::class
     * @return string 继承自该类的Dao
     */
    public abstract function buildDaoName();

    function __construct() {
        parent::__construct();
        $this->setDaoName($this->buildDaoName());
    }
}
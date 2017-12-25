<?php
/**
 * Created by leon
 * Date: 2016-11-03 10:18
 */

namespace Library\Inherit\Service;

abstract class CommonService extends BaseService
{
    /**
     * 继承自Model的Dao的类名
     * 使用XXX::class
     * @var
     */
    private $_daoName;

    /**
     * 继承自Model的Dao
     * @var \Library\Inherit\Dao\BaseDao
     */
    private $_dao;

    function __construct() {
        parent::__construct();
    }

    function __destruct() {
        parent::__destruct();
        $this->_dao = null;
    }

    /**
     * 初始化Dao
     */
    private function _iniDao() {
        if (empty($_dao)) {
            $this->_dao = app($this->_daoName);
        }
    }

    /**
     * 设置dao名称
     * 使用XXX::class
     * @param $daoName
     */
    public function setDaoName($daoName) {
        $this->_daoName = $daoName;
    }

    /**
     * 获得表名
     * @return string
     */
    public function getTableName() {
        $this->_iniDao();
        return $this->_dao->getTable();
    }

    /**
     * 过滤
     * @param $data
     * @param bool $isFilter false 返回数据结构
     * @return array
     */
    public function create($data, $isFilter = true) {
        $this->_iniDao();
        return $this->_dao->create($data, $isFilter);
    }
// ---------------------------------------------------------------------------------------------------------------------
    /**
     * 获得分页列表数据
     * 默认20条
     * @param string $condition 查询条件
     * @param array $values 绑定参数
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param string $orderBy 排序字段 默认不排序
     * @param int $start 起始记录
     * @param int $pageSize 分页记录数 0查询全部
     * @return array 数据列表
     */
    public function queryList($condition = "", $values = array(), $fields = "*",
                $orderBy = "", $start = 0, $pageSize = 20) {
        $this->_iniDao();
        return $this->_dao->queryList($condition, $values, $fields, $orderBy, $start, $pageSize);
    }

    /**
     * 获得列表计数
     * @param string $condition 条件，带？匹配符
     * @param array $values 条件值
     * @param string $countField 记录条数使用字段（不用*）
     * @return int
     */
    public function count($condition = "", $values = array(), $countField = 'id') {
        $this->_iniDao();
        return $this->_dao->count($condition, $values, $countField);
    }

    /**
     * 获得分页列表及计数
     * 默认20条
     * @param string $condition 条件，带%d %s等匹配符
     * @param array $values 条件值
     * @param string $orderBy 排序字段 默认不排序
     * @param int $start 起始记录
     * @param int $pageSize 分页记录数 0查询全部
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param string $countField 记录条数使用字段（不用*）
     * @return array result=>数据列表 total=>记录数 start=>起始记录索引
     */
    public function queryListAndCount($condition = "", $values = array(), $orderBy = null,
                                      $start = 0, $pageSize = 20, $fields = "*", $countField = 'id'  ) {
        $this->_iniDao();
        return $this->_dao->queryListAndCount($condition, $values, $orderBy, $start, $pageSize, $fields, $countField);
    }

    /**
     * 查询
     * 默认全部符合条件的数据
     * @param string $condition 使用?构建。比如 name like '%?%' and phone = '?'
     * @param array $values
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param string $orderBy 排序字段及升降序语句
     * @param int $start 记录集开始索引，默认0
     * @param int $pageSize 小于等于0时，查询全部数据，默认20条
     * @param bool|false $isDistinct
     * @return array|bool|int|string
     */
    public function query($condition = "", $values = array(), $fields = "*", $orderBy = "", $start = 0, $pageSize = 0,
                          $isDistinct = false) {
        $this->_iniDao();
        return $this->_dao->query($condition, $values, $fields, $orderBy, $start, $pageSize, $isDistinct);
    }

    /**
     * 单记录查询
     * @param $condition
     * @param $values
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param $orderBy
     * @return array
     */
    public function find($condition, $values, $fields = "*", $orderBy = "") {
        $this->_iniDao();
        return $this->_dao->find($condition, $values, $fields, $orderBy);
    }

    /**
     * 单记录查询
     * @param $id
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @return mixed 数组或null
     */
    public function findById($id, $fields = "*") {
        $this->_iniDao();
        return $this->_dao->findById($id, $fields);
    }

    /**
     * 根据获得唯一字段值
     * @param $id
     * @param string|array $field 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @return mixed 数组或null
     */
    public function getById($id, $field = "id") {
        $this->_iniDao();
        return $this->_dao->getById($id, $field);
    }

    /**
     * 获得唯一字段值
     * @param $condition
     * @param $values
     * @param $field
     * @param string $orderBy
     * @return array|bool|int|string
     */
    public function get($condition, $values, $field, $orderBy = "") {
        $this->_iniDao();
        return $this->_dao->get($condition, $values, $field, $orderBy);
    }

    /**
     * 插入
     * 实例：
     * insert("table_user", array("name"=>"xyz", "gender"=>null))

     * @param array $fieldValues 字段=>值
     * @return bool|string
     */
    public function insert($fieldValues) {
        $this->_iniDao();
        return $this->_dao->insert($fieldValues);
    }

    /**
     * 修改
     * 示例：
     * update("table_user", array("name"=>"xyz", "gender"=>null), "id=? and status=?", array(1976, 1));
     * @param array $fieldValues 字段 => 值
     * @param string $condition 修改条件，不能为空，必须含?
     * @param array $values 条件含?对应用的值
     * @return int
     */
    public function update($fieldValues, $condition, $values) {
        $this->_iniDao();
        return $this->_dao->update($fieldValues, $condition, $values);
    }


    /**
     * 根据id修改一条记录
     * @param $id
     * @param array $fieldValues 字段 => 值
     * @return bool|int
     */
    public function updateById($id, $fieldValues) {
        $this->_iniDao();
        return $this->_dao->updateById($id, $fieldValues);
    }

    /**
     * 更新sql
     * 不推荐用
     * @param $sql
     * 例: 执行update member set state = 1 where id = 1
     * 调用updateSql("state = ? where id = ?", array(1, 1))
     * @param array $values
     * @return false|int
     */
    public function updateSql($sql, $values = array()) {
        $this->_iniDao();
        return $this->_dao->updateSql($sql, $values);
    }

    /**
     * 插入sql
     * @param $sql
     * 例: 执行insert into member (id, state) values (1, 1)
     * insertSql("member (id, state) values (?, ?)", array(1, 1))
     * @param array $values
     * @return false|int
     */
    public function insertSql($sql, $values = array()) {
        $this->_iniDao();
        return $this->_dao->insertSql($sql, $values);
    }

    /**
     * 执行查询sql
     * @param $sql
     * @param array $values
     * @return array
     */
    public function querySql($sql, $values = array()) {
        $this->_iniDao();
        return $this->_dao->querySql($sql, $values);
    }

    /**
     * 删除sql
     * 不推荐用
     * @param $sql
     * 例: 执行update member set state = 1 where id = 1
     * 调用inertSql("and id=? ", array(1))
     * @param array $values
     * @return false|int
     */
    public function deleteSql($sql, $values = array()) {
        $this->_iniDao();
        return $this->_dao->deleteSql($sql, $values);
    }

    /**
     * 构建sql语句
     * @param string $fields
     * @param string $condition
     * @param string $orderBy
     * @param int $start
     * @param int $pageSize
     * @param bool|false $isDistinct
     * @return array|bool|int|string
     */
    public function buildQuerySql($fields = "*", $condition = "", $orderBy = "", $start = 0, $pageSize = 0,
                $isDistinct = false) {
        $this->_iniDao();
        return $this->_dao->buildQuerySql($fields, $condition, $orderBy, $start, $pageSize, $isDistinct);
    }

    /**
     * 创建uuid
     * @return string
     */
    public function buildUUID() {
        $result = "";
        $this->_iniDao();
        $list = $this->_dao->querySql("SELECT uuid_generate_v4() uuid;");
        if (!empty($list[0])) {
            $result = $list[0]["uuid"];
        }
        return $result;
    }
}
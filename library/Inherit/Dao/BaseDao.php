<?php
/**
 * Created by leon
 * Date: 2016-11-02 20:59
 */

namespace Library\Inherit\Dao;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BaseDao
{
    /**
     * 数据库配置
     * @var mixed|string
     */
    private $_dbConfig = "";

    /**
     * 表名
     * @var string
     */
    private $_table = '';
    /**
     * 数据库映射字段
     * 表单字段=>数据库字段
     * @var array
     */
    protected $fields = array();

    const DB_DRIVER_PGSQL = "pgsql";
    const DB_DRIVER_MYSQL = "mysql";

    /**
     * @var \Illuminate\Database\PostgresConnection
     */
    private $_connection;

    /**
     * 构造函数
     * @param string $dbConfig 数据库连接配置key
     */
    public function __construct($dbConfig = "") {
        // 模型初始化
        $this->_initialize();
        if (empty($dbConfig)) {
            $dbConfig = config('database.default'); // 没有传参数，使用默认值
        }
        $this->_dbConfig = $dbConfig;
    }

    /**
     *
     */
    function __destruct() {
        $this->_connection = null;
    }

    // 回调方法 初始化模型
    protected function _initialize() {}

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->_table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->_table = $table;
    }

    /**
     * 获得数据库名称
     * @return mixed
     */
    public function getDatabaseName() {
        return $this->_connection->getDatabaseName();
    }

    /**
     * 创建连接
     */
    private function _buildConnection() {
        if (empty($this->_connection)) {
            $this->_connection = DB::connection($this->_dbConfig);
        }
    }

    /**
     * 过滤
     * 剔除多余字段
     * 转换映射字段
     * @param $data
     * @param $isFilter
     * @return array
     */
    public function create($data, $isFilter = true) {
        $result = array();
        $fields = $this->_getFields();
        if ($isFilter) {
            foreach ($data as $k => $v) {
                if (isset($this->fields[$k])) {
                    $result[$this->fields[$k]] = $v;
                } else if (isset($fields[$k])) {
                    $result[$k] = $v;
                }
            }
        }
        else {
            foreach ($fields as $k => $v) {
                $result[$k] = "";
            }
        }
        return $result;
    }

    /**
     * 获得数据库字段
     * @return array|mixed
     */
    private function _getFields() {
        $result = array();
        $tableName = $this->getTable();
        $config = config('database.connections.' . $this->_dbConfig);
        $dbName = $config["database"];
        $filePath = config('cache.stores.file.path');
        if (!empty($tableName)) {
            $file = $filePath . "/_fields/";
            if (!is_dir($file)) {
                mkdir($file, 0755, true);
            }
            $file .= $dbName . "." . $tableName . ".php";
            if (file_exists($file)) {
                $result = unserialize(file_get_contents($file));
            } else {
                $result = $this->_buildField($config["driver"]);
                file_put_contents($file, serialize($result));
            }
        }
        return $result;
    }

    /**
     * 构建字段缓存
     * @param $driver
     * @return array
     * @throws \Exception
     */
    private function _buildField($driver) {
        switch ($driver) {
            case self::DB_DRIVER_PGSQL:
                $result = $this->_buildPGsqlField();
                break;
            case self::DB_DRIVER_MYSQL:
                $result = $this->_buildMysqlField();
                break;
            default:
                throw new \Exception("请在BaseDao中添加该数据库{$driver}字段缓存方法！");

        }
        return $result;
    }

    /**
     * 构建mysql字段
     * @return array
     */
    private function _buildMysqlField() {
        $sql   = 'SHOW COLUMNS FROM `' . $this->getTable() . '`';
        $fields = $this->querySql($sql, array());
        $result   =   array();
        if($fields) {
            foreach ($fields as $key => $val) {
                $result[$val['Field']] = $val['Field'];
            }
        }
        return $result;
    }

    /**
     * 构建postgresql字段
     * @return array
     */
    private function _buildPGsqlField() {
        $sql = "SELECT a.attname AS field_name FROM pg_class AS c, pg_attribute AS a
            WHERE c.relname = ? AND a.attrelid = c.oid AND a.attnum > 0";
        $fields = $this->querySql($sql, array($this->getTable()));
        $result   =   array();
        if($fields) {
            foreach ($fields as $key => $val) {
                $result[$val['field_name']] = $val['field_name'];
            }
        }
        return $result;
    }

// ---------------------------------------------------------------------------------------------------------------------
    /**
     * 构建查询条件
     * @param string $table
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param string $condition 使用?构建。比如 name like '%?%' and phone = '?'
     * @param string $orderBy 排序字段及升降序语句
     * @param int $start 记录集开始索引，默认0
     * @param int $pageSize 小于等于0时，查询全部数据，默认20条
     * @param bool|false $isDistinct
     * @return array|bool|int|string
     */
    public function buildQuerySql($table, $fields, $condition = "", $orderBy = "", $start = 0, $pageSize = 0,
                                  $isDistinct = false) {
        $sql = "";
        // 构建字段
        if (is_array($fields)) {
            $oneFlag = true;
            foreach ($fields as $alias => $field) {
                if ($field === "") {
                    $sql .= $alias . ",";
                }
                else if ($oneFlag && $alias === 0) {
                    $sql .= implode(",", $fields);
                    break;
                }
                else {
                    $sql .= "{$field} as {$alias},";
                }
                $oneFlag = false;
            }
            $sql = rtrim($sql, ",");
            unset($fields);
        }
        else {
            $sql .= $fields . " ";
        }

        if ($isDistinct) {
            $sql = "distinct " . $sql;
        }
        $sql = "select " . $sql . " from " . $table;
        if (!empty($condition)) {
            $sql .= " where {$condition} ";
        }
        if (!empty($orderBy)) {
            $sql .= " order by {$orderBy}";
        }
        if ($pageSize > 0) {
            $sql .= " limit {$pageSize} offset {$start}";
        }
        return $sql;
    }

    /**
     * 获得分页列表数据
     * 默认20条
     * @param string $condition 条件，带？匹配符
     * @param array $values 条件值
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * @param string $orderBy 排序字段 默认不排序
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param int $start 起始记录
     * @param int $pageSize 分页记录数 0查询全部
     * @return array 数据列表
     */
    public function queryList($condition, $values, $fields = "*", $orderBy = "", $start = 0, $pageSize = 20) {
        $this->_buildConnection();
        $sql = $this->buildQuerySql($this->getTable(), $fields, $condition, $orderBy, $start, $pageSize);
        return $this->_connection->select($sql, $values);
    }

    /**
     * 获得数据集计数
     * @param string $condition 条件，带？匹配符
     * @param array $values 条件值
     * @param $countField $field 记录条数使用字段（不用*）
     * @return int
     */
    public function count($condition, $values, $countField = 'id') {
        $this->_buildConnection();
        $sql = $this->buildQuerySql($this->getTable(),  "count('{$countField}') num", $condition, "", 0, 1);
        $result = $this->_connection->select($sql, $values);
        if (!empty($result)) {
            $result = $result[0]["num"];
        }
        return $result;
    }

    /**
     * 获得分页列表及计数
     * 默认20条
     * @param string $condition 条件，带%d %s等匹配符
     * @param string $values 条件值
     * @param string $orderBy 排序字段 默认不排序
     * @param int $start 起始记录
     * @param int $pageSize 分页记录数 0查询全部
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param string $countField 记录条数使用字段（不用*）
     * @return array result=>数据列表 total=>记录数 start=>起始记录索引
     */
    public function queryListAndCount($condition, $values, $orderBy = "",
                $start = 0, $pageSize = 20, $fields = "*", $countField = 'id') {
        $count = $this->count($condition, $values, $countField);
        $result["result"] = $this->queryList($condition, $values, $fields, $orderBy, $start, $pageSize);
        $result["total"] = $count;
        $result["start"] = $start;
        return $result;
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
        $this->_buildConnection();
        $sql = $this->buildQuerySql($this->getTable(), $fields, $condition, $orderBy, $start, $pageSize, $isDistinct);
        return $this->_connection->select($sql, $values);
    }

    /**
     * 单记录查询
     * @param $condition
     * @param $values
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @param $orderBy
     * @return mixed 数组或null
     */
    public function find($condition, $values, $fields = "*", $orderBy = "") {
        $result = $this->query($condition, $values, $fields, $orderBy);
        if (!empty($result)) {
            $result = $result[0];
        }
        return $result;
    }

    /**
     * 根据id单记录查询
     * @param $id
     * @param string|array $fields 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @return mixed 数组或null
     */
    public function findById($id, $fields = "*") {
        return $this->find("id = ?", array($id), $fields);
    }

    /**
     * 根据获得唯一字段值
     * @param $id
     * @param string|array $field 查询字段 array("别名(字段为空，此key作为字段)" => "字段") 默认*。
     * 例：array("buyNum" => "count(id)"); array("eName" => "e_name"); id; id,e_name; id, e_name eName
     * @return mixed 数组或null
     */
    public function getById($id, $field) {
        return $this->get("id = ?", array($id), $field);
    }

    /**
     * 获得唯一字段值
     * 未查询到数据返回null
     * @param $condition
     * @param $values
     * @param $field
     * @param string $orderBy
     * @return null|bool|int|string
     */
    public function get($condition, $values, $field, $orderBy = "") {
        $result = $this->query($condition, $values, $field, $orderBy, 0, 1, false);
        if (!empty($result)) {
            $result = $result[0][$field];
        }
        else {
            $result = null;
        }
        return $result;
    }

    /**
     * 获取创建时间最大值
     * @return int
     */
    public function getMaxCreateTime() {
        $result = $this->find("", array(), "max(create_time) create_time");
        if (!empty($result['create_time'])) {
            $result = $result['create_time'];
        }
        else {
            $result = 0;
        }
        return $result;
    }

    /**
     * 插入
     * 实例：
     * insert("table_user", array("name"=>"xyz", "gender"=>null))
     * @param array $fieldValues 字段=>值
     * @return bool|string
     */
    public function insert($fieldValues) {
        $this->_buildConnection();
        if (!empty($id)) {
            $result = $this->_connection->table($this->_table)->insert($fieldValues);
            if (!empty($result)) {
                $result = $id;
            }
        }
        else {
            $result = $this->_connection->table($this->_table)->insertGetId($fieldValues);
        }
        return $result;
    }

    /**
     * 修改
     * update("table_user", array("name"=>"xyz", "gender"=>null), "id=? and status=?", array(1976, 1));
     * @param array $fieldValues 字段 => 值
     * @param string $condition 修改条件，不能为空，必须含?
     * @param array $values 条件含?对应用的值
     * @return int
     */
    public function update($fieldValues, $condition, $values) {
        $sql = "update {$this->_table} set ";
        $params = array();
        foreach ($fieldValues as $field => $value) {
            $sql .= "{$field}=?,";
            $params[] = $value;
        }
        $sql = rtrim($sql, ",");
        $sql .= " where {$condition}";
        if (!is_array($values)) {
            if (null === $values || "" === $values) {
                $values = array();
            }
            else {
                $values = array($values);
            }
        }
        $params = array_merge($params, $values);
        unset($fieldValues);
        unset($values);
        $this->_buildConnection();
        $result = $this->_connection->update($sql, $params);
        return $result;
    }

    /**
     * 根据id修改一条记录
     * @param array $fieldValues 字段 => 值
     * @param $id
     * @return bool|int
     */
    public function updateById($id, $fieldValues) {
        return $this->update($fieldValues, "id=?", array($id));
    }

    /**
     * 执行查询sql
     * @param $sql
     * @param array $params
     * @return array
     */
    public function querySql($sql, $params = array()) {
        $this->_buildConnection();
        return $this->_connection->select($sql, $params);
    }

    /**
     * 更新sql
     * 不推荐用
     * @param $sql
     * 例: 执行update member set state = 1 where id = 1
     * 调用updateSql(" state = ? where id = ?", array(1, 1))
     * @param array $values
     * @return false|int
     */
    public function updateSql($sql, $values = array()) {
        $this->_buildConnection();
        return $this->_connection->update("update {$this->getTable()} set " . $sql, $values);
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
        $this->_buildConnection();
        return $this->_connection->update("DELETE FROM {$this->getTable()} where 1=1 " . $sql, $values);
    }

    /**
     * 插入sql
     * 不推荐用
     * @param $sql
     * 例: 执行insert into member (id, state) values (1, 1)
     * insertSql("member (id, state) values (?, ?)", array(1, 1))
     * @param array $values
     * @return false|int
     */
    public function insertSql($sql, $values = array()) {
        $this->_buildConnection();
        return $this->_connection->insert("insert into {$this->getTable()} " . $sql, $values);
    }

// ---------------------------------------------------------------------------------------------------------------------
    /**
     * 事务开始
     */
    public function beginTransaction() {
        $this->_buildConnection();
        $this->_connection->beginTransaction();
    }

    /**
     * 事务提交
     */
    public function commit() {
        $this->_buildConnection();
        $this->_connection->commit();
    }

    /**
     * 事务回滚
     */
    public function rollBack() {
        $this->_buildConnection();
        $this->_connection->rollBack();
    }
}
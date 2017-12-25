<?php
/**
 * Created by leon
 * Date: 2016-11-09 15:30
 */

namespace Library\Inherit\Controller\Admin;


use Illuminate\Http\Request;
use Library\Constant\ConfigConstant;
use Library\Helper\ExcelHelper;
use Library\Helper\OperatorSessionHelper;

abstract class AdminCommonController extends AdminBaseController
{
    const DB_OPERATE_INSERT = 1; // 1增加
    const DB_OPERATE_UPDATE = 2; // 2修改
    const DB_OPERATE_COPY = 3;   // 3复制
    const DB_OPERATE_INFO = 4;   // 4信息展示
    const DB_OPERATE_DELETE = 5; // 5删除

    protected $primaryKey = "id";
    /**
     * 绑定service模型名称
     * XXXService::class
     * @var string
     */
    protected $bandName;
    /**
     * @var \Library\Inherit\Service\Admin\AdminService
     */
    private $_band;

    /**
     * 构建模型名称
     * @return string
     */
    abstract protected function buildBandName();

    /**
     * 创建额外的展示信息，用于增加、修改或信息展示
     * @param array $data 查询结果记录，key值为使用字段
     * @param int $operate 1增加 2修改 3复制 4信息展示
     */
    abstract protected function buildDisplayInfo(&$data, $operate);

    /**
     * 构造Grid数据集查询sql配置
     * @return array("listModel"=>"不填则用默认Service查询",
     * "condition" => "条件", "values" => "值", "orderBy" => "排序字段")
     */
    abstract protected function buildGridDataConfig();

    /**
     * 构建导出数据结构
     * @return array|null 查询数据集，返回null，用默认的查询结果
     */
    abstract protected function buildExportData();

    /**
     * 初始化
     */
    public function init() {
        parent::init();
        $this->bandName = $this->buildBandName();
    }

    /**
     *
     */
    function __destruct() {
        parent::__destruct();
        $this->_band = null;
    }

    /**
     * 获得绑定模型
     * @return \Library\Inherit\Service\Admin\AdminService
     */
    protected function buildBand() {
        $this->_initBand();
        return $this->_band;
    }

    /**
     * 初始化模型
     */
    private function _initBand() {
        if (empty($this->_band)) {
            $this->_band = app($this->bandName);
        }
    }

    /**
     * 初始化index页面
     */
    protected function initIndex() {}

// ---------------------------------------------------------------------------------------------------------------------
    /**
     * 列表查询页面
     */
    public function indexAction() {
        $menuId = $this->request("menuId");
        if (empty($menuId)) {
            redirect("/Login");
        }
        $this->assign("menuId", $menuId);
        $this->initIndex();

        $op = $this->getSessionOperatorPermission(); // 操作员权限值
        $permission = array();
        $permission["addUrl"] = false === $op
            || ($op & ConfigConstant::ADMIN_PERMISSION_EDIT) != ConfigConstant::ADMIN_PERMISSION_EDIT ? '""'
            : 'moduleName + "/add"';
        $permission["updateUrl"] = $permission["addUrl"] === '""' ? '""' : 'moduleName + "/update"';
        $permission["copyUrl"] = $permission["addUrl"] === '""' ? '""' : 'moduleName + "/copy"';
        $permission["importUrl"] = false === $op
            || ($op & ConfigConstant::ADMIN_PERMISSION_EXPORT) != ConfigConstant::ADMIN_PERMISSION_EXPORT ? '""'
            : 'moduleName + "/import"';;
        $permission["exportUrl"] = false === $op
            || ($op & ConfigConstant::ADMIN_PERMISSION_IMPORT) != ConfigConstant::ADMIN_PERMISSION_IMPORT ? '""'
            : 'moduleName + "/export"';

        $this->assign($this->permissionKey, $permission);
        $this->display();
    }

    /**
     * Grid查询列表数据
     */
    public function listAction() {
        // 处理排序字段及顺序
        $get = $this->request();
        $orderBy = "";
        if (!empty($get)) {
            foreach ($get as $k => $v) {
                if (0 === strpos($k, "sort(")) {
                    $orderBy .= ' ' . substr($k, 6, -1) . " " . (strcmp("-", $k[5]) === 0 ? "desc" : "asc");
                    break;
                }
            }
        }
        // 处理分页范围
        $range = !isset($_SERVER["HTTP_RANGE"]) ? '0' : $_SERVER["HTTP_RANGE"];
        $start = 0;
        if (!empty($range)) {
            preg_match('/\d+/', $range, $ary);
            $start = $ary[0];
        }
        $pageSize = !isset($_SERVER["HTTP_SIZEPERPAGE"]) ? 20 : $_SERVER["HTTP_SIZEPERPAGE"];
        $result = $this->_queryList($start, $pageSize, $orderBy);

        $this->returnListJson($result);
    }

    /**
     * 查询数据
     * @param $start
     * @param $pageSize
     * @param $orderBy
     * @return array
     */
    private function _queryList($start = 0, $pageSize = 0, $orderBy="") {
        $buildArray = $this->buildGridDataConfig();
        if (!empty($buildArray["listModel"])) {
            $queryModel = app($buildArray["listModel"]);
        }
        else {
            $queryModel = $this->buildBand();
        }
        $result = $queryModel->queryListAndCount(
            $buildArray["condition"],
            $buildArray["values"],
            empty($orderBy) ? (empty($buildArray["orderBy"]) ? "id desc" : $buildArray["orderBy"]) : $orderBy,
            $start,
            $pageSize,
            empty($buildArray["field"]) ? '*' : $buildArray["field"]
        );
        $this->dealList($result);
        return $result;
    }

    /**
     * 处理显示列表
     * @param $list
     */
    protected function dealList(&$list) {}

    /**
     * Grid详情展示
     */
    public function infoAction() {
        //todo 权限
        $sysId = $this->request($this->primaryKey);
        $data = array();
        if (!empty($sysId)) {
            $buildArray = $this->buildGridDataConfig();
            if (!empty($buildArray["listModel"])) {
                $queryModel = app($buildArray["listModel"]);
            }
            else {
                $queryModel = $this->buildBand();
            }
            $data = $queryModel->findById($sysId);
        }
        if (!empty($data)) {
            $this->buildDisplayInfo($data, self::DB_OPERATE_INFO);
        }

        $this->assign("obj", $data);
        $result["flag"] = 0;
        $result["result"] = $this->render("info");
//        $this->writeLog(Constant_Param::ADMIN_LOG_METHOD_QUERY, getRequestParam()); // 日志
        $this->returnJson($result);
    }

    /**
     * 导出到Excel
     */
    public function exportAction() {
        $isSafeMode = ini_get('safe_mode');
        if (empty($isSafeMode)) {
            set_time_limit(0);
            ini_set("memory_limit", "1024M");
        }
        $list = $this->buildExportData();
        if (null === $list) {
            $list = $this->_queryList();
            $list = $list["result"];
        }

        $this->dealExportData($list);
        ExcelHelper::toCustomExcel($list);
        exit;
    }

    protected function dealExportData(&$data) {

    }


    /**
     * 构建and连接的=匹配
     * @param $condition
     * @param $values
     * @param array $params 字段=>表单名
     */
    public function buildEqualCondition(&$condition, &$values, $params) {
        // 字段=>表单名
        $request = app(Request::class);
        foreach ($params as $k => $v) {
            $value = $request->input($v);
            if ("" !== $value && null !== $value && strcasecmp("NaN", $value) !== 0) {
                $condition .= " and {$k} = ?";
                $values[] = $value;
            }
        }
    }

    /**
     * 构建and连接的全匹配
     * @param $condition
     * @param $values
     * @param array $params 字段=>表单名
     */
    public function buildRightLikeCondition(&$condition, &$values, $params) {
        // 字段=>表单名
        $request = app(Request::class);
        foreach ($params as $k => $v) {
            $value = $request->input($v);
            if ("" !== $value && null !== $value) {
                $condition .= " and {$k} like ?";
                $values[] = "{$value}%";
            }
        }
    }

    /**
     * 构建and连接的全匹配
     * @param $condition
     * @param $values
     * @param array $params 字段=>表单名
     */
    public function buildLikeCondition(&$condition, &$values, $params) {
        // 字段=>表单名
        $request = app(Request::class);
        foreach ($params as $k => $v) {
            $value = $request->input($v);
            if ("" !== $value && null !== $value) {
                $condition .= " and {$k} like ?";
                $values[] = "%{$value}%";
            }
        }
    }
}
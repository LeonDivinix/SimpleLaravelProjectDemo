<?php

namespace Library\Inherit\Controller\Admin;



use Illuminate\Http\Request;
use Library\Helper\OperatorSessionHelper;
use Library\Inherit\Controller\BaseController;
use Library\Util\RegexUtil;

class AdminBaseController extends BaseController
{
    private $_themeSplit = "Controllers"; // 命名空间取模板路径切分字符串
    private $_idKey = "id";
    protected $permissionKey = "permission";

    private $_theme;
    private $_params = array(); // 输出参数
    private $_request;

    /**
     * ！！不要使用此构造函数
     * 请用init初始化
     * 请一定配置theme的值
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->_request = $request;
        $this->_theme = config("view.theme");
        $this->init();
    }

    /**
     * 使用此函数进行构造函数初始化
     */
    public function init() {

    }

// 模板视图-------------------------------------------------------------------------------------------------------------
    /**
     * 设置渲染数据
     * @param $key
     * @param $value
     */
    protected function assign($key, $value) {
        $this->_params[$key] = $value;
    }

    /**
     * 构建模板视图路径
     * @param $view
     * @return string
     */
    private function _buildViewPath($view) {
        $ary = explode($this->_themeSplit, get_class($this));
        $modelName = str_replace('\\', '.',  $ary[1]);
        $modelName = RegexUtil::splitUpper($modelName);
        $size = count($modelName);
        if ($size > 0) {
            unset($modelName[$size - 1]);
        }
        $module = implode("", $modelName);
        // 设置模板主题
        if (!empty($this->_theme)) {
            $result = $this->_theme . "{$module}.{$view}";
        }
        else {
            $result = "{$module}.{$view}";
        }
        return $result;
    }

    /**
     * 输出模板
     * @param string $view 分级目录用.分隔
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function display($view = "index", $params = array()) {
        $view = $this->_buildViewPath($view);
        echo view($view, array_merge($this->_params, $params));
    }


    /**
     * 获得渲染模板内容
     * @param string $view 分级目录用.分隔
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function render($view = "index", $params = array()) {
        $view = $this->_buildViewPath($view);
        return view($view, array_merge($this->_params, $params))->render();
    }

    /**
     * 查询列表专用
     * @param array $data 需包含 array("start"=>,"total"=>, "result"=>array())
     */
    protected function returnListJson($data) {
        header("Content-Type:application/json; charset=utf-8");
        header("Content-Range: items {$data['start']}/{$data['total']}");
        exit(json_encode($data["result"]));
    }

    /**
     * 获得操作人id
     * @return int
     */
    protected function getSessionOperatorId() {
        $result = "";
        $info = OperatorSessionHelper::getSession($this->_request);
        if (!empty($info[$this->_idKey])) {
            $result = $info[$this->_idKey];
        }
        return $result;
    }

    /**
     * 获得操作人id
     * @return bool|int 没有权限为false
     */
    protected function getSessionOperatorPermission() {
        $result = false;
        $info = OperatorSessionHelper::getSession($this->_request);
        if (!empty($info[$this->permissionKey])) {
            $result = $info[$this->permissionKey];
        }
        return $result;
    }

    /**
     * 获得参数数据
     * @param string $key
     * @param mixed $default 默认值（该值默认为null）
     * @return mixed 当key不存在，取默认值；key存在则取值，最后进行数据过滤
     */
    protected function request($key = null, $default = null) {
        if (null === $key) {
            $result = $this->_request->all();
            if (empty($result)) {
                $result = file_get_contents('php://input');
                if($result) {
                    $result = json_decode($result, true);
                }
            }
        }
        else {
            $result = $this->_request->input($key, $default);
        }
        return $result;
    }
}

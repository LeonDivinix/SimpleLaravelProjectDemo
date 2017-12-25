<?php
/**
 * Created by leon
 * Date: 2016-11-10 14:57
 *
 */

namespace Library\Inherit\Controller\Admin;


use Illuminate\Http\Request;
use Library\Helper\UploadHelper;
use Library\Util\CoreUtil;

abstract class AdminEditController extends AdminCommonController
{
    private $_operateKey = "operate"; // 使用此关键字做表单字段标识操作

    /**
     * 验证保存数据
     * @param array $data 保存数据
     * @param int $operate 操作类型
     * @return int flag ("flag"=>来自FlagConstant)
     */
    abstract protected function validSaveData(&$data, $operate);

    /**
     * 构建保存数据
     * @param array $data 保存数据
     * @param int $operate 操作类型
     */
    abstract protected function buildSaveData(&$data, $operate);

    /**
     * 保存后的操作
     * @param $data
     * @param $operate
     * @param $old
     */
    abstract protected function afterSaveData($data, $operate, $old);

    /**
     * 进入编辑页面
     */
    public function updateAction() {
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
        else {
            $this->addAction();
        }
        $this->buildDisplayInfo($data, Parent::DB_OPERATE_UPDATE);
        $operate = Parent::DB_OPERATE_UPDATE; // 修改操作类型

        $this->assign("obj", $data);
        $this->assign("menuId", $this->request("menuId"));
        $this->display("edit", array($this->_operateKey => $operate));
    }

    /**
     * 进入添加页面
     */
    public function addAction() {
        $data = $this->buildBand()->create(array(), false);
        $this->buildDisplayInfo($data, Parent::DB_OPERATE_INSERT);
        $operate = Parent::DB_OPERATE_INSERT; // 插入操作类型
        $this->assign("obj", $data);
        $this->assign("menuId", $this->request("menuId"));
        $this->display("edit", array($this->_operateKey => $operate));
    }

    /**
     * 进入复制页面
     */
    public function copyAction() {
        $sysId = $this->request($this->primaryKey);
        $data = array();
        if (!empty($sysId)) {
            $data = $this->buildBand()->findById($sysId);
        }
        else {
            $this->addAction();
        }

        $this->buildDisplayInfo($data, Parent::DB_OPERATE_COPY);
        $data[$this->primaryKey] = "";
        $operate = Parent::DB_OPERATE_COPY; // 插入操作类型
        $this->assign("obj", $data);
        $this->assign("menuId", $this->request("menuId"));
        $this->display("edit", array($this->_operateKey => $operate));
    }

    /**
     * 保存数据
     */
    public function saveAction() {
        $old = array();
        $data = $this->request();
        // 确认保存操作
        if (empty($data[$this->_operateKey])) {
            if (empty($data[$this->primaryKey])) {
                $operate = Parent::DB_OPERATE_INSERT;
            }
            else {
                $operate = Parent::DB_OPERATE_UPDATE;
            }
        }
        else {
            $operate = $data[$this->_operateKey];
        }
        unset($data[$this->_operateKey]);

        $result["flag"] = $this->validSaveData($data, $operate);
        if (0 !== $result["flag"]) {
            $this->returnJson($result); // 跳出
        }

        $this->buildSaveData($data, $operate);
        $userId = $this->getSessionOperatorId();
        $model = $this->buildBand();
        if (Parent::DB_OPERATE_INSERT == $operate || Parent::DB_OPERATE_COPY == $operate) { // 增加 复制
            $data["create_at"] = "now()";
            $data["create_by"] = $userId;

            if (CoreUtil::isEmpty($data[$this->primaryKey]) || Parent::DB_OPERATE_COPY == $operate) {
                unset($data[$this->primaryKey]);
            }
            $saveData = $model->create($data);
            $id = $model->insert($saveData);
            if (empty($id)) {
                $result["flag"] = 1;
                $result["message"] = "增加失败";
            }
            else {
                if (empty($data[$this->primaryKey])) {
                    $data[$this->primaryKey] = $id;
                }
                $result["result"] = $saveData;
            }
        }
        else if (Parent::DB_OPERATE_UPDATE == $operate) { // 修改
            $sysId = $data[$this->primaryKey];
            $old = $model->findById($sysId);
            $data["update_at"] = "now()";
            $data["update_by"] = $userId;
            $saveData = $model->create($data);
            $count = $model->updateById($sysId, $saveData); // $model->save($data);
            if (false === $count) {
                $result["flag"] = 2;
                $result["message"] = "修改失败";
            }
            else {
                $result["result"] = $saveData;
            }
        }
        if (0 === $result["flag"]) {
            $this->afterSaveData($data, $operate, $old);
        }
        $this->returnJson($result);
    }

    public function importAction() {
        //todo:
    }

    public function uploadAction() {
        echo "file=111.jpg";
        exit;
    }

    /**
     * 图片上传
     */
    public function imageAction() {
        $basePath = public_path();
        $savePath = "img/temp/";
        $result = UploadHelper::uploadImage($basePath, $savePath);
        if (0 === $result["flag"]) {
            // 生成图片url
            $data = $result["result"];
            $result = "file={$data['savename']},url={$data['savepath']}{$data['savename']},flag=0,
            width={$data['width']},height={$data['height']}";
        }
        else {
            $result = 'flag='.$result['status'].',message='.$result["message"];
        }
        echo $result;
        exit;
    }
}


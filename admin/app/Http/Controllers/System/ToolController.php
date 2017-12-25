<?php

/**
 * Created by leon
 * Date: 2017/2/17
 * Time: 13:28
 */

namespace App\Http\Controllers\System;

use Library\Constant\FlagConstant;
use Library\Inherit\Controller\Admin\AdminBaseController;

class ToolController extends AdminBaseController
{

    public function indexAction()
    {
        $this->display();
    }

    /**
     * 清空字段缓存
     */
    public function emptyFieldCacheAction()
    {
        $result["flag"] = 0;
        // 清除字段缓存
        $dir = config('cache.stores.file.path') . "/_fields/";
        if (is_dir($dir)) {
            $handle = opendir($dir);
            while (false !== ($file = readdir($handle))) {
                if ('.' !== $file && '..' !== $file) {
                    $temp = $dir . $file;
                    @unlink($temp);
                }
            }
        }
        else {
            $result["flag"] = FlagConstant::ERROR_PATH;
        }
        $this->returnJson(array("flag" => 0));
    }
}
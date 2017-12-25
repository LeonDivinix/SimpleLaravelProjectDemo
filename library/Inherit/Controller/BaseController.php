<?php

namespace Library\Inherit\Controller;

use Illuminate\Routing\Controller as LaravelController;
use Library\Constant\TitleMap;


class BaseController extends LaravelController
{
    function __construct()
    {
        //
    }

    function __destruct()
    {
        //
    }


    /**
     * 返回json
     * @param $data
     */
    protected function returnJson($data) {
        header('Content-Type:application/json; charset=utf-8');
        if (isset($data["flag"]) && isset(TitleMap::$FLAG_MAP[$data["flag"]])) {
            $data["message"] = TitleMap::$FLAG_MAP[$data["flag"]];
        }
        exit(json_encode($data));
    }
}

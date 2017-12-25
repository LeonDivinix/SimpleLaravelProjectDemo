<?php
/**
 * 后台操作人员session
 * Created by leon
 * Date: 2016-11-21 20:44
 */

namespace Library\Helper;


class OperatorSessionHelper
{
    const SESSION_KEY = "my_session";
    const OPERATOR_INFO_KEY = "";

    /**
     * @param \Illuminate\Http\Request $request
     * @param $value
     */
    public static function setSession($request, $value) {
        $key = env("APP_KEY") . self::SESSION_KEY;
        if ($value === null) {
            $request->getSession()->remove($key);
            $request->session()->regenerate(true);
        }
        else {
            $request->getSession()->set($key, $value);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public static function getSession($request) {
        $key = env("APP_KEY") . self::SESSION_KEY;
        $result = $request->session()->get($key);
//        $request->session()->regenerate(true);
//        $request->session()->regenerate();
        return $result;
    }
}
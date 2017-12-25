<?php
/**
 * Created by leon
 * Date: 2016-11-16 18:02
 */

namespace App\Http\Middleware\Admin;
use App\User;
use Illuminate\Support\Facades\Log;
use Closure;
use Library\Constant\FlagConstant;
use Library\Constant\TitleMap;
use Library\Helper\OperatorSessionHelper;
use Library\Service\RBAC\UserService;

class LoginMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $result = array("flag" => 0, "message" => "/");
        $userName = $request->input("userName");
        $pwd = $request->input("pwd");
        if (empty($userName)) {
            $result["flag"] = FlagConstant::NEED_NAME;
        }
        else if (empty($pwd)) {
            $result["flag"] = FlagConstant::NEED_PWD;
        }
        else {
            $userService = new UserService();
            $userInfo = $userService->getAdminUserByName($userName);
            if (empty($userInfo)) {
                $result["flag"] = FlagConstant::NOT_EXIST_USER;
            } else if (strcasecmp(md5($pwd . $userInfo["complex_value"]), $userInfo["password"]) !== 0) {
                $result["flag"] = FlagConstant::ERROR_PWD;
            } else if (empty($userInfo["status"])) {
                $result["flag"] = FlagConstant::FREEZE_USER;
            } else {
                $saveData["realName"] = $userInfo["real_name"];
                $saveData["role"] = $userInfo["role_id"];
                $saveData["userCode"] = $userInfo["code"];
                $saveData["id"] = $userInfo["id"];
                OperatorSessionHelper::setSession($request, $saveData);
            }
        }

        header('Content-Type:application/json; charset=utf-8');
        if (isset($result["flag"]) && isset(TitleMap::$FLAG_MAP[$result["flag"]])) {
            $result["message"] = TitleMap::$FLAG_MAP[$result["flag"]];
        }
        echo(json_encode($result));
        return $next($request);
    }
}
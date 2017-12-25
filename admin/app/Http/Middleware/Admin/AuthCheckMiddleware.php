<?php

/**
 * 检验登录及权限中间件
 * 返回json字符串
 * Created by leon
 * Date: 2016-11-16 17:45
 */

namespace App\Http\Middleware\Admin;
use Closure;
use Library\Constant\FlagConstant;
use Library\Helper\OperatorSessionHelper;
use Library\Service\RBAC\ViewUserMenuService;

class AuthCheckMiddleware
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $sessionInfo = OperatorSessionHelper::getSession($request);
        if (empty($sessionInfo)) {
            header("Content-Type:application/json; charset=utf-8");
            exit(json_encode(array("flag" => FlagConstant::ADMIN_REDIRECT_LOG_IN, "message" => "/Login")));
        }

        $requestUri = $request->getRequestUri();
        $permissionService = app(ViewUserMenuService::class);
        if (false === $permissionService->checkAuth($sessionInfo["id"], $requestUri)) {
            if (stripos($requestUri, "/list?") === false) {
                exit(json_encode(array("flag" => FlagConstant::ADMIN_REDIRECT_LOG_IN, "message" => "/Login")));
            }
            else { // grid查询列表需额外处理
                header("Content-Type:application/json; charset=utf-8");
                header("Content-Range: items 0/0");
                exit("[]");
            }
        }
        return $next($request);
    }
}
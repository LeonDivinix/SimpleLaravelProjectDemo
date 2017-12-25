<?php
/**
 * 检验登录及权限中间件
 * 跳转
 * Created by leon
 * Date: 2016-11-16 18:02
 */

namespace App\Http\Middleware\Admin;
use Closure;
use Library\Helper\OperatorSessionHelper;
use Library\Service\RBAC\ViewUserMenuService;

class AuthRedirectMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $sessionInfo = OperatorSessionHelper::getSession($request); // 登录信息
        $requestUri = $request->getRequestUri(); // 访问路由

        // 登录判断
        if (empty($sessionInfo)) {
            if (stripos($requestUri, "/Login") === false && stripos($requestUri, "/Logout") === false) {
                return redirect("/Login");
            }
        }

        // 权限判断
        if (strcmp("/", $requestUri) !== 0 && stripos($requestUri, "/Login") === false
            && stripos($requestUri, "/Logout") === false) { // 不是首页或登录页面或退出登录，判断权限
            $permissionService = app(ViewUserMenuService::class);
            $permission = $permissionService->checkAuth($sessionInfo["id"], $requestUri);
            if (false === $permission) {
                return redirect("/Login");
            }
            else {
                $sessionInfo["permission"] = $permission;
                OperatorSessionHelper::setSession($request, $sessionInfo);
            }
        }
        return $next($request);
    }
}
<?php
/**
 * Created by leon
 * Date: 2016-12-05 14:31
 */

namespace App\Http\Middleware\Admin;

use Closure;
use Library\Constant\FlagConstant;
use Library\Helper\OperatorSessionHelper;

class LoginCheckMiddleware
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
        return $next($request);
    }
}
<?php
/**
 * Created by leon
 * Date: 2016-11-16 18:02
 */

namespace App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Log;
use Closure;
use Library\Helper\OperatorSessionHelper;

class LogoutMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        OperatorSessionHelper::setSession($request, null);
        return redirect("/Login");
    }
}
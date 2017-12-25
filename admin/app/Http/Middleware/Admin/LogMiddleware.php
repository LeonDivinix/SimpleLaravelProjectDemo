<?php
/**
 * Created by leon
 * Date: 2016-11-16 18:02
 */

namespace App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Log;
use Closure;

class LogMiddleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
//        Log::error($request->getRequestUri());
//        Log::info($request->getRequestUri());
//todo:        Log::debug($request->getRequestUri());
        return $next($request);
    }
}
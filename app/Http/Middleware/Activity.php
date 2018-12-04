<?php

namespace App\Http\Middleware;

use Closure;

class Activity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //前置操作
        echo '前置操作';
        $a = $next($request);
        echo $a;
        //后置操作
        echo '后置操作';

        return $a;
    }
}

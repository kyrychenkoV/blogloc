<?php

namespace App\Http\Middleware;

use Closure;

class MyMiddleware
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
//        if($request->route('id') !='pages'){
//            return redirect()->route('controls');
//        }

        echo "1";  // до формирования
        return $next($request);
//
//         // После формирования запроса
//        $after= $next($request);
//        echo "1";
//        return  $after;

    }
}

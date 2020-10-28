<?php

namespace App\Http\Middleware;

use App\Enum\UserRole;
use Closure;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
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
        Log::info(json_decode(request()->header('Authorization')));
        if( isset($request->user()->role) && $request->user()->role == UserRole::ADMIN){
            return $next($request);
        }else {
            return response()->json([
                'code'=>403,
                'data'=>"Permission denied"
            ],200);
        }

    }
}

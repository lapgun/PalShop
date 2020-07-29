<?php

namespace App\Http\Middleware;

use App\Http\Constants\common;
use Closure;
use Illuminate\Support\Facades\Gate;

class AllowSuperUser
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
        try {
            if (Gate::denies(Common::ROLES['SUPER'])) {
                return abort(500);
            }

            return $next($request);
        }
        catch (\Exception $exception)
        {
            report($exception);
            return abort(500);
        }
    }
}

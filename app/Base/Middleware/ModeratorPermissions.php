<?php

namespace App\Base\Middleware;

use Closure;
use App\Base\Traits\Response\SendResponse;

class ModeratorPermissions
{
    use SendResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permittedRoutes = [];
        $route = $request->route()->getName();
        if (auth()->guard('marketer-api')->user()->currentAccessToken()->name == 'ModeratorApi') {

            if (in_array($route, $permittedRoutes)) {
                if (!auth()->guard('marketer-api')->user()->tokenCan($permittedRoutes[$route])) {
                    return $this->ErrorMessage(
                        'لا تمتلك الصلاحية'
                    );
                }
            }
        }


        return $next($request);
    }
}

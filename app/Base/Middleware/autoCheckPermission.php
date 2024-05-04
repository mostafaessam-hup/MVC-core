<?php

namespace App\Base\Middleware;

use Closure;
use Spatie\Permission\Models\Permission;
use App\Base\Traits\Response\SendResponse;
use App\Base\Services\SingletonAuthPermissions;

class autoCheckPermission
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

        $singleton_obj = SingletonAuthPermissions::getInstance();


        if (stripos($singleton_obj->getAllPermissions(), $request->route()->getName()) !== false) {
            if (stripos($singleton_obj->getAuthPermissions(), $request->route()->getName()) == false) {
                return $this->ErrorMessage(
                    'not allowed'
                );
            }
        }




        // $route = $request->route()->getName();
        // $permission = \Spatie\Permission\Models\Permission::whereRaw("FIND_IN_SET('$route',routes)")->where('guard_name', 'admin-api')->first();

        // if ($permission) {

        //     if (!auth()->guard('admin-api')->user()->hasPermissionTo($permission)) {
        //         return $this->ErrorMessage(
        //             'not allowed'
        //         );
        //     }
        // }

        /*
            if ($permission->limit > 0) {
                if ($permission->limit == $permission->current_use) {
                    return $this->sendResponse(
                        ['permission' => 'limit out of range'],
                        'you can not use this service any more',
                        false,
                        503
                    );
                }

            }
            */
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Closure;

class Authenticate extends Middleware
{
    protected $guards;

    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;

        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if (Arr::first($this->guards) === 'admin')
                return route('admin.login.form');

            abort(response()->json([
                'is_success' => false,
                'status_code' => 401,
                'message' => "Unauthenticated, please login first",
            ], 401));
        }
        return $request->expectsJson() ? null : route('login');
    }
}

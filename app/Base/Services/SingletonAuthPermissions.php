<?php

namespace App\Base\Services;

use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

class SingletonAuthPermissions
{
    private static $instance;

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function getAllPermissions()
    {
        return Cache::remember('allPermissions', 3600, function () {
            return json_encode(Permission::pluck('routes')->toArray());
        });
    }


    public function getAuthPermissions()
    {
        return Cache::remember(auth()->guard('admin-api')->user()->id . ':Authroles', 3600, function () {
            return json_encode(auth()->guard('admin-api')->user()->getAllPermissions()->pluck('routes')->toArray());
        });
    }

    public function getAllWebPermissions()
    {
        // return Cache::remember('allPermissions', 3600, function () {
            return json_encode(Permission::pluck('routes')->toArray());
        // });
    }

    public function getWebAuthPermissions()
    {
        // return Cache::remember(auth()->guard('admin')->user()->id . ':Authroles', 3600, function () {
            return json_encode(auth()->guard('admin')->user()->getAllPermissions()->pluck('routes')->toArray());
        // });
    }
}

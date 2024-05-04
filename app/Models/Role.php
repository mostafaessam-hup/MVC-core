<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Spatie\Activitylog\LogOptions;
use App\Base\Traits\Model\Timestamp;
use Illuminate\Support\Facades\Cache;
use Watson\Rememberable\Rememberable;
use App\Base\Traits\Model\FilterSort;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as SpatiRole;

class Role extends SpatiRole
{
    use Timestamp, FilterSort, LogsActivity, Rememberable;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (request()->has('permissions')) {
            }
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    public function getTable()
    {
        return $this->table ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    public static function getTableName()
    {
        return with(new static())->getTable();
    }

    public static function MyColums()
    {
        return Cache::rememberForever('colmns_' . self::getTableName(), function () {
            return Schema::getColumnListing(self::getTableName());
        });
    }

    public static function filterColumns(): array
    {
        return array_merge(self::MyColums(), [
            static::createdAtBetween(self::getTableName() . '.created_from'),
            static::createdAtBetween(self::getTableName() . '.created_to')
        ]);
    }

    public static function sortColumns(): array
    {
        return self::MyColums();
    }

    public function deleteRelations(): array
    {
        return [];
    }
    public function customPermissions()
    {
        $authIds = auth()->guard('admin-api')->user()->getAllPermissions()->pluck('id')->toArray();

        $Role = $this->permissions()->pluck('id')->toArray();

        $collection = new Collection();
        $permissions = Permission::get();
        foreach ($permissions as $permission) {
            $temp['id'] = $permission->id;
            $temp['name'] = $permission->name;
            $temp['group'] = $permission->group;
            $temp['status'] = false;
            if (in_array($permission->id, $Role)) {
                $temp['status'] = true;
            }

            if (auth()->guard('admin-api')->user()->roles?->first()?->name == 'super_admin') {
                $collection->push((object)$temp);
            } else {
                if (in_array($permission->id, $authIds)) {
                    $collection->push((object)$temp);
                }
            }
        }
        return $collection->groupBy('group');
    }
}

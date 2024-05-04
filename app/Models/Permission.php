<?php

namespace App\Models;

use App\Base\Models\Base;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Permission extends Base
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->guard_name =  'admin';
        });
    }

    protected function routes(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => 'admin.' . $value,
        );
    }
}

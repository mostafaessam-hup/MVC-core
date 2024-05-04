<?php

namespace App\Models;

use App\Base\Traits\Custom\NotificationAttribute;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Spatie\Activitylog\LogOptions;
use App\Base\Traits\Model\Timestamp;
use App\Base\Traits\Model\FilterSort;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Timestamp, FilterSort, LogsActivity, HasApiTokens, NotificationAttribute;
    protected $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'code', 'name', 'email', 'password', 'phone', 'status'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => bcrypt($value),
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'code')) {
                $model->code = self::generate_unique_code(model: $model, length: 12, letters: true, symbols: false);
            }
        });
    }

    public static function generate_unique_code($model, $col = 'code', $length = 4, $letters = true, $numbers = true, $symbols = true): string
    {
        $random_code = (new Collection)
            ->when($letters, fn ($c) => $c->merge([
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
                'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
                'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G',
                'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R',
                'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            ]))
            ->when($numbers, fn ($c) => $c->merge([
                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
            ]))
            ->when($symbols, fn ($c) => $c->merge([
                '~', '!', '#', '$', '%', '^', '&', '*', '(', ')', '-',
                '_', '.', ',', '<', '>', '?', '/', '\\', '{', '}', '[',
                ']', '|', ':', ';',
            ]))
            ->pipe(fn ($c) => Collection::times($length, fn () => $c[random_int(0, $c->count() - 1)]))
            ->implode('');

        if ($model::where($col, $random_code)->exists()) {
            self::generate_unique_code($model, $col, $length, $letters, $numbers, $symbols);
        }
        return $random_code;
    }

    public function getTable()
    {
        return $this->table ?? Str::snake(Str::pluralStudly(class_basename($this)));
    }

    public static function getTableName()
    {
        return with(new static())->getTable();
    }

    public static function MyColumns()
    {
        return Schema::getColumnListing(self::getTableName());
    }

    public static function filterColumns(): array
    {
        return array_merge(self::MyColumns(), [
            static::createdAtBetween(self::getTableName() . '.created_from'),
            static::createdAtBetween(self::getTableName() . '.created_to')
        ]);
    }

    public static function sortColumns(): array
    {
        return self::MyColumns();
    }

    public function deleteRelations(): array
    {
        return [];
    }

    public function getImageUrlAttribute(): string
    {
        if (app()->environment('local')) {
            if (is_null($this->attributes['image']))
                return asset("public/upload/blank.png");

            return asset($this->attributes['image']);
        }

        if (is_null($this->attributes['image']))
            return secure_asset("public/upload/blank.png");

        return secure_asset($this->attributes['image']);
    }
}

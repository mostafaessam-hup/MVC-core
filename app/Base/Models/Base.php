<?php

namespace App\Base\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use App\Base\Traits\Model\Timestamp;
use App\Base\Traits\Model\FilterSort;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Base\Traits\Custom\AttachmentAttribute;
use App\Base\Traits\Custom\NotificationAttribute;
use App\Base\Traits\Response\SendResponse;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Base extends Model
{
    use HasFactory, Timestamp, FilterSort, LogsActivity, AttachmentAttribute, SendResponse, NotificationAttribute;

    protected $guarded = ['id', 'uuid', 'created_at', 'updated_at'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    protected static function newFactory()
    {
        $namespace = explode('\\', static::class);
        $module_namespace = "{$namespace[0]}\\{$namespace[1]}";
        $factory = "{$module_namespace}\\Database\\Factories\\{$namespace[sizeof($namespace) - 1]}Factory";

        return $factory::new();
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

    public function getMedia()
    {
        return DB::table('attachments')
            ->where('attachmentable_type', 'REGEXP', '\\\\' . class_basename($this) . '$')
            ->where('attachmentable_id', $this->id)
            ->get();
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

    protected function img(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? secure_asset("storage/blank.png") : secure_asset($value),
        );
    }

    public static function getTableName()
    {
        return with(new static())->getTable();
    }

    public static function MyColumns()
    {
        return Cache::rememberForever('columns_' . self::getTableName(), function () {
            return Schema::getColumnListing(self::getTableName());
        });
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

    public function getLocaleAttribute($columnName)
    {
        $locale = app()->getLocale();
        $localizedColumn = "{$columnName}_{$locale}";

        if (isset($this->$localizedColumn)) {
            return $this->$localizedColumn;
        }

        return $this->$columnName;
    }
}

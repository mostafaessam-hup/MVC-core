<?php

namespace App\Base\Models;

use App\Base\Models\Base;

class Notification extends Base
{
    protected $fillable = [
        'channel_name',
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'read_at',
        'notifiable_id',
        'notifiable_type',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
}

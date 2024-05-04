<?php

namespace App\Models;

use App\Base\Models\Base;

class UserNotification extends Base
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

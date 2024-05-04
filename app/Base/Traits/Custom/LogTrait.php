<?php

namespace App\Base\Traits\Custom;

use Core\Log\Models\Log;

trait LogTrait
{
    public function logs()
    {
        return $this->morphMany(Log::class, 'logable');
    }

    public function createLog($title, $description = null, $type = 'admin', $old_value = null, $new_value = null)
    {
        $this->logs()->create([
            'userable' => auth()->user(),
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'old_value' => $old_value,
            'new_value' => $new_value,
        ]);
    }
}

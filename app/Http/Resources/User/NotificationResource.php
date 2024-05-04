<?php

namespace App\Http\Resources\User;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class NotificationResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getLocaleAttribute('title'),
            'content' => $this->getLocaleAttribute('content'),
            'created_at'    => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}

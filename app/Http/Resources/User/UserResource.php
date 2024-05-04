<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class UserResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'device_token' => $this->device_token,
            'os_type' => $this->os_type,
            'image' => $this->image_url
        ];
    }
}

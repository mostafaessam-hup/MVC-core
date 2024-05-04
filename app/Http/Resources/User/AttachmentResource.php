<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class AttachmentResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'usage' => $this->usage,
            'display_name' => $this->display_name,
            'extension' => $this->extension,
            'original' => is_null($this->original) ? null : secure_asset($this->original),
            'photo_400' => is_null($this->photo_400) ? null : secure_asset($this->photo_400),
            'photo_600' => is_null($this->photo_600) ? null : secure_asset($this->photo_600),
            'photo_800' => is_null($this->photo_800) ? null : secure_asset($this->photo_800),
        ];
    }
}

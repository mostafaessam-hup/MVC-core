<?php

namespace App\Http\Requests\User\Api;

use App\Base\Request\Api\UserBaseRequest;

class UpdateProfileRequest extends UserBaseRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|unique:users,email,' . auth()->guard('user-api')->id() . '|email|string|max:100',
            'phone' => 'nullable|unique:users,phone,' . auth()->guard('user-api')->id() . '|numeric',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
        ];
    }
}

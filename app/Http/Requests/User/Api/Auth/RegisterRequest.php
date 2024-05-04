<?php

namespace App\Http\Requests\User\Api\Auth;

use App\Base\Request\Api\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|unique:users,email|email|string|max:100',
            'phone' => 'required|unique:users,phone|numeric',
            'password' => 'required|confirmed|string|min:8|max:100',
            'device_token' => 'nullable',
            'os_type' => 'nullable',
            'image' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . env('MAX_FILE_UPLOAD'),
        ];
    }
}

<?php

namespace App\Http\Requests\User\Api\Auth;

use App\Base\Request\Api\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|email|exists:users,email',
            'password' => ["required"],
            'device_token' => 'nullable',
            'os_type' => 'nullable',
        ];
    }
}

<?php

namespace App\Http\Requests\User\Api;

use App\Base\Request\Api\UserBaseRequest;

class ChangePasswordRequest extends UserBaseRequest
{
    public function rules()
    {
        return [
            'old_password' => 'required|string|min:8|max:100',
            'password' => 'required|confirmed|string|min:8|max:100',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class UserRequest extends AdminBaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => 'required|string|max:100',
                        'email' => 'required|unique:users,email|email|string|max:100',
                        'phone' => 'required|unique:users,phone|numeric',
                        'password' => 'required|confirmed|string|min:8|max:100',
                        'image' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'nullable|string|max:100',
                        'email' => 'nullable|unique:users,email,'.$this->user.'|email|string|max:100',
                        'phone' => 'nullable|unique:users,phone,'.$this->user.'|numeric',
                        'password' => 'nullable|confirmed|string|min:8|max:100',
                        'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),

                    ];
                }
        }
    }
}

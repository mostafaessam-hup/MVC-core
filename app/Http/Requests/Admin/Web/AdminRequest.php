<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class AdminRequest extends AdminBaseRequest
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
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|unique:admins',
                        'phone' => 'required|string|min:10|max:15',
                        'password' => 'required|string|min:8',
                        'status' => 'required|numeric|in:0,1',
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'nullable|string|max:255',
                        'email' => 'nullable|email|unique:admins,email,' . $this->admin,
                        'phone' => 'nullable|string|min:10|max:15',
                        'status' => 'nullable|numeric|in:0,1',
                    ];
                }
        }
    }
}

<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class RoleRequest extends AdminBaseRequest
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
                        'name' => 'required|unique:roles,name',
                        'description' => 'nullable',
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'required|unique:roles,name,' . $this->role,
                        'description' => 'nullable',
                    ];
                }
        }
    }

    protected function passedValidation()
    {
        $this->merge(['guard_name' => 'admin']);
    }
}

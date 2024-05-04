<?php

namespace App\Http\Requests\User\Api;

use App\Base\Request\Api\UserBaseRequest;

class NotificationRequest extends UserBaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [];
                }
            case 'PUT': {
                    return [];
                }
        }
    }
}

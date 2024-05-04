<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AuthRequest extends FormRequest
{
    public function authorize()
    {
        if (app()->runningInConsole()) {
            return true;
        }
        return true;
    }

    public function rules()
    {
        if (app('request')?->route()?->getName() == 'admin.change-password')
            return [
                'password' => ["required", new PasswordRule],
            ];

        return [];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator);
    }
}

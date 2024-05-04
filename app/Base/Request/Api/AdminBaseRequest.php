<?php

namespace App\Base\Request\Api;

use Illuminate\Support\Facades\Auth;
use App\Base\Traits\Response\SendResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminBaseRequest extends FormRequest
{
    use SendResponse;

    public function authorize()
    {
        if (app()->runningInConsole()) {
            return true;
        }
        return Auth::guard('admin-api')->check();
    }

    public function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->toArray() as $key => $error) {
            $errors[$key] = $error[0];
        }

        throw new HttpResponseException($this->ErrorValidate(
            $errors
        ));
    }
}

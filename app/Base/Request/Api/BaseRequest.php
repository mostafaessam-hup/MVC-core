<?php

namespace App\Base\Request\Api;

use App\Base\Traits\Response\SendResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    use SendResponse;

    public function authorize()
    {
        return true;
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

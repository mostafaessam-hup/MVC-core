<?php

namespace App\Base\Request\Web;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class AdminBaseRequest extends FormRequest
{
    public function authorize()
    {
        if (app()->runningInConsole()) {
            return true;
        }
        return true;
        // return Auth::guard('admin')->check();
    }

    public function failedValidation(Validator $validator)
    {
        return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
    }
}

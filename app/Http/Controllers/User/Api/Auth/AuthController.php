<?php

namespace App\Http\Controllers\User\Api\Auth;

use App\Base\Traits\Response\SendResponse;
use App\Http\Requests\User\Api\Auth\LoginRequest;
use App\Http\Requests\User\Api\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    use SendResponse;

    public function login(LoginRequest $request)
    {
        $user = User::whereEmail($request->input('email'))->first();

        if (!$user)
            return $this->ErrorMessage(__('user.email_not_found_!'));

        if (Hash::check($request->input('password'), $user->password)) {
            if ($request->device_token) {
                $user->update([
                    'device_token' => $request->device_token,
                    'os_type' => $request->os_type
                ]);
            }

            $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
            return $this->shortSuccess(
                data: [
                    'token' => $token,
                    'user' => new UserResource($user)
                ],
                msg: __('user.login_successfully')
            );
        }

        return $this->ErrorMessage(__('user.incorrect_password_!'));
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create(Arr::except($request->validated(), 'image'));

        if (!$user)
            return $this->ErrorMessage();

        if (request()->has('image') && !is_null(request()->image)) {
            $path = request()->file('image')->store('public');
            $user->image = str_replace('public/', 'storage/', $path);
            $user->save();
        }

        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

        return $this->shortSuccess(
            data: [
                'token' => $token,
                'user' => new UserResource($user)
            ],
            msg: __('user.account_created')
        );
    }

    public function logout()
    {
        Auth::guard('user-api')->user()->tokens()->delete();

        return $this->shortSuccess(msg: __('user.logout_successfully'));
    }
}

<?php

namespace App\Http\Controllers\User\Api;

use App\Base\Traits\Response\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Api\ChangePasswordRequest;
use App\Http\Requests\User\Api\UpdateProfileRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use SendResponse;

    public function getProfile()
    {
        return $this->shortSuccess(data: UserResource::make(auth()->guard('user-api')->user()));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->guard('user-api')->user();

        $user->update(Arr::except($request->validated(), 'image'));

        if (request()->has('image') && !is_null(request()->image)) {
            @unlink(storage_path(str_replace('storage/', 'app/public/', $user->image)));
            $path = request()->file('image')->store('public');
            $user->image = str_replace('public/', 'storage/', $path);
            $user->save();
        }

        return $this->shortSuccess(
            msg: __('user.profile_updated_successfully'),
            data: UserResource::make($user)

        );
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->guard('user-api')->user();

        if (!Hash::check($request->post('old_password'), $user->password))
            return $this->ErrorMessage(__('user.incorrect_password_!'));

        $user->update(['password' => $request->password]);
        return $this->shortSuccess(msg: __('user.password_changed_successfully'));
    }
}

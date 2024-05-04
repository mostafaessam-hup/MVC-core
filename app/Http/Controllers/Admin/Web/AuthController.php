<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Rules\PasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Web\AuthRequest;
use App\Http\Requests\Admin\Web\ProfileRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public const VIEWPATH = 'admin.auth.';

    public function loginView()
    {
        return view(static::VIEWPATH  . __FUNCTION__);
    }

    public function loginPost(AuthRequest $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => ["required", new PasswordRule]
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $remember = $request->input('remember') && $request->remember == 1 ? $request->remember : 0;
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect(route('admin.home'));
        }

        return back()->withInput()->withErrors(['email' => 'خطأ في البريد الإلكتروني أو كلمة المرور']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
    
        // Clear the remember me token cookie
        $request->session()->forget(Auth::guard('admin')->getRecallerName());
    
        $request->session()->invalidate();
        $request->session()->regenerate();
        
        return redirect(route('admin.login.form'));
    }
    

    public function updateProfileView()
    {
        $update_route = 'admin.profile.post';
        $record = auth()->user();
        return view('admin.profile.edit', compact('update_route', 'record'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $user = Auth::user();
        $user->update(Arr::except($request->validated(), ['old_password', 'new_password']));

        if ($request->input('old_password')) {
            if (Hash::check($request->input('old_password'), $user->password)) {
                $user->password = $request->input('new_password');
                $user->save();
            } else {
                return redirect()->back()->with('fail', 'Record dsadsadsadas successfully!');
            }
        }

        return redirect()->back()->with('success', 'Record updated successfully!');
    }
}

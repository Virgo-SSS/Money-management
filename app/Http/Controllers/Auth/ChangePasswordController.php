<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


class ChangePasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Change Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling change password requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function reset(ChangePasswordRequest $request)
    {
        $password = bcrypt($request->password);
        Auth::user()->update(['password' => $password]);

        return redirect()->route('settings')->with('success', 'Password changed successfully!');
    }



}

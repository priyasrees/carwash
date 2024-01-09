<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('logout');
        $this->middleware('guest')->only('user_reg');
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/signin');
    }
    public function changePassword()
    {
        return view('auth.change_password');
    }
    public function reset_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'new_password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'confirm_password' => 'required'
        ]);

        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');
        $validate_pass = User::where('id', Auth::user()->id)->first();
        if ($validate_pass == Hash::check($old_password, $validate_pass->password)) {
            if ($new_password === $confirm_password) {
                User::where('id', Auth::user()->id)
                    ->update(['password' => Hash::make($new_password)]);
                return redirect()->route('auth.change_password')->withMessage('Password Updated');
            } else {
                return redirect()->back()->withInput()
                    ->withErrors(['Mismatch' => 'Password Mismatch']);
            }
        } else {
            return redirect()->back()->withInput()
                ->withErrors(['wrong_password' => 'Password Wrong']);
        }
    }

}

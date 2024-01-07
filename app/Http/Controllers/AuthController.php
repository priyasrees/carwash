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
public function user_reg(Request $request){
print_r($request->all());
exit();
    $validator= Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'phone' =>['numeric','min:10']
    ]);
    if ($validator->fails()) {
        // If validation fails, redirect back with errors
        return redirect()->back()->withErrors($validator)->withInput($request->all());

    }
        // return User::create([
        //     'name' => $request->input('name'),
        //     'email' =>  $request->input('email'),
        //     'password' => Hash::make($request->input('password')),
        //     'phone'=> $request->input('phone'),
        //     'address'=>'','city'=>'','state'=>'','pincode'=>'','dob'=>'','drivinglicenseno'=>''

        // ]);

}
    public function logout()
    {
        Session::flush();
        Auth::logout();
      return redirect('/signin');
    }
}

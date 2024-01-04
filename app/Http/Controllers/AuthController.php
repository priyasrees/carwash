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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // else {
        //     return response([
        //         'message' => 'Validation passed',
        //         'email' => $request->email,
        //         'name' => $request->name,
        //     ]);
        // }
        $email = User::where('email', $request->input('email'))->first();
        if (!empty($email)) {
            return response(
                [
                    'message' => false,
                    'email' => 'This Email Already Exists'
                ]
            );
        }
        return User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'phone' => isset($request->phone) ? $request->phone : ''
            ]
        );
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => false,
                'email' => $validator->errors()->first('email'),
            ]);
        } else {
            return response([
                'message' => true,
                'email' => 'Email is valid',
            ]);
        }
if(empty($request->password)){
    return response(
        [
            'message' => false,
            'email' => 'Password Required'
        ]
    );
}
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(
                [
                    'message' => 'Invalid Credentials'
                ],
                status: Response::HTTP_UNAUTHORIZED
            );
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt_token', $token, 60 * 1); // 1 day

        return response([
            'message' => 'Success',
            'token' => $token
        ])->withCookie($cookie);
    }
    public function user()
    {

        return Auth::user();
    }
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }
    public function sign_up(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['numeric', 'min:10', 'unique:users']
        ]);
        try {

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            if ($user) {
                return redirect()->back()->withMessage('Registered Successfully');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function logout()
    {

        // Session::flush();

        // Auth::logout();

        // return redirect('signin');
        $cookie = Cookie::forget('jwt_token');
        return response([
            'message' => 'Success'
        ])->withCookie($cookie);
    }
}

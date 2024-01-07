<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/signin';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function signin(){
        return view('signin');
    }
    // public function authenticate(Request $request)
    // {

    //     $validator = Validator::make($request->all(),[
    //             'email' => 'required|email|max:250|unique:users',
    //             'password' => 'required|min:8|confirmed',
    //         ],
    //         [
    //             'email.required' => 'Please enter email.',
    //             'email.email' => 'Please enter a valid email.',
    //             'password.required' => 'Please enter password.'
    //         ]);

    //         if ($validator->fails()) {
    //             // If validation fails, redirect back with errors
    //             return redirect()->route('signin')->withErrors($validator)->withInput($request->all());

    //         }


    //       //  return redirect("signin")->withSuccess('Login details are not valid');
    //     }
//          catch (ValidationException $e) {
//             // If validation fails, you can catch the exception and get the errors
//             $errors = $e->validator->errors()->all();
//  // Manually print the errors
//         // foreach ($errors as $error) {
//         //     echo $error . "\n";
//         // }
//             // You can now do something with the errors, for example, log them or return a response
//             return redirect("signin")->withErrors($errors)->withInput($request->all());
//         }



    public function logout()
{
    Auth::logout();

    return redirect('/signin'); // Change this to your desired logout redirect path
}
}

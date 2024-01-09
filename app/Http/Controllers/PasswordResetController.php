<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function password_reset()
    {
        return view('auth.reset_password');
    }
    public function send_passwordreset_mail(Request $request)
    {
        $valid_mail = User::where('email',$request->email)->where('is_active',1)->first();
        if(empty($valid_mail)){
            return redirect()->back()->withInput()
            ->withErrors(['mail_invalid' => 'Invalid Email']);
        }else{
            $data = array('name'=>"Virat Gandhi");

            $emailContent = "<p>Hello, this is a sample email content.</p>";

            Mail::raw([], function ($message) use ($emailContent) {
                $message->to('admin@gmail.com');
                $message->subject('Subject of the email');
                $message->setBody($emailContent, 'text/html'); // Set content type to HTML
            });
        }
    }
}

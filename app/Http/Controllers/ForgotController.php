<?php

namespace App\Http\Controllers;

use App\Http\Middleware\users;
use App\Models\usermodel;
use Illuminate\Http\Request;
use Mail;
use Hash;
use Session;

class ForgotController extends Controller
{

    // forget password form
    function forgetForm()
    {
        return view('Password.forget-pass');
    }


    // send otp
    function sendOtp(Request $req)
    {
        $user = usermodel::where('email', $req->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found');
        }

        $otp = rand(100000, 999999);

        $user->otp = $otp;
        $user->save();

        Mail::html("

        <h3 style='color:#333'><b><center>Welcome To E-Comm Family</center></b></h3>

        <p style='color:#666;font-size:14px'>
        Use the verification code below to complete your request.
        </p>

        <div style='margin:30px 0'>
            <h2 style='font-size:30px' ><center><b>$otp</b></center></h2>
        </div>

        <p style='color:#888;font-size:13px'>
        This OTP will expire in 5 minutes.
        </p>

        <p style='color:#aaa;font-size:12px'>
        If you didn't request this email, please ignore it.
        </p>

        </div>
        </div>
        ", function ($msg) use ($req) {

            $msg->to($req->email)
                ->subject('Your Verification Code');

        });

        Session::put('email', $req->email);
        return redirect('/Password/otp');
    }


    // otp form
    function otpForm()
    {
        return view('Password.otp');
    }


    // verify otp
    function verifyOtp(Request $req)
    {
        $user = usermodel::where('email', Session::get('email'))
            ->where('otp', $req->otp)
            ->first();

        if ($user) {
            return redirect('/Password/new-pass');
        } else {
            return back()->with('error', 'Invalid OTP');
        }
    }


    // new password form
    function newPasswordForm()
    {
        return view('Password.new-pass');
    }

    // update password
    function updatePassword(Request $req)
    {
        $req->validate([
            'password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        $user = usermodel::where('email', Session::get('email'))->first();

        $user->password = Hash::make($req->password);
        $user->otp = null;
        $user->save();

        return redirect('/login')->with('success', 'Password changed');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usermodel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function register()
    {
        return view('register', ['bodyClass' => 'auth-bg']);
    }
    public function register_store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'number'=>'required|min:10',
                'password'=>'required|min:6',
                
            ]);
        usermodel::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'number'  => $request->number,
            'password' => Hash::make($request->password),
            'Gender'   => ''
        ]);
        return redirect('/login')->with('success', 'Registration successful.');
    }

    public function login()
    {
        return view('login', ['bodyClass' => 'auth-bg']);
    }
    public function login_store(Request $request)
    {
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['email'=>'Invalid login details']);
    }

    public function profile()
    {
        return view('profile');
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female,Other',
        ]);

        $user = Auth::user();
        
        $userModel = usermodel::find($user->id);
        if ($userModel) {
            $userModel->name = $request->name;
            $userModel->Gender = $request->gender;
            $userModel->save();
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function security()
    {
        return view('security');
    }

    public function security_update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $userModel = usermodel::find($user->id);
        if ($userModel) {
            $userModel->password = Hash::make($request->new_password);
            $userModel->save();
        }

        return back()->with('success', 'Password updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/dashboard');
    }

    function about()
    {
        return view('about');
    }
}

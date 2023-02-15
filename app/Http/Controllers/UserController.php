<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register() {
        return view('user.register');
    }

    public function store(Request $request) {
        $fields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $fields['password'] = bcrypt($fields['password']);

        $user = User::create($fields);
        auth()->login($user);
        return redirect('/')->with('message','User created and logged in successfully');
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out');
    }

    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $fields = $request->validate([ 
            'email' => 'required|email|',
            'password' => 'required'
        ]);

        if(auth()->attempt($fields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You have been successfully logged in');
        }

        return back()->withErrors(['email'=> 'Invalid Credentials'])->onlyInput('email');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show register form
    public function create()
    {
        return view('user.register');
    }

    // show login form
    public function login()
    {
        return view('user.login');
    }

    // store user
    public function store( Request $request )
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // hash password
        $formFields['password'] = bcrypt($formFields['password']);

        // create user
        $user = User::create( $formFields );

        // login
        auth()->login( $user );

        return redirect('/')->with('message', 'User created and logged in');
    }

    // logout
    public function logout( Request $request )
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out successfully');
    }

    // authenticate
    public function authenticate( Request $request )
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt( $formFields )) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}

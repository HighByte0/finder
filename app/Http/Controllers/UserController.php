<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; // Correct namespace for Request
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // Show registration form
    public function create()
    {
        return view('users.register');
    }

    // Store new user
    public function store(Request $request)
    {
        // dd($request);
        $formfields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash password
        $formfields['password'] = bcrypt($formfields['password']);

        // Create user by factory
        $user = User::create($formfields);

        // Login
        auth()->login($user);

        return redirect('/')->with('message', 'Your registration was successful');
    }
    //logout
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','you have been logout');
    }
    //show login form 
    public function login(){
        return view('users.login');
    }
   // Authenticate user
    public function authenticate(Request $request){
        $formfields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

        if(auth()->attempt($formfields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are logged in to the home page');
        }
        
        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');
    }

}

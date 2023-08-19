<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // validate the login request
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // attempt to authenticate the user
        if (Auth::attempt($validatedData)) {
            // if authentication is successful, redirect to dashboard with success message
            return redirect('/')->with('success', 'You have been successfully logged in.');
        }

        // if authentication fails, redirect back to the login page with error message
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials. Please try again.']);
    }


    public function getLogout(){
        Auth::logout();
        $request->session()->flash('logout', 'You have been logged out successfully.');
        return redirect()->back();
    }
}

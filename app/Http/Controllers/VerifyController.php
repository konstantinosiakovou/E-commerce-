<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyController extends Controller
{
    /**
     * verify the user with a given token
     * 
     * 
     * @param string $token
     * 
     * @return Response
     */
    public function verify($token)
    {
        $user = User::where('token', $token)->firstOrFail();

           $user->update(['token' => $token]); //verify the user;            

           return redirect()->route('/')->with('msg','Success, you are now logged in');          

    }
}

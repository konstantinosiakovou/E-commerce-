<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Validator;
use DB;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required',
            'phone' => 'required|min:9',            
            'name' => 'required|min:12',
            'surname' => 'required',            
            'city' => 'required|max:13',
            'address' => 'required|max:15',
            'zip' => 'required|max:4',
            // 'vatnumber' => 'nullable|regex:/(01)[0-9]{9}/|min:9',
        ],
        [
            'email.required' => 'An email is required',
            'email.unique'=> 'This email is already taken',
            'password.required' => 'A password is required',
            'password.regex' => 'Password must include at least: one uppercase letter, one lowercase letter, one number, and one special character',
            'phone.required' => 'A phone number is required',
            'phone.regex' => 'Phone number must be 9 digits long and start with a number between 6 and 9',            
            'name.required' => 'A name is required',
            'surname.required' => 'A surname is required',
            'city.required' => 'A city is required',
            'address.required' => 'An address is required',
            'zip.required' => 'A zip is required',
            // 'vatnumber.regex' => 'Invalid VAT number',
            // 'vatnumber.max' => 'VAT number is too long',
        ]);
    
        $user = new User(['email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phone' => $validatedData['phone'],            
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            // 'vatnumber' => $validatedData['vatnumber'],
            'city' => $validatedData['city'],
            'address' => $validatedData['address'],
            'zip' => $validatedData['zip']
        ]);
        
        $user->save();
    
        Auth::login($user);
        $user->sendEmailVerificationNotification();     

        if(Session::has('oldUrl')){
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to(Session::get('oldUrl'));
        }
        return redirect()->route('home',$user)->with('usercreated', 'Your account have been created|Soon you will get an confirmation email');        
    }

    public function getSignin(){
        return view('user.signin');
    }
    public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:5'
        ],
        [
            'email.required' => 'An email is required',
            'password.required' => 'A password required',
            'password.min' => 'minimum characters 8',            
        ]   
    ); 
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
	$users = User::where('email', $request->input('input'))->get();
        if (count($users)  < 1) {
            
            return redirect()->route('user.signin')->with('usernotexist', 'warning: not exist');         
}    
     $remember_me = $request->has('remember_me') ? true : false; 
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){            
            if(Session::has('oldUrl')){
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to(Session::get('oldUrl'));
            }
            return redirect()->route('product.index');
        }
        return redirect()->back();
    }
    public function getProfile(){
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders'=> $orders]);
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->back();
    }

    public function edit(User $user)
    {   
        $user = Auth()->user();        
        return view('user.editprofile', compact('user'));
    }

    public function update()
    { 
        $this->validate(request(), [ 
            'email' => 'email|unique:users|confirmed',                       
            'phone' => 'numeric',
            'name' => 'required',
            // 'stathero' => 'numeric',
            
            'surname' => 'max:13',
            'city' => 'max:12',
            'address' => 'max:25',
            'zip' => 'numeric|min:5',
            // 'vatnumber' => 'nullable|regex:/[0-9]{10}/'
            
        ],
        [
            'email.required' => 'An email required',            
            'email.unique'=> 'This email is not unique',
            'email.confirmed' => 'The email confirmation does not match',
            'password.required' => 'A password required',
            'phone.required' => 'A phone required',
            'name.required' => 'A name required',
            'surname.required' => 'A surname required',            
            'city.required' => 'A city required',
            'address.required' => 'An address required',
            'zip.required' => 'A zip required',
            
        ]  
    );  
            $user = auth()->user();  
            $user->email = request('email');                   
            $user->phone = request('phone');
            // $user->stathero = request('stathero');
            $user->name = request('name');       
            $user->surname = request('surname');
            $user->city = request('city');
            $user->address = request('address');
            $user->zip = request('zip');
            // $user->vatnumber = request('vatnumber');

        $user->save();              
        return back()->with('usersaved', 'Account has been updated!');
    }    
    public function destroy()
{
        User::destroy( auth()->id() );
        return redirect()->route('user.signin')->with('userdeleted', 'Your account has been deleted!');
}
}


<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function __constract(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.signin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|unique:users|confirmed|exists:users',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|min:6',
            'phone' => 'required|regex:/[6-9]{10}/',
            'stathero' => 'numeric|regex:/[2-9]{10}/',
            'name' => 'required|max:12',
            'surname' => 'required|max:13',
            'city' => 'required|max:12',
            'address' => 'required|max:25',
            'zip' => 'required|numeric|min:5',
            'vatnumber' => 'nullable|regex:/(01)[0-9]{9}/'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $user = User::find(Auth::user()->id);
        $user = DB::delete('delete from users')->user(id);
        return Redirect::route('users.signin', $user)->with('userdelete', 'Your account has been deleted!');
    }
    public function payondelivery(){                
                Mail::send('shop.order_confirmation2', [
                    'user' => Auth()->user(),
                    'products' => $cart->items,
                    'totalPrice' => $cart->totalPrice,
                ], function($message) use ($user) {
                        $message->to($user->email);
                        $message->from("konstantinosiakovou@gmail.com");
                        $message->subject("Your order confirmation");
                        $message->bcc("konstantinosiakovou@gmail.com");
                    }
                );          
            return redirect()->route('product.index')->with('success', 'Successfully purchased products! | You will receive an oder confirmation at your email');
    }
}

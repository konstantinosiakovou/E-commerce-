<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Seeder;
use App\Notifications\VerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\HomeController;


Route::get('shop.index','ProductController@getIndex');
Route::get('shop.index/getindex/{id}','ProductController@getIndex');

Route::get('post/create', [PostController::class, 'create']);

Route::post('post', [PostController::class, 'store']);
Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'
]);
Route::get('/add-to-cart/{id}', [
    'uses' => 'ProductController@getAddToCart',
    'as' => 'product.addToCart'
]);
Route::get('/reduce/{id}', [
    'uses' =>'ProductController@getReduceByOne',
    'as' => 'product.reduceByOne',
]);
Route::get('/remove/{id}', [
    'uses' => 'ProductController@getRemoveItem',
    'as' => 'product.remove'
]);
Route::get('/shopping-cart', [
    'uses' => 'ProductController@getCart',
    'as' => 'product.shoppingCart'
]);
Route::get('/checkout', [
    'uses' => 'ProductController@getCheckout',
    'as' => 'checkout1',
    'middleware' => 'auth'
]); 
Route::post('/checkout', [
    'uses' => 'ProductController@postCheckout',
    'as' => 'checkout',
    'middleware' => 'auth'
]);
Route::get('/password/reset/{token}/{email}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset0');
Route::get('/contact','ContactMessageController@create')->name('contact');
Route::post('/contact','ContactMessageController@store')->name('contact.store');
Route::get('/welcome', [
        'uses' => 'UserController@create',    
        'as'=> 'emails.welcome'
]);
 
 Route::get('/home', [
'uses' => 'HomeController@index',
'as' => 'home'
]);

Route::group(['prefix' => 'user'], function () {  
    
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signup', [
            'uses' => 'UserController@getSignup',
            'as' => 'user.signup'
        ]);
        Route::post('/signup', [
            'uses' => 'UserController@postSignup',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'UserController@getSignin',
            'as' => 'user.signin'
        ]);

        Route::post('/signin', [
            'uses' => 'UserController@postSignin',
            'as' => 'user.signin'
        ]);  
                                
    });   

    Route::group(['middleware' => 'auth'], function () {        
        Auth::routes(); 
        Route::get('/send',[HomeController::class,"sendnotification"]);       
        Route::get('/email/verify', function () {
            return view('auth.verify-email');
        })->middleware('auth')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
            $request->fulfill();
         
            return redirect('/home');
        })->middleware(['auth', 'signed'])->name('verification.verify');
        //Route::patch('/user/{user}/update', [
          //  'as' => 'user.update', 
           // 'uses' => 'UserController@update'
       // ]); 
       Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


    Route::get('/user/profile', [
        'uses' => 'UserController@getProfile',
        'as' => 'user.profile'
    ])->middleware(['auth', 'verified']);
    Route::get('/user/{user}/',  [
        'as' => 'user.editprofile', 
        'uses' => 'UserController@edit'
    ]);
    Route::patch('/user/{user}/update', [
        'as' => 'user.update', 
        'uses' => 'UserController@getUpdate'
       ])->middleware('auth'); 
        Route::get('/change-password', [
            'uses' =>  'ChangePasswordController@index',
            'as' => 'user.changePassword'        
        ]);
        Route::post('/change-password', [
            'uses' => 'ChangePasswordController@store',
            'as' => 'change.password'        
        ]);
        Route::patch('users/update-profile', 'UserController@update')->name('users.update-profile');
        Route::delete('users/delete-profile', 'UserController@destroy')->name('users.delete-profile');
        Route::resource('users','UserController')->except([ 'update', 'destroy' ]);        
        Route::post('/order_confirmation', [
            'uses' => 'ProductController@postCheckout',
            'as' => 'shop.order_confirmation'
        ]); 
        Route::post('/order_confirmation2', [
            'uses' => 'PostController@payondelivery',
            'as' => 'shop.order_confirmation2'
        ]);   
                  
    });
    Route::get('/logout', 'Auth\LoginController@logout')->name('user.logout');
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

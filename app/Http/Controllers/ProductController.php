<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Order;
use App\Day;
use App\Time;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Auth;
use Stripe\Charge;
use Stripe\Stripe;
use Mail;
use Carbon\Carbon;
use DB;
use IlluminateSupportFacadesDB;

class ProductController extends Controller
{
    public function getIndex() 
    {
        $products = Product::all(); 
        //$days = DB::table('days')->pluck("name1","id");
        //$times = DB::table('times')->pluck("name2","times_id");
        return view('shop.index',compact('products'), ['products' => $products]);

    }    
    
            public function create()
            {
                return view('times.create')
                    ->with([
                    'times' => Time::query()
                                    ->orderBy('time')
                                    ->get(),
                ]);
            }

            public function store(Request $request)
            {
                $validTime = $request->validate([
                    //The other validation rules
                    'time_option' => 'required',
                ]);
            
                Time::create(array_merge($validTime,[
                    'time_id' => $this->getTimeId($request->time_option),
                ]));
            }
 
            protected function getTimesId($timeOption)
                {
                    return Time::query()
                        ->where('time', $timeOption)
                        ->value('id');
                }

            public function rules()
                {
                    return ([
                        //The other validation rules
                        'time_options' => 'required|exists:times,time',
                    ]);
                }

                
                



    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);


        $request->session()->put('cart', $cart);
        return redirect()->route('product.index');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        
        return view('shop.checkout', ['total' => $total]);
    }

   

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if (count($cart->items) > 0){
            Session::put('cart', $cart);
        } else{
            Session::forget('cart');
        } 
        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if (count($cart->items) > 0){
            Session::put('cart', $cart);
        } else{
            Session::forget('cart');
        }       
        return redirect()->route('product.shoppingCart');
    }
    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        
        \Stripe\Stripe::setApiKey('sk_test_ptSt4XL8KRmHvbdVAsvC7bAk00EOC00h7u');

            // Token is created using Stripe Checkout or Elements!
            // Get the payment token ID submitted by the form:
                if ( isset($_POST['stripeToken']) ){
                    $token  = $_POST['stripeToken'];
                }
            try {
                $charge = \Stripe\Charge::create([
                    'amount' => $cart->totalPrice * 100,                    
                    'currency' => 'usd',
                    'description' => Carbon::now().' '.$request->input('card-name'),
                    'source' => "tok_mastercard",
                ]); 
                

                $request->validate([
                    'cardname' => 'max:35',
                    'name' => 'max:12',
                    'surname' => 'max:13',
                ]);
    
                $order = new Order();
                $order->cart = serialize($cart);                
                $order->cardname = $request->input('cardname'); 
                $order->name = $request->input('name'); 
                $order->surname = $request->input('surname');                
                $order->payment_id = $charge->id;
               
                Auth::user()->orders()->save($order);

            } catch(\Stripe\Exception\CardException $e) {
                $request->session()->flash('fail-message1', 'Your payment was declined.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\RateLimitException $e) {
                $request->session()->flash('fail-message2', 'To many requests to the API.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $request->session()->flash('fail-message3', 'Invalid parameters.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\AuthenticationException $e) {
                $request->session()->flash('fail-message4', 'There are problems with authentication.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                $request->session()->flash('fail-message5', 'There is a problem with the network.');
                return redirect()->route('checkout');
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $request->session()->flash('fail-message6', 'There is a problem with the API.');
                return redirect()->route('checkout');
            } catch (Exception $e) {
                $request->session()->flash('fail-message7', 'We don\'t know what happened.');
                return redirect()->route('checkout');
            }       
            Mail::send('shop.order_confirmation', [
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
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products! | You will receive an oder confirmation at your email');
    }    
}
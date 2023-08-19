@extends('layouts.master')

@section('content')
    <div class="col-md-4 col-md-offset-4">
        
        <div class="cart">
                <div class="cart-header"><strong><h1>{{ Auth::user()->name }}</h1></strong></div><hr>
                <div class="container">
                    <h2>{{ Auth::user()->name }} Informations</h2>                               
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Email</th><br>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>City</th>
                          <th>Address</th>
                          <th>Zip</th>
                          <th>Vat number</th>
                          <th>Phone</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{ Auth::user()->email }}</td> 
                          <td>{{ Auth::user()->name }}</td>
                          <td>{{ Auth::user()->surname }}</td>
                          <td>{{ Auth::user()->city }}</td>
                          <td>{{ Auth::user()->address }}</td>
                          <td>{{ Auth::user()->zip }}</td>
                          <td>{{ Auth::user()->vatnumber }}</td> 
                          <td>{{ Auth::user()->phone }}</td>                         
                        </tr>                        
                      </tbody>
                    </table>
                    <p><a href="{{ route('user.editprofile', Auth::user()) }}">Edit your informations, {{ Auth::user()->name }}</a></p>                  
                  </div>
        </div>
        <hr>
        <h2>My Orders</h2>
        @foreach ($orders as $order )
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($order->cart->items as $item)
                    <li class="list-group-item">
                    <img src="{{ $item['item']['imagePath'] }}"> 
                    <span class="badge">${{ $item['price'] }}</span> 
                    {{ $item['item']['title'] }} | {{ $item['qty'] }} Units   
                    </li> 
                    @endforeach                    
                </ul>  
            </div>
        <div class="panel-footer"><strong>Total Price: ${{ $order->cart->totalPrice }}</strong></div>
        </div>
        @endforeach    
    </div>
@endsection
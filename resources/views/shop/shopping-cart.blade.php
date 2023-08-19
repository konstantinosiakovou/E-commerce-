@extends('layouts.master')

@section('title')
Laravel Shopping Cart
@endsection

@section('content')
@if(Session::has('cart'))
<div class="container-fluid">
    <div class="row"> 
        <div class="col-md-6 m-auto">
        @foreach ($products as $product)
        <li class="list-group-item">
        <img src="{{ $product['item']['imagePath'] }}" height="120" width="100">
            <span class="badge badge-secondary">Quantity: {{ $product['qty'] }}</span>
            <span class="badge badge-secondary">Item: {{ $product['item']['title'] }}</span>
            <span class="badge badge-secondary">Day: {{ $product['item']['days'] }}</span>
            <span class="badge badge-secondary">Time: {{ $product['item']['times'] }}<span>           
            <span class="badge badge-secondary">Price: ${{ $product['price'] }}</span>                           
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-md dropdown-toggle" data-toggle="dropdown">Action
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}">Reduce by 1</a>
                    </li>
                    <li><a href="{{ route('product.remove', ['id' => $product['item']['id']]) }}">Reduce All</a></li>
                </ul>
            </div>            
        </li>
        @endforeach
    </ul>
    </div> 
  </div>
</div>
<div class="container-fluid">
     <div class="row"> 
         <div class="col-md-4 m-auto">
        <strong>Total Cost: €{{ $totalPrice }}</strong>
        </ul>
    </div>
</div>
</div>
<hr>
<div class="container-fluid">
    <div class="row"> 
        <div class="col-md-4 m-auto">
        <button><a href="{{ route('checkout') }}" type="button" class="btb-btn-success">Checkout</button></a>
    </div>
</div>
</div>
@else
<div class="container-fluid">
    <div class="row"> 
        <div class="col-md-4 m-auto">
        <h1>No item to cart</h1>
        </ul>
    </div>
</div>
</div>
@endif
@endsection
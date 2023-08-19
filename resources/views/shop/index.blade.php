@extends('layouts.master')

@section('title')
    Platanenhof
@endsection
@section('content')    
    @foreach($products->chunk(3) as $productsChunk)
        <div class="row">
            @foreach($productsChunk as $products)
                <div class="col-sm-4 col-md-4">
                    <div class="thumbnail">
                        <img src="{{ $products->imagePath }}" alt="..." class="img-responsive">
                        <div class="caption">
                            <h3>{{ $products->title }}</h3>
                            <p class="description">{{ $products->description }}</p>
                            <p class="description">{{ $products->days }}</p>
                            <p class="description">{{ $products->times }}</p>
                            <div class="clearfix">
                            
                                <div class="pull-left price">€{{ $products->price }}</div>
                                <a href="{{ route('product.addToCart', ['id' => $products->id]) }}"
                                   class="btn btn-success pull-right" role="button">Προσθήκη επιλογής</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
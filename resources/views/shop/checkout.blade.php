@extends('layouts.master')

@section('title')
Payment
@endsection

@section('content')
<style type="text/css">
    .panel-title {
        display: inline;
        font-weight: bold;
    }

    .display-table {
        display: table;
    }

    .display-tr {
        display: table-row;
    }

    .display-td {
        display: table-cell;
        vertical-align: middle;
        width: 61%;
    }
</style>
<h1>Ταμείο</h1>
<h4>Τελικό Ποσό: ${{ $total }}</h4>
<div class="row">
    <div class="col-md-4 m-auto">
        <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table">
                <div class="row display-tr">
                    <h3 class="panel-title display-td">Πληροφορίες Πληρωμής</h3>
                    <div class="display-td">
                        <!-- <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png" alt="does not display"> -->
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
                @endforeach
                @endif
                @if (Session::has('success'))
                <div class="alert alert-danger text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
                @endif
                @if (Session::has('fail-message1'))
                <div class="alert alert-danger  text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message1') }}</p>
                </div>
                @endif
                @if (Session::has('fail-message2'))
                <div class="alert alert-danger  text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message2') }}</p>
                </div>
                @endif
                @if (Session::has('fail-message3'))
                <div class="alert alert-danger  text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message3') }}</p>
                </div>
                @endif
                @if (Session::has('fail-message4'))
                <div class="alert alert-danger  text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message4') }}</p>
                </div>
                @endif
                @if (Session::has('fail-message5'))
                <div class="alert alert-danger  text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message5') }}</p>
                </div>
                @endif
                @if (Session::has('fail-message6'))
                <div class="alert alert-danger  text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message5') }}</p>
                </div>
                @endif
                @if (Session::has('fail-message7'))
                <div class="alert alert-danger  text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('fail-message5') }}</p>
                </div>
                @endif
                <form action="{{ route('checkout') }}" method="POST" id="payment-form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Ονοματεπώνυμο(όπως φαίνεται στην κάρτα)</label>
                            <input type="text" id="cardname" name="cardname" class="form-control" required>
                            <label for="name">Όνομα</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                            <label for="surname">Επώνυμο</label>
                            <input type="text" id="surname" name="surname" class="form-control" required>
                            <label for="firstName">Enter Card Details</label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>
                        </div>
                    </div>
                    <div id="card-errors" role="alert"></div>
            </div>
            <button id="complete-orders" class="btn btn-success btn-block">Πληρωμή</button>
            </form>
            <!-- <label><a href="{{ route('shop.order_confirmation')}}">Pay on Delivery</a></label> -->
        </div>
    </div>
</div>
</div>

</div>
@endsection
@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="{{URL::to('js/checkout.js')}}"></script>
@endsection
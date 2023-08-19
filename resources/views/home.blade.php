@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">                    
                    
                    @if (session('usercreated'))
                    <div class="alert alert-success" role="alert">
                        {{ session('usercreated') }}
                    </div>
                    @endif
                    {{ csrf_field()  }}
                    You are now logged in! Your account is: {{ Auth::user()->verified() ? 'Verifed' : 'Not verifed'}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
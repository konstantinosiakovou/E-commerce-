@extends('layouts.master')

@section('title')
Laravel Shopping Cart
@endsection

@section('content')
<div class="justify-content-center">
    <div class="div class=d-flex p-5 h-200">
        <h1>Contact Us</h1>
        <div class="m-auto">        
        @if (Session::has('flash_message'))
        <div class="alert alert-success">{{ Session::get('flash_message')  }}</div>
        @endif
        <form method="POST" action="{{ route('contact.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name">
                @if ($errors->has('name'))
                <small class="form-text invalid-feedback">{{ $errors->first('name') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label>Email Address:</label>
                <input type="text" class="form-control" name="email">
                @if ($errors->has('email'))
                <small class="form-text invalid-feedback">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label>Message:</label>
                <textarea name="message" class="form-control"></textarea>
                @if ($errors->has('message'))
                <small class="form-text invalid-feedback">{{ $errors->first('message') }}</small>
                @endif
            </div>
            <button class="btn btn-primary">Submit</button>
            <div class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary">Save changes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
        </form>
        </div>
    </div>
        </div>
</div>
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
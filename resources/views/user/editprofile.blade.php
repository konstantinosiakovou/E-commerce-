@extends('layouts.master')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4 m-auto">
      <div class="form_content">        
        <h1>Edit your profile</h1>        
        </div>  
        @if (Session::has('usersaved'))
        <div class="alert alert-success" align="center">{{ Session::get('usersaved') }}</div>
        @endif
        <form method="post" action="{{route('users.update-profile')}}">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}                   
          <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control">
          </div>
          @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          <div>
            <div>
              <label for="email">Email</label>
              <input type="text" id="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
            </div>            
          <div>
            <label for="surname">Surname</label>
            <input type="text" id="surname" name="surname" value="{{ Auth::user()->surname }}" class="form-control">
          </div>
          @error('surname')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          <div>
            <label for="city">City</label>
            <input type="text" id="area" name="city" value="{{ Auth::user()->city }}" class="form-control">
          </div>
          @error('city')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          <div>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ Auth::user()->address }}" class="form-control">
          </div>
          @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          <div>
            <label for="zip">Zip</label>
            <input type="text" id="zip" name="zip" value="{{ Auth::user()->zip }}" class="form-control">
          </div>
          @error('zip')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          <div>
            <label for="vatnumber">VAT number</label>
            <input type="text" id="vatnumber" name="vatnumber" value="{{ Auth::user()->vatnumber }}"
              class="form-control">
          </div>
          @error('vatnumber')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          <label for="phone">{{ ('Phone') }}</label>
          <input id="phone" type="text" value="{{ Auth::user()->phone }}"
            class="form-control @error('phone') is-invalid @enderror" name="phone" required>
          @error('phone')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          <button type="submit" class="btn btn-primary">Save</button>
        </form>                       
            <p><a href="{{ route('user.changePassword', $user) }}"> Change your password</a></p>
            <form method="post" action="{{route('users.delete-profile')}}">
              @csrf
              @method('DELETE')
              
              <button type="submit">Delete Account</button>
             </form>
      </div>
    </div>
  </div>
</div>


@endsection
@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="mx-auto offset-3">
            <h1>Sign In</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('user.signin') }}" method="post">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Κωδικός</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <input type="checkbox" onclick="confirmfunction()">Εμφάνιση κωδικού
        <script>
          function confirmfunction() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                      x.type = "text";
                    } else {
                      x.type = "password";
                    }
                  }
        </script>
                </div>
                <button type="submit" class="btn btn-primary">Σύνδεση</button>
                {{ csrf_field() }}
            </form>
            <label for="remember_me">
                <input type="checkbox" name="remember_me" id="remember_me" value="1">Απομνυμόνευση
              </label>
              <p><a href="{{ route('password.request')}}">Ξέχασατε τον κωδικό σας;</a></p>      
      <p>Δεν έχετε λογαριασμό; <a href="{{ route('user.signup') }}">Εγγραφείτε!</p>
        </div>
    </div>
@endsection
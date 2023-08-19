@if( Auth::check() )
<h1>hello{{ Auth::user()->name }}</h1>
@else
<h1><p>Don't have an account?<a href="{{ route('user.signup') }}"> Sign up instead!</a></p></h1>
@endif
<p>

    please click the password reset button to reset your password
    <p><a href="{{ route('user.reset_password_form', $user->email.'/'.$code)}}"> Forgot your password?</p>
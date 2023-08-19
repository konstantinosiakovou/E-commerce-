<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Platanenhof') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                            
                    </ul>
                    <script>
                var msg = '{{Session::get('success')}}';
                var exist = '{{Session::has('success')}}';
                if(exist){
                    alert(msg);
                }
            </script> 
            <script>
                var msg = '{{Session::get('logout')}}';
                var exist = '{{Session::has('logout')}}';
                if(exist){
                    alert(msg);
                }
            </script> 
            <script>
                var msg = '{{Session::get('usercreated')}}';
                var exist = '{{Session::has('usercreated')}}';
                if(exist){
                    alert(msg);
                }
            </script> 
            <script>
                var msg = '{{Session::get('verification')}}';
                var exist = '{{Session::has('verification')}}';
                if(exist){
                    alert(msg);
                }
            </script> 
            <script>
                var msg = '{{Session::get('userdeleted')}}';
                var exist = '{{Session::has('userdeleted')}}';
                if(exist){
                    alert(msg);
                }
            </script> 
             <script>
                var msg = '{{Session::get('message')}}';
                var exist = '{{Session::has('message')}}';
                if(exist){
                    alert(msg);
                }
            </script>
             <script>
                var msg = '{{Session::get('userverified')}}';
                var exist = '{{Session::has('userverified')}}';
                if(exist){
                    alert(msg);
                }
            </script>
                @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>                    
                    {{ $error }}
                </div>
                @endforeach
                @endif                           
                @if(Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ Session::get('success') }}
                </div>
                @else
                @if(Session::has('logout'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ Session::get('logout') }}
                    </div>
                @elseif(Session::has('usercreated'))
                    <div class="alert alert-info text-center" role="alert">
                        {{ Session::get('usercreated') }} 
                    </div>                
                @elseif(Session::has('error'))
                    <div class="alert alert-warning text-center" role="alert">
                        {{ Session::get('error') }} 
                    </div>  
                @elseif(Session::has('verification'))
                    <div class="alert alert-warning text-center" role="alert">
                        {{ Session::get('verification') }} 
                    </div>  
                @elseif(Session::has('userdeleted'))
                    <div class="alert alert-success text-center">
                    {{ session::get('userdeleted') }}
                    </div>  
                @elseif(Session::has('message'))
                    <div class="alert alert-success text-center">
                    {{ session::get('message') }}
                    </div>                    
                @endif
                @if(Session::has('userverified'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ Session::get('userverifed') }}
                    </div>
                @endif    
            @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.signin') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.signup) }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

<img src="images/cover.jpg" class=".img-responsive max-width: 100%; and height: auto; .center-block" alt="Responsive image"><br>
<nav class="navbar navbar-expand-sm navbar fixed-top navbar-light bg-light sticky-top navbar navbar-light ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
    
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('product.index') }}">Κεντρική Σελίδα <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('contact') }}">Επικοινωνία</a>
      </li>
      
      <li class="nav-item dropdown">        
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="">Contact</a>          
        </div>
      </li>
    </ul>
  </div>
  <!-- <form class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form> -->

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav sm-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('product.shoppingCart') }}">
          <i class="fas fa-shopping-cart"></i> Καλάθι
          <span class="badge badge-primary">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="true">
          <i class="fas fa-user"></i>@if(Auth::check())
          {!! auth()->user()->name !!}
          @else
          Σύνδεση ως επισκέπτης
          @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::check())
          <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-address-card"
              aria-hidden="true"></i> Προφίλ
            <a class="dropdown-item" href="{{ route('user.editprofile', Auth::user()) }}"><i class="fa fa-edit"
                aria-hidden="true"></i> Επεξεργασία προφίλ</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i>
              Αποσύνδεση</a>
            @else
            <a class="dropdown-item" href="{{ route('user.signup') }}"><i class="fa fa-user-plus"
                aria-hidden="true"></i> Εγγραφή</a>
            <a class="dropdown-item" href="{{route ('user.signin')}}"><i class="fas fa-sign-in-alt"></i> Σύνδεση</a>
            @endif


        </div>
      </li>
    </ul>

  </div>
</nav>
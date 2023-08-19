@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="mx-auto offset-3">
            <h1>Sign Up</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form name="my-form" onsubmit="return validform()" action="{{ route('user.signup') }}" method="post">
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Όνομα:</label>
                    <div class="col-md-6">
                        <input type="text" id="name" class="form-control" name="name">
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">Επώνυμο:</label>
                    <div class="col-md-6">
                        <input type="text" id="surname" class="form-control" name="surname">
                    </div>
                    @error('surname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Κωδικός:</label>
                    <div class="col-md-6">
                        <input type="password" id="password" class="form-control" name="password">
                        <input type="checkbox" onclick="passwordfunction()">Εμφάνιση κωδικού                
                    <script>function passwordfunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                          x.type = "text";
                        } else {
                          x.type = "password";
                        }
                      }</script>
                    </div>                                    
                   <div class="container"><p class="text-muted" text-align="center">.<br></p></div>                                    
                
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Επιβεβαίωση Κωδικού:</label>
                    <div class="col-md-6">
                        <input type="text" id="password_confirmation" class="form-control" name="password_confirmation">
                        <input type="checkbox" onclick="confirmfunction()">Εμφάνιση κωδικού
                            <script>function confirmfunction() {
                                var x = document.getElementById("password_confirmation");
                                if (x.type === "password") {
                                x.type = "text";
                                } else {
                                x.type = "password";
                                }
                            }</script>
                    </div>
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail:</label>
                <div class="col-md-6">
                    <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
   
                
                <div class="form-group row">
                    <label for="email-confirm" class="col-md-4 col-form-label text-md-right">Επιβεβαίωση e-mail</label>                                
                    <div class="col-md-6">
                        <input id="email-confirm" type="email" class="form-control" name="email_confirmation">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Τηλεφωνικός αριθμός:</label>
                    <div class="col-md-6">                                        
                        <input id="phone" type="telephone" class="form-control @error('phone') is-invalid @enderror" name="phone" >
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="stathero" class="col-md-4 col-form-label text-md-right">Σταθερό τηλέφωνο(προαιρετικό):</label>
                    <div class="col-md-6">                                        
                        <input type="tel" class="form-control @error('stathero') is-invalid @enderror" name="telephone">
                        @error('stathero')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">Διεύθυνση:</label>
                    <div class="col-md-6">
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>  
                
                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">Πόλη:</label>
                    <div class="col-md-6">
                        <input type="city" name="city" id="city" class="form-control">
                    </div>
                    @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div> 

                <div class="form-group row">
                    <label for="zip" class="col-md-4 col-form-label text-md-right">Ταχυδρομικός Κώδικας:</label>
                    <div class="col-md-6">
                        <input id="zip" name="zip" type="number" class="form-control">
                    </div>
                    @error('zip')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- <div class="form-group row">
                    <label for="vatnumber" class="col-md-4 col-form-label text-md-right">ΑΦΜ:</label>
                    <div class="col-md-6">
                        <input type="text" id="number" name="number" class="form-control">
                        <div class="container"><p class="text-muted">Προαιρετικό</p></div> 
                    </div>
                    @error('vatnumber')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div> -->

                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                        Εγγραφή
                        </button>
                        {{ csrf_field() }}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

        </div>
    </div>
@endsection
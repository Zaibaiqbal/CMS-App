<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

            <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/pcoded-horizontal.min.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/prism.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">	
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Tempusdominus Bootstrap 4 -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
      
        <!-- Style.css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('icon\themify-icons\themify-icons.css') }}">
        <!-- ico font -->
        <link rel="stylesheet" type="text/css" href="{{ asset('icon\icofont\css\icofont.css') }}">
        <!-- feather Awesome -->
        <link rel="stylesheet" type="text/css" href="{{ asset('icon\feather\css\feather.css') }}">

    
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="hold-transition login-page">

        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                <a href="../../index2.html" class="h1">
                     <img alt="Logo" src="{{asset('logos/logo.png')}}" width="50px" />
               </a>
                </div>
                <div class="card-body">
                <p class="login-box-msg">Login to start</p>

                <form method="POST" action="{{ route('login') }}">
                @csrf

                    <div class="input-group mb-3">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    </div>
                    <div class="input-group mb-3">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                   
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->

               <div class="row mt-4">

                    <div class="col-md-12 text-center">
                        <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        </p>
                    </div>

               </div>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.js') }}" defer></script>

        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/menu-hori-fixed.js') }}" defer></script>
        <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
        <script src="{{ asset('js/pcoded.min.js') }}" defer></script>
        <script src="{{ asset('js/script.js') }}" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    </body>
</html>

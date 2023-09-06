<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

            <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/pcoded-horizontal.min.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/j-pro-modern.css') }}" rel="stylesheet">	
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

           <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">

        <div class="pcoded-container">
        
            <div class="pcoded-main-container">
        
                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">

                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    
                                    <div class="page-header m-t-30">
                                      <div class="row align-items-end">
                                       
                                      
                                      </div>
                                    </div>
                                     <!-- Page body start -->
                                     <div class="page-body">
                                        <div class="row">
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <!-- Login card start -->
                                                <div class="card">
                                                    <div class="card-header text-center">

                                                    <img alt="Logo" src="{{asset('logos/logo.png')}}" width="22%" />

                                                        
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="j-wrapper j-wrapper-400 p-0">
                                                            <form method="POST" action="{{ route('login') }}" class="j-pro" id="j-pro" novalidate="">
                                                                @csrf
                                                                <!-- end /.header -->
                                                                <div class="j-content">
                                                                    <!-- start login -->
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                        @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                            <label class="j-icon-right" for="login">
                                                        <i class="icofont icofont-ui-user"></i>
                                                    </label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Email">

                                                                        </div>
                                                                    </div>
                                                                    <!-- end login -->
                                                                    <!-- start password -->
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                        @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                            <label class="j-icon-right" for="password">
                                                        <i class="icofont icofont-lock"></i>
                                                    </label>
                                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                                        </div>
                                                                    </div>
                                                                    <!-- end password -->
                                                                    
                                                                </div>
                                                                <!-- end /.content -->
                                                                <center>

                                                                <div class="j-footer">
                                                                    <button type="submit" class="btn btn-primary text-center">Login</button>
                                                                </div>
                                                                </center>

                                                                <!-- end /.footer -->
                                                            </form>

                                                                <div class="row mt-4">

                                                    <div class="col-md-12 text-center">
                                                        <p class="mb-0">
                                                        <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-500 underline mr-3">Register</a>
                                                        </p>
                                                    </div>

                                                    </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Login card end -->
                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->
                            <div id="styleSelector">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

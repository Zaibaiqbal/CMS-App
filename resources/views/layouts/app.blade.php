<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  
            <!-- Fonts -->
            <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/pcoded-horizontal.min.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/j-pro-modern.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/prism.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">	
        <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">	
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

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



        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
        <script src="{{ asset('js/bootstrap.js') }}" defer></script>

        <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/menu-hori-fixed.js') }}" defer></script>
        <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
        <script src="{{ asset('js/pcoded.min.js') }}" defer></script>
        <script src="{{ asset('js/script.js') }}" defer></script>
        <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

@yield('page_script')

</head>
<body>

            @yield('content')
        
</body>
</html>

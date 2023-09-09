<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Tempusdominus Bootstrap 4 -->

    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css"
        integrity="sha512-SgaqKKxJDQ/tAUAAXzvxZz33rmn7leYDYfBP+YoMRSENhf3zJyx3SBASt/OfeQwBHA1nxMis7mM3EV/oYT6Fdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon\themify-icons\themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon\icofont\css\icofont.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('icon\feather\css\feather.css') }}">

    <link href="{{ asset('plugins/search-box/css/search_box.min.css') }}" rel="stylesheet">

    <!-- Styles -->

    <style>
        nav ul li a {
            color: white !important;
        }

        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .modal {
            z-index: 1052;
        }
    </style>
    @yield('page_style')
</head>

<body class="menu-static">

    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pre-loader end -->

    <div id="pcoded" class="pcoded">

        <div class="pcoded-container">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <nav class="navbar header-navbar pcoded-header">
                    <div class="navbar-wrapper">

                        <div class="navbar-logo" style="height: 72px !important;">
                            <a class="mobile-menu" id="mobile-collapse" href="#!">
                                <i class="feather icon-menu"></i>
                            </a>
                            <a href="{{ route('home') }}" class="my-4">
                                <img class="img-fluid" src="{{ asset('logos/logo.png') }}" width="30%"
                                    alt="Theme-Logo">
                            </a>
                            <a class="mobile-options">
                                <i class="feather icon-more-horizontal"></i>
                            </a>
                        </div>

                        <div class="navbar-container container-fluid">
                            <ul class="nav-left">
                                <li class="header-search">
                                    <div class="main-search morphsearch-search">
                                        <div class="input-group">
                                            <span class="input-group-addon search-close"><i
                                                    class="feather icon-x"></i></span>
                                            <input type="text" class="form-control">
                                            <span class="input-group-addon search-btn"><i
                                                    class="feather icon-search"></i></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="#!" onclick="javascript:toggleFullScreen()">
                                        <i class="feather icon-maximize full-screen"></i>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav-right">
                                <li class="header-notification">
                                    <div class="dropdown-primary dropdown" onclick="appearNotification();">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="feather icon-bell"></i>
                                            <span class="notification_count badge bg-c-pink">0</span>
                                        </div>
                                        <ul class="show-notification notification-view dropdown-menu"
                                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <li>
                                                <h6>Notifications</h6>
                                                <label class="label label-danger">New</label>
                                            </li>

                                            <li>
                                                <div id="notification_body">

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="nav-item">
                                    <button id="theme-toggle" class="btn btn-sm btn-outline-secondary">
                                        Toggle Theme
                                    </button>
                                </li>


                                <li class="user-profile header-notification">
                                    <div class="dropdown-primary dropdown">
                                        <div class="dropdown-toggle" data-toggle="dropdown">
                                            <img src="{{ asset('images/user.jpg') }}" class="img-radius"
                                                alt="User-Profile-Image">
                                            <span>{{ Auth::user()->name }}</span>
                                            <i class="feather icon-chevron-down"></i>
                                        </div>
                                        <ul class="show-notification profile-notification dropdown-menu"
                                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            @if (!Auth::user()->hasRole(['Super Admin']))
                                                <li>
                                                    <a class="text-dark" content="sign off"
                                                        onclick="formSubmission(event,this)"
                                                        href="{{ route('sendemployeedailyprogress') }}"> <i
                                                            class="fa fa-lock"></i></i>
                                                        Sign Off
                                                    </a>

                                                </li>
                                            @endif
                                            <li>
                                                <a class="text-dark" data-target="#modal_change_password"
                                                    data-toggle="modal" href="#"> <i
                                                        class="fa fa-lock"></i></i>
                                                    Change Password
                                                </a>

                                            </li>
                                            <li>
                                                <a class="text-dark" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                              document.getElementById('logout-form').submit();">
                                                    <i class="feather icon-log-out"></i>
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>

                                            </li>

                                        </ul>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="pcoded-main-container mt-3">
                    <div class="pcoded-wrapper">
                        <nav class="pcoded-navbar">
                            <div class="pcoded-inner-navbar main-menu">
                                <ul class="pcoded-item pcoded-left-item">
                                    <li class="">
                                        <a href="{{ route('home') }}">
                                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                            <span class="pcoded-mtext text-uppercase">Dashboard</span>
                                        </a>

                                    </li>
                                    @if (Auth::user()->hasAnyPermission(['All', 'View Clients', 'View Unapproved Clients']))

                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i class="feather icon-user"></i></span>

                                                <span class="pcoded-mtext">CLIENTS</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                @if (Auth::user()->hasAnyPermission(['All', 'View Clients']))
                                                    <li class=" text-dark">
                                                        <a href="{{ route('users.list') }}">

                                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">VIEW
                                                                CLIENTS</span>
                                                        </a>

                                                    </li>
                                                @endif
                                                @if (Auth::user()->hasAnyPermission(['All', 'View Unapproved Clients']))
                                                    <li class="">
                                                        <a href="{{ route('unapproveclients.list') }}">

                                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">VIEW
                                                                UNAPPROVED CLIENTS</span>
                                                        </a>

                                                    </li>
                                                @endif

                                            </ul>
                                        </li>

                                    @endif

                                    @if (Auth::user()->hasAnyPermission(['All', 'View Contacts', 'View Unapproved Contacts']))

                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i
                                                        class="icofont icofont-contact-add"></i></span>

                                                <span class="pcoded-mtext">CONTACTS</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                @if (Auth::user()->hasAnyPermission(['All', 'View Contacts']))
                                                    <li class="">
                                                        <a href="{{ route('contactpersons.list') }}">

                                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">VIEW
                                                                CONTACTS</span>
                                                        </a>

                                                    </li>
                                                @endif
                                                @if (Auth::user()->hasAnyPermission(['All', 'View Unapproved Contacts']))
                                                    <li class="">
                                                        <a href="{{ route('unapprovecontactpersons.list') }}">

                                                            <span class="pcoded-mtext" data-i18n="nav.dash.main">VIEW
                                                                UNAPPROVED CONTACTS</span>
                                                        </a>

                                                    </li>
                                                @endif

                                            </ul>
                                        </li>

                                    @endif

                                    @if (Auth::user()->hasAnyPermission(['All', 'View Accounts']))
                                        <li class="">
                                            <a href="{{ route('accounts.list') }}">
                                                <span class="pcoded-micon"><i
                                                        class="icofont icofont-people"></i></span>

                                                <span class="pcoded-mtext">ACCOUNTS</span>
                                            </a>

                                        </li>
                                    @endif
                                    @if (Auth::user()->hasAnyPermission(['All', 'View Materials']))
                                        <li class="pcoded-hasmenu">
                                            <a href="javascript:void(0)">
                                                <span class="pcoded-micon"><i
                                                        class="icofont icofont-bricks"></i></span>

                                                <span class="pcoded-mtext">MATERIALS</span>
                                            </a>
                                            <ul class="pcoded-submenu">
                                                <li class="">
                                                    <a href="{{ route('material.types.list') }}">

                                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">VIEW
                                                            MATERIALS</span>
                                                    </a>

                                                </li>

                                                <li class="">
                                                    <a href="{{ route('material.rate.list') }}">

                                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">VIEW
                                                            MATERIAL RATES</span>
                                                    </a>

                                                </li>
                                                {{--
                                            <li class="">
                                                <a href="{{route('rateslab')}}">
                                                
                                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">VIEW RATE SLAB</span>
                                                </a>
                                            
                                            </li>
                                            --}}
                                            </ul>
                                        </li>
                                    @endif
                                    @if (Auth::user()->hasAnyPermission(['All', 'View Trucks', 'Add Truck', 'Update Truck']))
                                        <li class="">
                                            <a href="{{ route('trucks.list') }}">
                                                <span class="pcoded-micon"><i
                                                        class="icofont icofont-free-delivery"></i></span>
                                                <span class="pcoded-mtext">FLEET</span>
                                            </a>

                                        </li>
                                    @endif
                                    @if (Auth::user()->hasAnyPermission(['All', 'View Locations']))
                                        <li class="">
                                            <a href="{{ route('locations.list') }}">
                                                <span class="pcoded-micon"><i
                                                        class="icofont icofont-location-pin"></i></span>

                                                <span class="pcoded-mtext">OUTBOUND LOCATIONS</span>
                                            </a>

                                        </li>
                                    @endif
                                    @if (Auth::user()->hasAnyPermission(['All', 'View Transactions']))
                                        <li class="">
                                            <a href="{{ route('transactions.list') }}">
                                                <span class="pcoded-micon"><i
                                                        class="feather icon-credit-card"></i></span>

                                                <span class="pcoded-mtext">ezWeigh</span>
                                            </a>

                                        </li>
                                    @endif
                                    @if (Auth::user()->hasAnyPermission(['All', 'View Employees']))
                                        <li class="">
                                            <a href="{{ route('employees.list') }}">
                                                <span class="pcoded-micon"><i class="feather icon-user"></i></span>

                                                <span class="pcoded-mtext">EMPLOYEES</span>
                                            </a>

                                        </li>
                                    @endif
                                    @if (Auth::user()->hasAnyPermission(['All', 'Roles & Permissions']))
                                        <li class="">
                                            <a href="{{ route('roles.permissions') }}">
                                                <span class="pcoded-micon"><i class="feather icon-command"></i></span>

                                                <span class="pcoded-mtext">ROLES & PERMISSIONS</span>
                                            </a>

                                        </li>
                                    @endif

                                </ul>

                            </div>
                        </nav>
                        <div class="pcoded-content">
                            <div class="pcoded-inner-content p-0">


                                <!-- Main-body start -->
                                <div class="main-body">
                                    <div class="page-wrapper p-2">

                                        <div class="page-header mb-0">
                                            <div class="row align-items-end">
                                                <div class="col-lg-8">

                                                </div>
                                                <div class="col-lg-4 m-t-20">
                                                    <div class="page-header-breadcrumb">
                                                        @yield('page_breadcrumbs')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Page body start -->
                                        <div class="page-body">

                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @yield('page_body')


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

    </div>

    @yield('page_modal')

    <!-- ./wrapper -->
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('js/menu-sidebar-static.js') }}" defer></script>
    <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}" defer></script>
    <script src="{{ asset('js/pcoded.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/search-box/js/search_box.min.js') }}"></script>


    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="{{ asset('plugins/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3/dist/js.cookie.min.js"></script>


    <script>
        
        setFstDropdown();

        $('#table_datatable').DataTable();

        function loadNotification() {
            $.get("{{ url('loadnotification') }}", function(data) {

                $('.notification_count').hide();

                if (data.notification_count > 0) {
                    $('.notification_count').show();

                    $('.notification_count').html(data.notification_count);
                }

                $('#notification_body').html(data.body);


            }).fail(function(data) {

                messageToaster('error', 'Try Again.', 'Failed');
            });
        }

        function appearNotification() {

            $.get("{{ url('appearnotification') }}", function(data) {

            }).fail(function(data) {

            });
        }

        function seenNotification(event, obj, id) {
            event.preventDefault();

            $.get("{{ url('seennotification') }}", {
                id: id
            }, function(data) {

                $('.notification_count').hide();

                if (data.notification_count > 0) {
                    $('.notification_count').show();

                    $('.notification_count').html(data.notification_count);
                }

                $('#notification_body').html(data.boy);

                window.location.href = $(obj).attr('href');


            }).fail(function(data) {

                messageToaster('error', 'Try Again.', 'Failed');
            });
        }

        $(document).ready(function() {

            loadNotification();

            Pusher.logToConsole = true;
            // Enable pusher logging - don't include this in production
            // Pusher.logToConsole = true;
            var user_id = parseInt("{{ Auth::id() }}");

            var pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", {
                cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}"
            });

            var channel = pusher.subscribe('my-channel');

            channel.bind('my-event', function(data) {

                if ($.inArray(user_id, data) != -1) {
                    loadNotification();

                }


            });
        });
        
    </script>
        <script type="module" src="{{ asset('js/theme-toggle.js') }}"></script>




    @yield('page_script')

    @include('users.modals.change_password')

</body>

</html>

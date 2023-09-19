@extends('layouts.master')

@section('page_body')
    <div class="row">
        <div class="col-md-12">
            <div class="dropdown dropdown-inline" style="float: right;">
                <a href="#" class="btn btn-clean btn-hover-light-primary btn-icon" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="feather icon-menu"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="margin-top:5%;width:100%;">
                    <!--begin::Naviigation-->
                    <ul class="navi">

                        <li class="navi-separator mb-1 opacity-70"></li>
                        <li class="navi-item mx-2 mb-2">
                            <span class="navi-icon">

                            </span>
                            <span class="navi-text ">
                                <b>From</b>
                                <input id="latest_from" type="date" name="from" class="form-control form-control-sm">
                            </span>
                        </li>

                        <li class="navi-item mx-2 mb-2">
                            <span class="navi-icon">

                            </span>
                            <span class="navi-text">
                                <b>To</b>
                                <input id="latest_to" type="date" name="to" class="form-control form-control-sm">
                            </span>
                        </li>

                        <li class="navi-item my-2 mx-4 mb-4">
                            <span class="navi-icon">

                            </span>
                            <span class="navi-text">
                                <button onclick="showDashboardStats(true);" type="button"
                                    class="btn btn-sm btn-outline-primary float-right">Filter</button>
                            </span>
                        </li>

                    </ul>
                    <!--end::Naviigation-->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-md-8">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">Clients</p>
                                <h4 class="m-b-0 total_clients">0</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-user f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">Tickets</p>
                                <h4 class="m-b-0 tickets">0</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-credit-card f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-pink text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">Inbound</p>
                                <h4 class="m-b-0 inbound">0</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-log-in f-50 text-c-pink"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-c-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">Outbound</p>
                                <h4 class="m-b-0 outbound">0</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-log-out f-50 text-c-blue"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <!-- statustic-card start -->
        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left ">
                        <div class="card-title">Material Wise Transactions</div>
                    </div>
                </div>
                <div class="card-block-big">

                    <div class="tab-content tabs card-block">
                        <div class="tab-pane active" id="home1" role="tabpanel">
                            <table class="table table-hover table-borderless">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Material</th>
                                        <th>In-weight</th>
                                        <th>Out-weight</th>
                                    </tr>
                                </thead>
                                <tbody id="material_weightage">

                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        

        <div class="col-xl-12 col-md-12" >
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left ">
                        <div class="card-title">Latest Transactions</div>
                    </div>
                </div>
                <div class="card-block-big">

                    <div class="tab-content tabs card-block">
                        <div class="tab-pane active" id="home1" role="tabpanel">
                            <table class="table table-hover table-borderless">
                                <thead class="bg-success">
                                    <tr>
                                        <th>#</th>
                                        <th>License No</th>
                                        <th>Description</th>
                                        <th>Client</th>
                                        <th>Ticket No.</th>

                                    </tr>
                                </thead>
                                <tbody id="latest_transactions">

                                </tbody>
                            </table>
                        </div>


                    </div>

                </div>
            </div>
        </div>
            
        </div>
        </div>


        <div class="col-xl-4 col-md-4" style="padding: 0%">
            {{-- <div class="row"> --}}

            <div class="col-xl-12 col-md-12" style="padding: 0%">
                <div class="showWeatherForcast"></div>
            </div>
            {{-- </div> --}}


            </div>

        <!-- statustic-card start -->
        
        
        <!-- statustic-card start -->

        

    </div>
    <!-- statustic-card start -->
    {{--
<!-- income start -->
<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-header">
            <h5>Total Leads</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                    <li><i class="fa fa-window-maximize full-card"></i></li>
                    <li><i class="fa fa-minus minimize-card"></i></li>
                    <li><i class="fa fa-refresh reload-card"></i></li>
                    <li><i class="fa fa-trash close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <p class="text-c-green f-w-500"><i class="feather icon-chevrons-up m-r-5"></i> 18% High than last month</p>
            <div class="row">
                <div class="col-4 b-r-default">
                    <p class="text-muted m-b-5">Overall</p>
                    <h5>76.12%</h5>
                </div>
                <div class="col-4 b-r-default">
                    <p class="text-muted m-b-5">Monthly</p>
                    <h5>16.40%</h5>
                </div>
                <div class="col-4">
                    <p class="text-muted m-b-5">Day</p>
                    <h5>4.56%</h5>
                </div>
            </div>
        </div>
        <canvas id="tot-lead" height="150"></canvas>
    </div>
</div>
<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-header">
            <h5>Total Vendors</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                    <li><i class="fa fa-window-maximize full-card"></i></li>
                    <li><i class="fa fa-minus minimize-card"></i></li>
                    <li><i class="fa fa-refresh reload-card"></i></li>
                    <li><i class="fa fa-trash close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <p class="text-c-pink f-w-500"><i class="feather icon-chevrons-down m-r-15"></i> 24% High than last month</p>
            <div class="row">
                <div class="col-4 b-r-default">
                    <p class="text-muted m-b-5">Overall</p>
                    <h5>68.52%</h5>
                </div>
                <div class="col-4 b-r-default">
                    <p class="text-muted m-b-5">Monthly</p>
                    <h5>28.90%</h5>
                </div>
                <div class="col-4">
                    <p class="text-muted m-b-5">Day</p>
                    <h5>13.50%</h5>
                </div>
            </div>
        </div>
        <canvas id="tot-vendor" height="150"></canvas>
    </div>
</div>
<div class="col-xl-4 col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>Invoice Generate</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                    <li><i class="fa fa-window-maximize full-card"></i></li>
                    <li><i class="fa fa-minus minimize-card"></i></li>
                    <li><i class="fa fa-refresh reload-card"></i></li>
                    <li><i class="fa fa-trash close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <p class="text-c-green f-w-500"><i class="feather icon-chevrons-up m-r-15"></i> 20% High than last month</p>
            <div class="row">
                <div class="col-4 b-r-default">
                    <p class="text-muted m-b-5">Overall</p>
                    <h5>68.52%</h5>
                </div>
                <div class="col-4 b-r-default">
                    <p class="text-muted m-b-5">Monthly</p>
                    <h5>28.90%</h5>
                </div>
                <div class="col-4">
                    <p class="text-muted m-b-5">Day</p>
                    <h5>13.50%</h5>
                </div>
            </div>
        </div>
        <canvas id="invoice-gen" height="150"></canvas>
    </div>
</div>
<!-- income end -->

<!-- ticket and update start -->
<div class="col-xl-6 col-md-12">
    <div class="card table-card">
        <div class="card-header">
            <h5>Recent Tickets</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                    <li><i class="fa fa-window-maximize full-card"></i></li>
                    <li><i class="fa fa-minus minimize-card"></i></li>
                    <li><i class="fa fa-refresh reload-card"></i></li>
                    <li><i class="fa fa-trash close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Subject</th>
                            <th>Department</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label class="label label-success">open</label></td>
                            <td>Website down for one week</td>
                            <td>Support</td>
                            <td>Today 2:00</td>
                        </tr>
                        <tr>
                            <td><label class="label label-primary">progress</label></td>
                            <td>Loosing control on server</td>
                            <td>Support</td>
                            <td>Yesterday</td>
                        </tr>
                        <tr>
                            <td><label class="label label-danger">closed</label></td>
                            <td>Authorizations keys</td>
                            <td>Support</td>
                            <td>27, Aug</td>
                        </tr>
                        <tr>
                            <td><label class="label label-success">open</label></td>
                            <td>Restoring default settings</td>
                            <td>Support</td>
                            <td>Today 9:00</td>
                        </tr>
                        <tr>
                            <td><label class="label label-primary">progress</label></td>
                            <td>Loosing control on server</td>
                            <td>Support</td>
                            <td>Yesterday</td>
                        </tr>
                        <tr>
                            <td><label class="label label-success">open</label></td>
                            <td>Restoring default settings</td>
                            <td>Support</td>
                            <td>Today 9:00</td>
                        </tr>
                        <tr>
                            <td><label class="label label-danger">closed</label></td>
                            <td>Authorizations keys</td>
                            <td>Support</td>
                            <td>27, Aug</td>
                        </tr>
                        <tr>
                            <td><label class="label label-success">open</label></td>
                            <td>Restoring default settings</td>
                            <td>Support</td>
                            <td>Today 9:00</td>
                        </tr>
                        <tr>
                            <td><label class="label label-primary">progress</label></td>
                            <td>Loosing control on server</td>
                            <td>Support</td>
                            <td>Yesterday</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right m-r-20">
                    <a href="#!" class=" b-b-primary text-primary">View all Projects</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-12">
    <div class="card latest-update-card">
        <div class="card-header">
            <h5>Latest Updates</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                    <li><i class="fa fa-window-maximize full-card"></i></li>
                    <li><i class="fa fa-minus minimize-card"></i></li>
                    <li><i class="fa fa-refresh reload-card"></i></li>
                    <li><i class="fa fa-trash close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <div class="latest-update-box">
                <div class="row p-t-20 p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">2 hrs ago</p>
                        <i class="feather icon-twitter bg-info update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>+ 1652 Followers</h6>
                        <p class="text-muted m-b-0">You’re getting more and more followers, keep it up!</p>
                    </div>
                </div>
                <div class="row p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">4 hrs ago</p>
                        <i class="feather icon-briefcase bg-simple-c-pink update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>+ 5 New Products were added!</h6>
                        <p class="text-muted m-b-0">Congratulations!</p>
                    </div>
                </div>
                <div class="row p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">1 day ago</p>
                        <i class="feather icon-check bg-simple-c-yellow  update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>Database backup completed!</h6>
                        <p class="text-muted m-b-0">Download the <span class="text-c-blue">latest backup</span>.</p>
                    </div>
                </div>
                <div class="row p-b-0">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">2 day ago</p>
                        <i class="feather icon-facebook bg-simple-c-green update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>+2 Friend Requests</h6>
                        <p class="text-muted m-b-10">This is great, keep it up!</p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <td class="b-none">
                                        <a href="#!" class="align-middle">
                                       <img src="..\files\assets\images\avatar-2.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                       <div class="d-inline-block">
                                           <h6>Jeny William</h6>
                                           <p class="text-muted m-b-0">Graphic Designer</p>
                                       </div>
                                   </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="b-none">
                                        <a href="#!" class="align-middle">
                                       <img src="..\files\assets\images\avatar-1.jpg" alt="user image" class="img-radius img-40 align-top m-r-15">
                                       <div class="d-inline-block">
                                           <h6>John Deo</h6>
                                           <p class="text-muted m-b-0">Web Designer</p>
                                       </div>
                                   </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#!" class="b-b-primary text-primary">View all Projects</a>
            </div>
        </div>
    </div>
</div>
<!-- ticket and update end -->

<!-- latest activity end -->
<div class="col-xl-8 col-md-12">
    <div class="card latest-activity-card">
        <div class="card-header">
            <h5>Latest Activity</h5>
        </div>
        <div class="card-block">
            <div class="latest-update-box">
                <div class="row p-t-20 p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">just now</p>
                        <i class="feather icon-sunrise bg-simple-c-blue update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>John Deo</h6>
                        <p class="text-muted m-b-15">The trip was an amazing and a life changing experience!!</p>
                        <img src="..\files\assets\images\mega-menu\01.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                        <img src="..\files\assets\images\mega-menu\03.jpg" alt="" class="img-fluid img-100 m-r-15 m-b-10">
                    </div>
                </div>
                <div class="row p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">5 min ago</p>
                        <i class="feather icon-file-text bg-simple-c-blue update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>Administrator</h6>
                        <p class="text-muted m-b-0">Free courses for all our customers at A1 Conference Room - 9:00 am tomorrow!</p>
                    </div>
                </div>
                <div class="row p-b-30">
                    <div class="col-auto text-right update-meta">
                        <p class="text-muted m-b-0 d-inline">3 hours ago</p>
                        <i class="feather icon-map-pin bg-simple-c-blue update-icon"></i>
                    </div>
                    <div class="col">
                        <h6>Jeny William</h6>
                        <p class="text-muted m-b-15">Happy Hour! Free drinks at <span class="text-c-blue">Cafe-Bar all </span>day long!</p>
                        <div id="markers-map" style="height:200px;width:100%"></div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <a href="#!" class=" b-b-primary text-primary">View all Activity</a>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-12">
    <div class="card per-task-card">
        <div class="card-header">
            <h5>Your Tasks</h5>
        </div>
        <div class="card-block">
            <div class="row per-task-block text-center">
                <div class="col-6">
                    <div data-label="45%" class="radial-bar radial-bar-45 radial-bar-lg radial-bar-primary"></div>
                    <h6 class="text-muted">Finished</h6>
                    <p class="text-muted">642</p>
                    <button class="btn btn-primary btn-round btn-sm">Manage</button>
                </div>
                <div class="col-6">
                    <div data-label="30%" class="radial-bar radial-bar-30 radial-bar-lg radial-bar-primary"></div>
                    <h6 class="text-muted">Remaining</h6>
                    <p class="text-muted">495</p>
                    <button class="btn btn-primary btn-outline-primary btn-round btn-sm">Manage</button>
                </div>
            </div>

        </div>
    </div>
    <div class="card feed-card">
        <div class="card-header">
            <h5>Upcoming Deadlines</h5>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="fa fa fa-wrench open-card-option"></i></li>
                    <li><i class="fa fa-window-maximize full-card"></i></li>
                    <li><i class="fa fa-minus minimize-card"></i></li>
                    <li><i class="fa fa-refresh reload-card"></i></li>
                    <li><i class="fa fa-trash close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="card-block">
            <div class="row m-b-25">
                <div class="col-auto p-r-0">
                    <img src="..\files\assets\images\mega-menu\01.jpg" alt="" class="img-fluid img-50">
                </div>
                <div class="col">
                    <h6 class="m-b-5">New able - Redesign</h6>
                    <p class="text-c-pink m-b-0">2 Days Remaining</p>
                </div>
            </div>
            <div class="row m-b-25">
                <div class="col-auto p-r-0">
                    <img src="..\files\assets\images\mega-menu\02.jpg" alt="" class="img-fluid img-50">
                </div>
                <div class="col">
                    <h6 class="m-b-5">New Admin Dashboard</h6>
                    <p class="text-c-pink m-b-0">Proposal in 6 Days</p>
                </div>
            </div>
            <div class="row m-b-25">
                <div class="col-auto p-r-0">
                    <img src="..\files\assets\images\mega-menu\03.jpg" alt="" class="img-fluid img-50">
                </div>
                <div class="col">
                    <h6 class="m-b-5">Logo Design</h6>
                    <p class="text-c-green m-b-0">10 Days Remaining</p>
                </div>
            </div>

            <div class="text-center">
                <a href="#!" class="b-b-primary text-primary">View all Feeds</a>
            </div>
        </div>
    </div>

</div>

<!-- latest activity end -->
--}}
    </div>
@endsection

@section('page_script')
    <script>
        function showMaterialWeightage() {

            var latest_from = $('#latest_from').val();

            var latest_to = $('#latest_to').val();

            var route = "{{ route('materialwisestats') }}";

            var data_set = {
                from: latest_from,
                to: latest_to
            };

            $.get(route, data_set, function(data) {

                $('#material_weightage').html(data.transaction_view);
                // $('#monthly_material_weightage').html(data.monthly_view);
            });
        }

        $(document).ready(function() {

            showMaterialWeightage();

            showDashboardStats(true);

        });

        function showDashboardStats(flag = false) {

            var latest_from = $('#latest_from').val();

            var latest_to = $('#latest_to').val();


            var route = "{{ route('latestdashboardstats') }}";

            var data_set = {
                from: latest_from,
                to: latest_to
            };

            addThemeLoader();

            $.get(route, data_set, function(data) {

                $('.total_clients').html(data.total_clients);
                $('.tickets').html(data.total_tickets);
                $('.inbound').html(data.inbound_count);
                $('.outbound').html(data.outbound_count);

                $('#latest_transactions').html(data.latest_transactions);

                removeThemeLoader();


            });

        }

        // Replace 'YOUR_API_KEY' with your OpenWeatherMap API key
        // const apiKey = '204c22e7b8680f3836006973fc31a2f1';
        // const apiUrl = `https://api.openweathermap.org/data/2.5/forecast?q=RAWALPINDI&units=metric&cnt=7&appid=${apiKey}`;

        // function displayWeatherData(data) {
        //     const weatherWidget = document.getElementById('weather-widget');
        //     weatherWidget.innerHTML = ''; // Clear previous content

        //     data.list.forEach(item => {

        //         const date = new Date(item.dt * 1000);

        //         const day = date.toLocaleDateString('en-US', { weekday: 'long' });

        //         const temp = Math.round(item.main.temp);
        //         const description = item.weather[0].description;

        //         const card = document.createElement('div');
        //         card.classList.add('card', 'mb-2');

        //         const cardBody = document.createElement('div');
        //         cardBody.classList.add('card-body');

        //         const cardTitle = document.createElement('h6');
        //         cardTitle.classList.add('card-title');
        //         cardTitle.textContent = `${day}: ${temp}°C, ${description}`;

        //         cardBody.appendChild(cardTitle);
        //         card.appendChild(cardBody);
        //         weatherWidget.appendChild(card);
        //     });
        // }

        // // Fetch weather data and display it
        // fetch(apiUrl)
        //     .then(response => response.json())
        //     .then(data => {
        //         displayWeatherData(data);
        //     })
        //     .catch(error => {
        //         console.error('Error fetching weather data:', error);
        //     });


        // $(document).ready(function() {
        //     var key = "204c22e7b8680f3836006973fc31a2f1";
        //     var city = "RAWALPINDI";
        //     var url = "https://api.openweathermap.org/data/2.5/forecast";
        //     $.ajax({
        //         url: url, //API Call
        //         dataType: "json",
        //         type: "GET",
        //         data: {
        //             q: city,
        //             appid: key,
        //             units: "metric",
        //             cnt: "42"
        //         },
        //         success: function(data) {
        //             const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        //             const timesToDisplay = [0, 8, 16, 24, 32, 40];
        //             let d;
        //             let dayName;
        //             var wf = "";
        //             wf += "<h2>" + data.city.name + "</h2>"; // City (displays once)
        //             // alert(data.list)
        //             $.each(data.list, function(index, val) {
        //               if(timesToDisplay.includes(index)){


        //                 d = new Date(data.list[index].dt * 1000);
        //                 dayName = days[d.getDay()];
        //                 wf += "<p>" // Opening paragraph tag
        //                 wf += "<b> "+dayName+"</b>: " // Day
        //                 wf += val.main.temp + "&degC" // Temperature
        //                 wf += "<span> " + val.weather[0].description + "</span>"; // Description
        //                 wf += "<img src='https://openweathermap.org/img/w/" + val.weather[0].icon + ".png'>" // Icon
        //                 wf += "</p>" // Closing paragraph tag
        //               }
        //             });
        //             $("#showWeatherForcast").html(wf);
        //         }
        //     });
        // });
        $(document).ready(function() {
            const monthNames = ["January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            let dateObj = new Date();
            let month = monthNames[dateObj.getUTCMonth()];
            let day = dateObj.getUTCDate() - 1;
            let year = dateObj.getUTCFullYear();

            let newdate = `${month} ${day}, ${year}`;

            const app = document.querySelector('.showWeatherForcast');

            fetch(
                    'https://api.openweathermap.org/data/2.5/weather?q=Ontario,ca&APPID=2d48b1d7080d09ea964e645ccd1ec93f&units=metric')
                .then(response => response.json())
                .then(data => {
                    console.log(data)

                    app.insertAdjacentHTML('afterbegin', `
        
    <div class="titlebar">
    <p class="date">${newdate}</p>
    <h4 class="city">${data.name}</h4>
    <p class="description">${data.weather[0].description}</p>
</div>
<div class="temperature">
    <img src="http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" />
    <h2>${Math.round(data.main.temp)}°C</h2>
</div>
<div class="extra">
    <div class="col">
        <div class="info">
            <h5>Wind Status</h5>
            <p>${data.wind.speed}mps</p>
        </div>
        <div class="info">
            <h5>Visibility</h5>
            <p>${data.visibility} m</p>
        </div>
    </div>
    
    <div class="col">
        <div class="info">
            <h5>Humidity</h5>
            <p>${data.main.humidity}%</p>
        </div>
        <div class="info">
            <h5>Air pressure</h5>
            <p>${data.main.pressure} mph</p>
        </div>
    </div>
</div>
`)
// Fetch 5-day weather forecast data
fetch('https://api.openweathermap.org/data/2.5/forecast?q=Ontario,ca&APPID=2d48b1d7080d09ea964e645ccd1ec93f&units=metric')
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const days = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
                    const timesToDisplay = [0, 8, 16, 24, 32, 40];
        //             let d;
                    let dayName;
        //             var wf = "";
        //             wf += "<h2>" + data.city.name + "</h2>"; // City (displays once)
        //             // alert(data.list)
        let nextFiveDaysHTML = '<div class="dataweather"><div class="table">';

                    $.each(data.list, function(index, val) {
                      if(timesToDisplay.includes(index)){
                        d = new Date(data.list[index].dt * 1000);
                        dayName = days[d.getDay()];

                        // Add the daily forecast to the HTML
                        nextFiveDaysHTML += `
                            <div class="tempday">
                                <p>${dayName}</p>
                                <div class="box">
                                    <p>${val.main.temp}°C</p>
                                    <img src="http://openweathermap.org/img/wn/${val.weather[0].icon}.png" />
                                </div>
                            </div>
                        `;


        //                 d = new Date(data.list[index].dt * 1000);
        //                 dayName = days[d.getDay()];
        //                 wf += "<p>" // Opening paragraph tag
        //                 wf += "<b> "+dayName+"</b>: " // Day
        //                 wf += val.main.temp + "&degC" // Temperature
        //                 wf += "<span> " + val.weather[0].description + "</span>"; // Description
        //                 wf += "<img src='https://openweathermap.org/img/w/" + val.weather[0].icon + ".png'>" // Icon
        //                 wf += "</p>" // Closing paragraph tag
                      }
                    });

                    // // Extract the next five days' forecast data
                    // const dailyForecasts = data.list.slice(0, 5);

                    // // Initialize HTML for the next five days

                    // // Loop through each day's forecast and update the HTML
                    // dailyForecasts.forEach((forecast, index) => {
                    //     // Extract the date, temperature, and weather icon
                    //     const forecastDate = new Date(forecast.dt * 1000);
                    //     const dayOfWeek = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"][forecastDate.getUTCDay()];
                    //     const temperature = Math.round(forecast.main.temp);
                    //     const iconCode = forecast.weather[0].icon;

                    //     // Add the daily forecast to the HTML
                    //     nextFiveDaysHTML += `
                    //         <div class="tempday">
                    //             <p>${dayOfWeek}</p>
                    //             <div class="box">
                    //                 <i class="fas fa-wind"></i>
                    //                 <p>${temperature}°C</p>
                    //                 <img src="http://openweathermap.org/img/wn/${iconCode}.png" />
                    //             </div>
                    //         </div>
                    //     `;
                    // });

                    // Close the HTML for the next five days
                    nextFiveDaysHTML += '</div></div>';

                    // Insert the next five days' forecast HTML into the document
                    app.insertAdjacentHTML('beforeend', nextFiveDaysHTML);
                });

                });
        });
    </script>
@endsection

@extends('layouts.master')

@section('page_title')

Clients Management

@endsection
@section('page_breadcrumbs')

{{ Breadcrumbs::render('clients') }}

@endsection
@section('page_body')

  <!--profile cover start-->
  <div class="row">
    <div class="col-lg-12">
        <div class="tab-header card" style="border-radius: 10px;">
       
            <table class="table m-0">
                <tbody class=" p-2">
                    <tr>
                        <th scope="row">Full Name</th>
                        <td>{{$user->name}}</td>

                        <th scope="row">Email</th>
                        <td>{{$user->email}}</td>
                    </tr>
                 
                    <tr>
                        <th scope="row">Contact</th>
                        <td>{{$user->contact}}</td>

                        <th scope="row">Account Type</th>
                        <td>{{$user->client_group}}</td>
                    </tr>
                   
                </tbody>
            </table>
           
        </div>
    </div>
</div>
<!--profile cover end-->
<div class="row">
<div class="col-lg-12">
    <!-- tab header start -->
    <div class="tab-header card">
        <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#contacts" role="tab">User's Contacts</a>
                <div class="slide"></div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#accounts" role="tab">User's Accounts</a>
                <div class="slide"></div>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#fleet" role="tab">Fleet</a>
                <div class="slide"></div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#material_rates" role="tab">Material Rates</a>
                <div class="slide"></div>
            </li>
        </ul>
    </div>
    <!-- tab header end -->
    <!-- tab content start -->
    <div class="tab-content">
       <!-- tab pane contact start -->
       <div class="tab-pane active" id="contacts" role="tabpanel">
            <div class="row">
               
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- contact data table card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">Contacts</h5>
                                </div>
                                <div class="card-block contact-details">
                                    <div class="data_table_main table-responsive dt-responsive">
                                        <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                <th>#</th>

                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact No.</th>
                                                    <th>Accounts</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($contact_list as $rows)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>

                                                    <td>{{$rows->name}}</td>
                                                    <td>{{$rows->email}}</td>
                                                    <td>{{$rows->contact}}</td>
                                                    <td>{{implode(', ',$rows->userAccounts->pluck('account.account_no')->toArray())}}</td>
                                                    <td><i class="fa fa-star" aria-hidden="true"></i> {{$rows->status}}</td>
                                                
                                                </tr>
                                                @endforeach
                                           
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- contact data table card end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tab pane contact end -->
        <!-- tab pane info start -->
        <div class="tab-pane " id="accounts" role="tabpanel">
            <!-- info card start -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- contact data table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Accounts</h5>
                        </div>
                        <div class="card-block contact-details">
                            <div class="data_table_main table-responsive dt-responsive">
                                <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                        <th>#</th>

                                            <th>Title</th>
                                            <th>Account No</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($account_list as $rows)
                                        <tr>
                                        <td>{{$loop->iteration}}</td>

                                            <td>{{$rows->title}}</td>
                                            <td>{{$rows->account_no}}</td>
                                            <td><i class="fa fa-star" aria-hidden="true"></i> {{$rows->status}}</td>
                                        
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- contact data table card end -->
                </div>
            </div>
            <!-- info card end -->
        </div>
        <!-- tab pane info end -->
     
        <div class="tab-pane" id="fleet" role="tabpanel">
            <div class="row">
                <div class="col-xl-12">
                    <!-- contact data table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Fleet</h5>
                        </div>
                        <div class="card-block contact-details">
                            <div class="data_table_main table-responsive dt-responsive">
                                <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Plate No</th>
                                    <th>VIN No</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Tare Weight</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trucks_list as $rows)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$rows->plate_no}}</td>
                                    <td>{{$rows->vin_no}}</td>
                                    <td>{{$rows->model}}</td>
                                    <td>{{$rows->color}}</td>
                                    <td>{{$rows->tare_weight}}</td>
                                   
                                    </tr>
                                @endforeach
                                </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- contact data table card end -->
                </div>
            </div>
        </div>

        <div class="tab-pane" id="material_rates" role="tabpanel">
            <div class="row">
                <div class="col-xl-12">
                    <!-- contact data table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Material Rates</h5>
                        </div>
                        <div class="card-block contact-details">
                            <div class="data_table_main table-responsive dt-responsive">
                                <table id="simpletable" class="table  table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Material</th>
                                    <th>Account</th>
                                    <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($material_rates_list as $rows)
                                    <tr>
                                        
                                    <td>{{$loop->iteration}}</td>
                                    
                                    <td>{{$rows->materialType->name}}</td>
                                    <td>{{$rows->account->title}} - {{$rows->account->account_no}}</td>
                                    <td>{{$rows->rate}}</td>
                                    
                                    </tr>
                                @endforeach
                                </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- contact data table card end -->
                </div>
            </div>
        </div>
    </div>
    <!-- tab content end -->
</div>
</div>


@endsection

<div id="target_modal"></div>

@section('page_script')

<script>

  
    
</script>
@endsection
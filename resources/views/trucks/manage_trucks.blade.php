@extends('layouts.master')

@section('page_title')

Trucks Management

@endsection

@section('page_script')

<style>

ul .ui-menu .ui-widget .ui-widget-content .ui-autocomplete .ui-front{
    width: auto !important;
    background-color: #eaeaf2 !important;

}

.custom-autocomplete-list {
    /* Add your custom styles here */
    /* For example: */
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    list-style: none;
    padding: 0;
    width: 25% !important;
    z-index: 2000;

  }

  .custom-autocomplete-list li {
    /* Add your custom styles for each list item here */
    /* For example: */
    padding: 5px;
    cursor: pointer;
  }

  .custom-autocomplete-list li:hover {
    background-color: #ddd;
  }

</style>

@endsection('page_script')

@section('page_breadcrumbs')

{{ Breadcrumbs::render('trucks') }}

@endsection



@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-uppercase">All Fleet


                  @if(Auth::user()->hasAnyPermission(['All']))
            
                  <a onclick="formModal(event,'{{route('import.trucks')}}','#md_import_trucks','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase" style="float: right;">
                  Import Trucks</a>
                  @endif

                    @if(Auth::user()->hasAnyPermission(['All','Add Truck']))
            
                    <a onclick="formModal(event,'{{route('store.truck')}}','#modal_add_truck','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase mr-2" style="float: right;">
                    Add Truck</a>
                    @endif

                    @if(Auth::user()->hasAnyPermission(['All','Truck Assignment']))
            
                    <a onclick="formModal(event,'{{route('trucks.assignment')}}','#modal_truck_asignment','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase mr-2" style="float: right;">
                    Truck Assignment</a>

                    @endif

                </h3>


              
              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap truck_table text-uppercase">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Client</th>
                      <th>Plate No</th>
                      <th>VIN No</th>
                      <th>Model</th>
                      <th>Color</th>
                      <th>Tare Weight</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($trucks_list as $rows)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rows->user->name}}</td>

                      <td>{{$rows->truck->plate_no}}</td>
                      <td>{{$rows->truck->vin_no}}</td>
                      <td>{{$rows->truck->model}}</td>
                      <td>{{$rows->truck->color}}</td>
                      <td>{{$rows->truck->tare_weight}}</td>
                      <td>

                      <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                              <i class="fa fa-list"></i>

                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                @if(Auth::user()->hasAnyPermission(['All','Update Fleet']))

            
                                <a class="dropdown-item waves-light waves-effect"  onclick="formModal(event,'{{route('update.truck',['id' => encrypt($rows->truck->id)])}}','#modal_update_truck','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
                            @endif

                                </li>
                             
                            </ul>
                        </div>
                 
                      </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

@endsection

<div id="target_modal"></div>
@section('page_modal')

@endsection
@section('page_script')

@endsection
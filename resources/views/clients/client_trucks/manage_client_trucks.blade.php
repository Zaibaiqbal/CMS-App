@extends('layouts.client_master')

@section('page_title')

Trucks Management

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('trucks') }}

@endsection

@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-uppercase">All Fleet

                  <a onclick="formModal(event,'{{route('store.clienttruck')}}','#modal_add_truck','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase" style="float: right;">
                Add Truck  
                </a>
                </h3>

              
              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap truck_table text-uppercase">
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
{{--

                      <td>
                      <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v text-dark"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                @if(Auth::user()->hasAnyPermission(['All','Update Fleet']))

            
                                <a class="dropdown-item waves-light waves-effect"  onclick="formModal(event,'{{route('update.truck',['id' => encrypt($rows->id)])}}','#modal_update_truck','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
                            @endif

                                </li>
                             
                            </ul>
                        </div>
                      </td>
                      --}}

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
@extends('layouts.master')

@section('page_title')

Material Rates Management

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('material_types') }}

@endsection


@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">

            <div class="card-header">
                <h3 class="card-title">All Material Rates

                @if(Auth::user()->hasAnyPermission(['All','Add Material Rate']))
          
                <a data-toggle="modal"  data-target="#modal_add_material_rate" class="btn btn-primary text-white font-weight-bolder" style="float: right;">
                Add Material Rate</a>
                @endif
                    <!--end::Button-->
                    </h3>
            </div>

              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Material</th>
                      <th>Client</th>
                      <th>Rate</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($material_rate_list as $rows)
                    <tr>
                        
                      <td>{{$loop->iteration}}</td>
                     
                      <td>{{$rows->materialType->name}}</td>
                      <td>{{$rows->client->name}}</td>
                      <td>{{$rows->rate}}</td>
                      <td>

                        <div class="dropdown-primary dropdown">
                                <div class="" data-toggle="dropdown">
                                <i class="fa fa-ellipsis-v text-dark"></i>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                    @if(Auth::user()->hasAnyPermission(['All','Update Material Rate']))
                
                                    <a class="dropdown-item waves-light waves-effect"  href="#" onclick="formModal(event,'{{route('update.materialrate',['id' => encrypt($rows->id)])}}','#modal_update_material_rate','#target_modal')" ><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
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
@include('material_types.modals.add_material_rate')

@endsection

@section('page_script')

@endsection
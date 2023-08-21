@extends('layouts.master')

@section('page_title')

Locations Management

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('locations') }}

@endsection

@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-uppercase">All Locations

                    @if(Auth::user()->hasAnyPermission(['All','Add Category']))
                
                    <a onclick="formModal(event,'{{route('store.category')}}','#modal_add_category','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase" style="float: right;margin-left:5px;">
                    Add Category</a>
                    @endif

                    @if(Auth::user()->hasAnyPermission(['All','Add Location']))
            
                    <a onclick="formModal(event,'{{route('store.location')}}','#modal_add_location','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase" style="float: right;">
                    Add Location</a>
                    @endif
                </h3>

              
              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table class="table table-striped table-bordered nowrap truck_table text-uppercase">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Category</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Contact</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($location_list as $rows)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rows->category->name}}</td>
                      <td>{{$rows->name}}</td>
                      <td>{{$rows->address}}</td>
                      <td>{{$rows->contact}}</td>
                      <td>

                   
                 
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
@extends('layouts.master')

@section('page_title')

Roles & Permissions Management

@endsection
@section('page_stle')

<style>

.dark-modal-background {
            background-color: #4A5A77 !important;
    }
</style>
@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('roles_and_permissions') }}

@endsection


@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-uppercase">All Roles

                    @if(Auth::user()->hasAnyPermission(['All','Add Role']))
                    
                    <a data-toggle="modal" data-target="#modal_add_role" class="btn btn-primary text-white font-weight-bolder text-uppercase" style="float: right;">
                    Add Role</a>
                    @endif

                </h3>

              
              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap text-uppercase">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      {{--<th>Created By</th>--}}
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($role_list as $rows)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rows->name}}</td>
                     {{-- <td>{{$rows->addedBy->name}}</td>--}}
                      <td>{{$rows->created_at}}</td>
                      <td>

                        <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-list"></i>

                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li class="">
                                @if(Auth::user()->hasAnyPermission(['All','Update Role']))
            
                                <a href="" class="dropdown-item waves-light waves-effect"  onclick="formModal(event,'{{route('update.role',['id' => encrypt($rows->id)])}}','#modal_update_role','#target_modal')" class="dropdown-item text-dark py-2"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
                                @endif

                                </li>

                                <li>
                                @if(Auth::user()->hasAnyPermission(['All','Assign Permissions']))

            
                                <a href="" class="dropdown-item waves-light waves-effect"   onclick="formModal(event,'{{route('assign.permissions',['id' => encrypt($rows->id)])}}','#modal_assign_permissions','#target_modal')" class="dropdown-item text-dark py-2"><i class="dropdown-icon fa fa-file "></i>&nbsp;&nbsp;&nbsp;Assign Permissions</a>

                                @endif

                                </li>
                             
                             
                            </ul>
                        </div>
                       
                        </td>
                        </div>
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


@include('roles_and_permissions.modals.add_role')

@endsection

@section('page_script')

@include('roles_and_permissions.scripts.roles_permissions_script')


@endsection
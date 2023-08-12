@extends('layouts.master')

@section('page_title')

Employees Management

@endsection
@section('page_breadcrumbs')

{{ Breadcrumbs::render('employees') }}

@endsection
@section('page_body')


<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employees List   
                    @if(Auth::user()->hasAnyPermission(['All','Add Employee']))
          
                    <a onclick="formModal(event,'{{route('store.employee')}}','#modal_add_employee','#target_modal')" class="btn btn-primary text-white font-weight-bolder" style="float: right;">
                    Create Employee</a>
                    @endif
                </h3>

             
              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
             
                <table id="table_datatable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Role</th>
                      <th>Email</th>
                      <th>Contact</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user_list as $rows)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rows->name}}</td>
                      <td>{{implode(',',$rows->userRoles->pluck('name')->toArray())}}</td>
                      <td>{{$rows->email}}</td>
                      <td>{{$rows->contact}}</td>
                      <td>

                        <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v text-dark"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu p-1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                
                                <li>
                                @if(Auth::user()->hasAnyPermission(['All','Update Employee']))
            
                                <a class="dropdown-item waves-light waves-effect"  href="#" onclick="formModal(event,'{{route('update.employee',['id' => encrypt($rows->id)])}}','#modal_update_employee','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
                                @endif

                                </li>
                                <li>

                                @if(Auth::user()->hasAnyPermission(['All','Assign Role']))
                                <a class="dropdown-item waves-light waves-effect"  href="#" onclick="formModal(event,'{{route('assign.roles',['id' => encrypt($rows->id)])}}','#modal_assign_role','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-file "></i>&nbsp;&nbsp;&nbsp;Assign Role</a>

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
@section('page_script')

@endsection
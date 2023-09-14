@extends('layouts.master')

@section('page_title')

Accounts Management

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('accounts') }}

@endsection

@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-uppercase">Accounts List

                @if(Auth::user()->hasAnyPermission(['All','Add Account']))
          
                    <a onclick="formModal(event,'{{route('store.account')}}','#modal_add_account','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase" style="float: right;">
                        Add Account</a>
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
                      <th>Title</th>
                      <th>Account No</th>
                      <th>Status</th>
                     
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($accounts_list as $rows)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rows->title}}</td>
                      <td>{{$rows->account_no}}</td>
                      <td>{{$rows->status}}</td>
                      <td>

                        <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-list"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                  @if(Auth::user()->hasAnyPermission(['All','Update Account']))
                                    @if($rows->approval_status == "Unapproved" && $rows->status == "Inactive")
                
                                    <a href="{{route('updateaccountstatus',['id' => $rows->id , 'approval_status' => 'Approved', 'status' => 'Active'])}}" onclick="formSubmission(event,this)" class="dropdown-item waves-light waves-effect py-2 class_delete"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Approve</a>
                                    @endif

                                    @if($rows->approval_status == "Approved" && $rows->status == "Active")
                
                                      <a href="{{route('updateaccountstatus',['id' => $rows->id , 'approval_status' => 'Approved', 'status' => 'Active'])}}" onclick="formSubmission(event,this)" class="dropdown-item waves-light waves-effect py-2 class_delete"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Deactivate</a>
                                    @endif
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
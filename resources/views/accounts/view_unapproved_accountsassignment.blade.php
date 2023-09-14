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
                <h3 class="card-title">Accounts List

                @if(Auth::user()->hasAnyPermission(['All','Add Account']))
          
                    <a onclick="formModal(event,'{{route('store.account')}}','#modal_add_account','#target_modal')" class="btn btn-primary text-white font-weight-bolder" style="float: right;">
                        Add Account</a>
                    @endif

                </h3>

              
              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Client Group</th>
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
                      <td>{{$rows->client_group}}</td>
                      <td>{{$rows->title}}</td>
                      <td>{{$rows->account_no}}</td>
                      <td>{{$rows->status}}</td>
                      <td>

                        <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v text-dark"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                @if(Auth::user()->hasAnyPermission(['All','Update Account']))
            
                                <a href="{{route('updateaccountstatus',['id' => $rows->id , 'approval_status' => 'Approved', 'status' => 'Active'])}}" onclick="formSubmission(event,this)" class="dropdown-item waves-light waves-effect text-dark py-2 class_delete"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Approve</a>
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
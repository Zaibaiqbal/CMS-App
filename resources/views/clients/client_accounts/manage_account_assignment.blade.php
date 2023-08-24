@extends('layouts.client_master')

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
                <h3 class="card-title text-uppercase">All Account Assignment

          
                    <a onclick="formModal(event,'{{route('assign.account')}}','#modal_assign_account','#target_modal')" class="btn btn-primary text-white font-weight-bolder text-uppercase" style="float: right;">
                        Assign Account</a>
               
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
                      <th>Client Group</th>
                      <th>Account No</th>
                      <th>Status</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($accounts_list as $rows)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rows->title}}</td>
                      <td>{{$rows->client_group}}</td>
                      <td>{{$rows->account_no}}</td>
                      <td>{{$rows->status}}</td>
                      {{--
                      <td>

                        <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v text-dark"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                @if(false && Auth::user()->hasAnyPermission(['All','Update Account']))
            
                                <a class="dropdown-item waves-light waves-effect"  onclick="formModal(event,'{{route('update.account',['id' => encrypt($rows->id)])}}','#modal_update_truck','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
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
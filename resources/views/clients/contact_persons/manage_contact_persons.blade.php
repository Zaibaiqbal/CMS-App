@extends('layouts.client_master')

@section('page_title')

Contact Persons Management

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('accounts') }}

@endsection

@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Contact Persons List


                </h3>
            
                <a onclick="formModal(event,'{{route('request.contactperson')}}','#modal_request_contact_person','#target_modal')" class="btn btn-primary text-white font-weight-bolder" style="float: right;">
                         Request to Add Contact Person</a>
              
              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Contact</th>
                      <th>Account No</th>
                      <th>Status</th>
                      <th>Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user_list->where('user_id','!=',Auth::user()->id) as $rows)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$rows->user->name}}</td>
                      <td>{{$rows->user->contact}}</td>
                      <td>{{$rows->account->account_no}}</td>
                      <td>{{$rows->user->status}}</td>
                      <td>

                        <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v text-dark"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>

                              @php($route = route('deactive.user',['id' => encrypt($rows->user->id)]))
                              <a href="{{$route}}" onclick="formSubmission(event)"  class="dropdown-item waves-light waves-effect deactive_submit" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-file "></i>&nbsp;&nbsp;&nbsp;Request to Deactive</a>

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
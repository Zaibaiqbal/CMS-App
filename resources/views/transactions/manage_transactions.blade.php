@extends('layouts.master')

@section('page_title')

Transaction Management

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('transactions') }}

@endsection

@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-uppercase">All Transactions

                @if(Auth::user()->hasAnyPermission(['All','Create Transaction']))
          
                    <a href="{{route('store.transaction')}}" class="btn btn-primary text-upperccase text-white font-weight-bolder text-uppercase" style="float: right;">
                    New</a>
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
                          <th>Client</th>
                          <th>Account</th>
                          <th>License No</th>
                          <th>Material</th>
                          <th>Gross weight</th>
                          <th>Tare weight</th>
                          <th>Net weight</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction_list as $rows)
                        <tr @if($rows->status == "Queued") style="background-color:#fc847b;" @endif>
                        
                        <td>{{$loop->iteration}}</td>
                        <td>{{$rows->client_name}}</td>

                        <td>{{$rows->userAccount->account->account_no}}</td>
                        <td>{{$rows->plate_no}}</td>
                        <td>{{$rows->materialType->name}}</td>
                        <td>{{$rows->gross_weight}}</td>
                        <td>{{$rows->tare_weight}}</td>
                        <td>{{$rows->net_weight}}</td>
                        <td>{{$rows->status}}</td>
                        <td>
                        <div class="item-action dropdown">
                          <a class="icon" data-toggle="dropdown" ><i class="fa fa-list"></i></a>
                          
                          <div class="dropdown-menu pull-right  p-2 ">
                              @if($rows->status == "Queued")
                              @if(Auth::user()->hasAnyPermission(['All','Process Transaction']))

                              <a href="#" target="_blank" onclick="formModal(event,'{{route('process.transaction',['id' => encrypt($rows->id)])}}','#modal_process_transaction','#target_modal')" class="dropdown-item py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Process</a>
                              @endif
                              <div class="dropdown-divider"></div>

                              @endif

                              @if(Auth::user()->hasRole(['Super Admin','Employee']) && Auth::user()->hasAnyPermission(['All','Update Transaction']))

                              <a href="#" target="_blank" onclick="formModal(event,'{{route('update.transaction',['id' => encrypt($rows->id)])}}','#modal_update_transaction','#target_modal')" class="dropdown-item py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
                              <div class="dropdown-divider"></div>

                              @endif
                              @if(Auth::user()->hasRole(['Super Admin','Employee']) && Auth::user()->hasAnyPermission(['All','Update Transaction']))

                              <a href="#" target="_blank" onclick="formModal(event,'{{route('update.transaction',['id' => encrypt($rows->id)])}}','#modal_update_transaction','#target_modal')" class="dropdown-item py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Void</a>
                              <div class="dropdown-divider"></div>

                              @endif

                              @if($rows->status == 'Processed' && Auth::user()->hasAnyPermission(['All','Print Ticket']))


                              <a href="{{route('transaction.invoice',['transaction' => ($rows->id),'pdf' => 'true'])}}" target="_blank" class="dropdown-item py-0"><i class="dropdown-icon fa fa-file "></i>&nbsp;&nbsp;&nbsp; Print</a>
                              @endif
                          
                          </div>
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
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
                <h3 class="card-title">All Transactions

                @if(Auth::user()->hasAnyPermission(['All','Create Transaction']))
          
                    <a href="{{route('store.transaction')}}" class="btn btn-primary text-white font-weight-bolder" style="float: right;">
                    Create Transaction</a>
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
                          <th>Client</th>
                          <th>Plate No</th>
                          <th>Material Type</th>
                          <th>Gross weight</th>
                          <th>Tare weight</th>
                          <th>Net weight</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction_list as $rows)
                        <tr @if($rows->status == "Open") style="background-color:#fc847b;" @endif>
                        
                        <td>{{$loop->iteration}}</td>
                        <td>{{$rows->client_name}}</td>
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
                              @if(Auth::user()->hasAnyPermission(['All','Update Transaction']))

                              <a href="#" onclick="formModal(event,'{{route('update.transaction',['id' => encrypt($rows->id)])}}','#modal_update_transaction','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
                              @endif
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
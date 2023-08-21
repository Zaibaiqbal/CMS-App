@extends('layouts.client_master')

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

                </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>License No</th>
                          <th>Material Type</th>
                          <th>Gross weight</th>
                          <th>Tare weight</th>
                          <th>Net weight</th>
                          <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction_list as $rows)
                        <tr>
                        
                        <td>{{$loop->iteration}}</td>
                        <td>{{$rows->client->name}}</td>
                        <td>{{$rows->plate_no}}</td>
                        <td>{{$rows->materialType->name}}</td>
                        <td>{{$rows->gross_weight}}</td>
                        <td>{{$rows->tare_weight}}</td>
                        <td>{{$rows->net_weight}}</td>
                        <td>@if($rows->status == "Queued") In-Progress @else Completed @endif</td>
                       
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
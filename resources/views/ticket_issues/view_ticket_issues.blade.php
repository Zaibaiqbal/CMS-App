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
                <h3 class="card-title text-uppercase">All Ticket Issues
                </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap text-uppercase">
                    <thead>
                      <tr>
                          <th>#</th>
                          <th>Ticket No</th>
                          <th>Issue</th>
                         
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($ticket_issue_list as $rows)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rows->ticket_number}}</td>
                            <td>{{$rows->issue}}</td>
                            <td>{{$rows->status}}</td>
                            <td></td>

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
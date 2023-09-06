@extends('layouts.master')

@section('page_title')

Material Rates Management

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('material_types') }}

@endsection


@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">

            <div class="card-header">
                <h3 class="card-title">ALL RATE SLABS

              
                    <!--end::Button-->
                    </h3>
            </div>

              <!-- /.card-header -->
              <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap text-uppercase">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Start Weight</th>
                      <th>End Weight</th>
                      <th>Rate</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($rate_list as $rows)
                    <tr>
                        
                      <td>{{$loop->iteration}}</td>
                     
                      <td>{{$rows->start_weight}}kg</td>
                      <td>{{$rows->end_weight}}kg</td>
                      <td>{{$rows->rate}}</td>
                    
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
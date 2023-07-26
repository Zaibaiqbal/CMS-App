@extends('layouts.master')

@section('page_body')

<div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Transactions List

                @if(Auth::user()->hasAnyPermission(['All','Add Truck']))
          
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
                      <th>Truck No</th>
                      <th>Material Type</th>
                      <th>Operation Type</th>
                      <th>Gross weight</th>
                      <th>Tare weight</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transactions_list as $rows)
                    <tr>
                        
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>
                        <div class="dropdown-primary dropdown">
                            <div class="" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v text-dark"></i>
                            </div>
                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li>
                                @if(Auth::user()->hasAnyPermission(['All','Update Truck']))
            
                                <a class="dropdown-item waves-light waves-effect"  onclick="formModal(event,'{{route('update.truck',['id' => encrypt($rows->id)])}}','#modal_update_truck','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
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
@include('trucks.modals.add_truck')

@endsection
@section('page_script')

@endsection
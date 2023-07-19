@extends('layouts.master')

@section('page_body')

<div class="row">
    <div class="col-7">
    <div class="card p-2">
        <div class="card-header">
        <h3 class="card-title">Transaction</h3>

        <div class="card-toolbar">
              
        </div>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          @include('transactions.components.add_transaction')

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>


    <div class="col-5">
    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Current Transactions</h3>

        <div class="card-toolbar">
              
            
        </div>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
        @include('transactions.components.view_transactions')
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
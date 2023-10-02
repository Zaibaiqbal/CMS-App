@extends('layouts.master')

@section('page_title')

Create Transaction

@endsection
@section('page_style')

<style>

ul .ui-menu .ui-widget .ui-widget-content .ui-autocomplete .ui-front{
    width: auto !important;
    background-color: #eaeaf2 !important;

}

.custom-autocomplete-list {
    /* Add your custom styles here */
    /* For example: */
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    list-style: none;
    padding: 0;
    width: 20% !important;
    height: 200px;
    z-index: 1000;
    overflow: scroll;
  }

  .custom-autocomplete-list li {
    /* Add your custom styles for each list item here */
    /* For example: */
    padding: 5px;
    cursor: pointer;
  }

  .custom-autocomplete-list li:hover {
    background-color: #ddd;
  }

</style>
@endsection
@section('page_breadcrumbs')

{{ Breadcrumbs::render('create_transaction') }}

@endsection


@section('page_body')
@php
    $path = 'theme';
    $change_view = null;
    $change_view = (session()->get('change_view')) ? session()->get('change_view') :  'false'
@endphp
<div class="row">
    <div class="col-sm-12 col-md-12">
    <div class="card">
        <div class="card-header p-2">
        <h3 class="card-title">ezWeigh</h3>

        <div class="card-toolbar">
              
        </div>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive pb-0">
          @include('transactions.components.add_transaction')

        </div>
     
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <div class="col-md-12">
        <a href="#" onclick="changeView(event)" class="btn btn-link float-right text-white ml-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md text-dark" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><rect x="4" y="4" width="6" height="6" rx="1"></rect><rect x="14" y="4" width="6" height="6" rx="1"></rect><rect x="4" y="14" width="6" height="6" rx="1"></rect><rect x="14" y="14" width="6" height="6" rx="1"></rect></svg>
        </a>
    </div>

    <div class="col-sm-12 col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title text-uppercase">QUEUED</h3>

          <div class="card-toolbar">
                
              
          </div>
        
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 table_view"  style="display: none;">
          @include('transactions.components.view_transactions')
        </div>

        <div class="card-body p-0 grid_view" >
          @include('transactions.components.view_transactions_grid_view')
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

@include('transactions.scripts.transaction_script')

<script>
    var change_view = '{{$change_view}}';

function changeView(event)
{
    event.preventDefault();

    if(change_view === 'false'){
        change_view = 'true';
    }
    else if(change_view === 'true'){
        change_view = 'false';
    }
addThemeLoader();


$.post( "{{route('tableview') }}", { "change_view": change_view, "_token": "{{ csrf_token() }}" },function(data){
    // success message.
    removeThemeLoader();
    if(data === 'true'){
      
      $('.table_view').show();
      $('.grid_view').hide();
  }
  else if(data === 'false'){
      $('.grid_view').show();
      $('.table_view').hide();
  }

} );

    if(change_view === 'true'){
      
        $('.table_view').show();
        $('.grid_view').hide();
    }
    else if(change_view === 'false'){
        $('.grid_view').show();
        $('.table_view').hide();
    }
    
}
</script>
@endsection
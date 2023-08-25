@extends('layouts.master')

@section('page_title')

Clients Management

@endsection
@section('page_breadcrumbs')

{{ Breadcrumbs::render('clients') }}

@endsection
@section('page_body')


<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ALL CLIENTS

                    <!--end::Button-->
                    </h3>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap text-uppercase">
                        <thead>
                            <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Account No</th>
                            <th>Email</th>
                            <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_list as $rows)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rows->name}}</td>
                            <td>{{implode(',',$rows->userAccounts->pluck('account.account_no')->toArray())}}</td>
                            <td>{{$rows->email}}</td>
                            <td>{{$rows->contact}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
        <!-- Zero config.table end -->
    
        
    </div>
</div>


@endsection



@section('page_script')

@endsection
@extends('layouts.master')

@section('page_body')


<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Clients List

                    @if(Auth::user()->hasAnyPermission(['All','Add Client']))
            
                        <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary text-white font-weight-bolder" style="float: right;">
                    Create User</a>
                    @endif
                    <!--end::Button-->
                    </h3>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Father Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_list as $rows)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rows->name}}</td>
                            <td>{{$rows->fname}}</td>
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
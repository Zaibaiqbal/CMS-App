@extends('layouts.master')

@section('page_title')

View Unapproved Clients

@endsection
@section('page_breadcrumbs')

{{ Breadcrumbs::render('unapproved_clients') }}

@endsection

@section('page_body')


<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employees Progress

                   
                    <!--end::Button-->
                    </h3>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table_datatable" class="table table-striped table-bordered nowrap text-uppercase">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_list as $rows)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rows->name}}</td>
                            <td>{{$rows->email}}</td>
                            <td>{{$rows->contact}}</td>
                            <td>
                                @if(Auth::user()->hasAnyPermission(['All']))
                                @php($route = route('printemployeeprogress',['id' => encrypt($rows->id) ,'date' => $date]))
                                <a href="{{$route}}" target="_blank" class="dropdown-item waves-light waves-effect" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-file "></i></a>

                                @endif
                                      
                                </div>

                            </td>
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

<div id="target_modal"></div>

@section('page_script')

<script>


</script>
@endsection
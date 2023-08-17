@extends('layouts.master')

@section('page_title')

All Contacts

@endsection
@section('page_breadcrumbs')

{{ Breadcrumbs::render('contact_persons') }}

@endsection

@section('page_body')


<div class="row">
    <div class="col-sm-12">
        <!-- Zero config.table start -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Contacts

                   
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
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user_list as $rows)
                            <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$rows->user->name}}</td>
                            <td>{{$rows->client->name}}</td>
                            <td>{{$rows->user->email}}</td>
                            <td>{{$rows->user->contact}}</td>
                            <td>
{{--
                                <div class="dropdown-primary dropdown">
                                    <div class="" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v text-dark"></i>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        
                                        <li>

                                        @if(Auth::user()->hasAnyPermission(['All','Approve Client']))
                                        @php($route = route('approve.cotactperson',['id' => encrypt($rows->id)]))
                                        <a href="#"  class="dropdown-item waves-light waves-effect delete_submit" onclick="formModal(event,'{{$route}}','#modal_approve_contact_person','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-file "></i>&nbsp;&nbsp;&nbsp;Approve</a>

                                        @endif
                                        </li>
                                    
                                    </ul>
                                </div>
                                --}}
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
@extends('layouts.master')

@section('page_title')

System Reports

@endsection

@section('page_breadcrumbs')

{{ Breadcrumbs::render('reports') }}

@endsection

@section('page_body')

<div class="row">
     <!-- task, page, download counter  start -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-yellow f-w-600">TOPPS</h4>
                        <h6 class="text-muted m-b-0">Daily Tonnage Report</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-bar-chart f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-yellow">
                <div class="row align-items-center">
                    <div class="col-9">
                        <a href="{{route('dailycustomerreport',['type' => 'TOPPS'])}}" target="_blank" class="btn btn-sm btn-outline-secondary text-white m-b-0"><i class="fa fa-eye">&nbsp;View</i></a>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-green f-w-600">GFL</h4>
                        <h6 class="text-muted m-b-0">Daily Tonnage Report</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-file-text f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-green">
                <div class="row align-items-center">
                    <div class="col-9">
                        <a href="{{route('dailycustomerreport',['type' => 'GFL'])}}" target="_blank" class="btn btn-sm btn-outline-secondary text-white m-b-0"><i class="fa fa-eye">&nbsp;View</i></a>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-pink f-w-600">TOPPS</h4>
                        <h6 class="text-muted m-b-0">Weekly Report</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-calendar f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-pink">
                <div class="row align-items-center">
                    <div class="col-9">
                        <a href="{{route('weeklycustomerreport',['type' => 'TOPPS'])}}" target="_blank" class="btn btn-sm btn-outline-secondary text-white m-b-0"><i class="fa fa-eye">&nbsp;View</i></a>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="text-c-blue f-w-600">Transactions</h4>
                        <h6 class="text-muted m-b-0">Client Group Report</h6>
                    </div>
                    <div class="col-4 text-right">
                        <i class="feather icon-download f-28"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-c-blue">
                <div class="row align-items-center">
                    <div class="col-9">
                        <a onclick="formModal(event,'{{route('clientgroupreport')}}','#md_client_group_report','#target_modal')" class="btn btn-sm btn-outline-secondary text-white m-b-0"><i class="fa fa-eye">&nbsp;View</i></a>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    
    <!-- task, page, download counter  end -->

</div>

@endsection

@section('page_modal')
<div id="target_modal"></div>

@endsection
@section('page_script')

@endsection
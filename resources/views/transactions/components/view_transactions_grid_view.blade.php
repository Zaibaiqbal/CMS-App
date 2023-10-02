<div class="row p-2">
    @foreach($transaction_list as $rows)
    <div class="col-xl-3 col-md-6">
        <div class="card" style="background-color: #e2e2e2;">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col-12">
                        <h5 class="text-c-yellow f-w-600">{{$rows->ticket_no}}</h5>
                        <h5 class="text-c-blue m-b-0">{{$rows->plate_no}}</h5>
                        <h5 class="text-secondary m-b-0">{{$rows->client_name}}</h5>
                        <p class="text-muted m-b-0">{{$rows->vehicle_desc}}</p>
                    </div>
                    
                </div>
            </div>

            <div class="card-footer bg-c-yellow">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h6> <b>In Time:</b> {{date_format($rows->created_at,'Y-m-d H:i')}}</h6>
                    </div>
                    <div class="col-3">
                        @if(Auth::user()->hasAnyPermission(['All','Process Transaction']))

                        <a href="#" style="float: right;" onclick="formModal(event,'{{route('process.transaction',['id' => encrypt($rows->id)])}}','#modal_process_transaction','#target_modal')" class="dropdown-icon text-dark mb-1"><i class="dropdown-icon fa fa-edit "></i></a>
                        @endif
                    </div>
                </div>

            </div>

   
         
        </div>
    </div>
    @endforeach
</div>
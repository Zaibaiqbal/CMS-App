<table class="table table-hover text-nowrap">
    <thead>
    <tr>
        <th>#</th>
        <th>Ticket No.</th>
        <th>Client</th>
        <th>Plate No</th>
        <th>Material Type</th>
        <th>Gross weight</th>
        <th>Tare weight</th>
        <th>Net weight</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
        @foreach($transaction_list as $rows)
        <tr>
        
        <td>{{$loop->iteration}}</td>
        <td>{{$rows->ticket_no}}</td>
        <td>{{$rows->client->name}}</td>
        <td>{{$rows->plate_no}}</td>
        <td>{{$rows->materialType->name}}</td>
        <td>{{$rows->gross_weight}}</td>
        <td>{{$rows->tare_weight}}</td>
        <td>{{$rows->net_weight}}</td>
        <td>
        <div class="item-action dropdown">
            <a class="icon" data-toggle="dropdown" ><i class="fa fa-list"></i></a>
            
            <div class="dropdown-menu pull-right">
                
            @if(Auth::user()->hasAnyPermission(['All','Update Transaction']))

            <a href="#" onclick="formModal(event,'{{route('update.transaction',['id' => encrypt($rows->id)])}}','#modal_update_transaction','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i>&nbsp;&nbsp;&nbsp; Update</a>
            @endif
            
            </div>
        </div>
        </td>
    </tr>

    @endforeach
    </tbody>
</table>
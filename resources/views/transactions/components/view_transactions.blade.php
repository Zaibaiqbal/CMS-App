<table class="table table-hover text-nowrap">
    <thead>
    <tr>
        <th>#</th>
        <th>License Plate No</th>
        <th>Description</th>
        <th>Client</th>
        <th>Ticket No.</th>

        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($transaction_list as $rows)
        <tr>
        
        <td>{{$loop->iteration}}</td>
        <td>{{$rows->plate_no}}</td>
        <td>{{$rows->vehicle_desc}}</td>
        <td>{{$rows->client_name}}</td>

        <td>{{$rows->ticket_no}}</td>
       
        <td>
        @if(Auth::user()->hasAnyPermission(['All','Update Transaction']))

        <a href="#" onclick="formModal(event,'{{route('update.transaction',['id' => encrypt($rows->id)])}}','#modal_update_transaction','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i></a>
        @endif
        </td>
    </tr>

    @endforeach
    </tbody>
</table>
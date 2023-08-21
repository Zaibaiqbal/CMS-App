<table class="table table-hover text-nowrap text-uppercase">
    <thead>
    <tr>
        <th>#</th>
        <th>License No</th>
        <th>Description</th>
        <th>Client</th>
        <th>Ticket No.</th>

        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($transaction_list as $rows)
        <tr>
       @php($ticket_no = $rows->ticket_no) 
       @php($parts = explode('-', $ticket_no)) 
       @php($parts[2] = '<b>' . $parts[2] . '</b>') 
       @php($modify_ticket = implode('-', $parts))

        <td>{{$loop->iteration}}</td>
        <td>{{$rows->plate_no}}</td>
        <td>{{$rows->vehicle_desc}}</td>
        <td>{{$rows->client_name}}</td>

        <td>{!! $modify_ticket !!}</td>
       
        <td>
        @if(Auth::user()->hasAnyPermission(['All','Update Transaction']))

        <a href="#" onclick="formModal(event,'{{route('update.transaction',['id' => encrypt($rows->id)])}}','#modal_update_transaction','#target_modal')" class="dropdown-item text-dark py-0"><i class="dropdown-icon fa fa-edit "></i></a>
        @endif
        </td>
    </tr>

    @endforeach
    </tbody>
</table>

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
    
    </tr>

    @endforeach
   
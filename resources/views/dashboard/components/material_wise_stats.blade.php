@foreach($material_wise_transaction_list as $rows)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$rows->name}}</td>
    <td>{{$rows->inbound_net_weight}}</td>
    <td>{{abs($rows->outbound_net_weight)}}</td>

</tr>

@endforeach
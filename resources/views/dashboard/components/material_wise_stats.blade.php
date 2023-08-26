@foreach($transaction_list as $rows)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$rows->name}}</td>
    <td>{{$rows->gross_weight}}</td>
    <td>{{$rows->tare_weight}}</td>

</tr>

@endforeach
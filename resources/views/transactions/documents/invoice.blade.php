

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>

<style type="text/css">
	
/* GENERAL CSS APPLY ALL SECTIONS*/
	.clear{

		clear: both;
	}

	input[type=text]{
		border-top: 0;
		border-right: 0;
		border-left: 0;
		border-bottom: 1px dotted black;
		font-size: 14px;
		text-align: center;
        background-color: transparent;
	}

.customer_info{
  font-size: 17px;
  font-weight: bold;
}

</style>
</head>

<body style="font-size:16px !important; margin-top:5%">
           

@if($format)    
        <div class="" style="">
            <form action="{{route('transaction.invoice')}}"  method="post">
                @csrf
                <input type="hidden" value="{{$transaction->id}}" name="transaction">
                <input type="hidden" value="pdf" name="format">
                <button style="margin-left: 96% !important;border:none;background-color:transparent;" type="submit" class="pdf" title="Generate PDF" name="pdf" value="pdf"><img src="{{asset('images/pdf-icon.png')}}" width="60%"></button>
            </form>
        </div>
        @endif

        <table style=" width:100%;">
        <tr>
          <td style="width: 30%;"><img src="logos/tes02.png"  width="20%"/></td>

          <td>
          <b style="font-size: 25px;margin-left:25%;">ezWeigh Summary</b>
        </td>
        <td></td>

        </tr>
        <tr>

          <td> <p >LaFleche, Div. Veckwith Transfer
          <br>
          6271 Cavanagh Road.
          <br>

          Carleton Place, Ontario K7C 0C4 </p></td>
        </tr>
        </table>
         

       <br>
       <br>

       <hr>

       <br>
 
        <table style=" width:100%; background:#eee;">
           
          <tr>
            <td class="customer_info">Invoice:</td>

            @php($ticket_no = $transaction->ticket_no) 
       @php($parts = explode('-', $ticket_no)) 
       @php($parts[2] = '<b>' . $parts[2] . '</b>') 
       @php($modify_ticket = implode('-', $parts))

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo html_entity_decode($modify_ticket); ?></td>

            <td class="customer_info">Invoice Date:</td>
            <td><input type="text" value="{{$transaction->updated_at}}"></td>
       
          </tr>

          <tr>
            <td class="customer_info">License No:</td>
            <td><input type="text" value="{{$transaction->plate_no}}"></td>

            <td class="customer_info">Job Id / PO No:</td>
            <td><input type="text" value="{{$transaction->job_id}}"></td>
          </tr>
          
          <tr>
          <td class="customer_info">Client:</td>
            <td><input type="text" value="{{$transaction->client_name}}"></td>

            <td class="customer_info">Driver Name:</td>
            <td><input type="text" value="{{$transaction->driver->name}}"></td>


          </tr>
         
          <tr>
        
            <td class="customer_info">Contact No:</td>
            <td><input type="text" value="{{$transaction->contact_no}}"></td>

            <td class="customer_info">In Time:</td>
            <td><input type="text" value="{{date_format($transaction->created_at,'Y-m-d H:m')}}"></td>
          </tr>
         
          <tr>
          <td class="customer_info"></td>
            <td></td>
            <td class="customer_info">Out Time:</td>
            <td><input type="text" value="{{date_format($transaction->updated_at,'Y-m-d H:m')}}"></td>
          </tr>
        </table>
       
        <br>

        <table border="1" style="border-collapse: collapse; text-align: center; width:100%; font-size: 12pt;">
           <thead>
            <tr>
                <th>Material</th>
                <th>Rate</th>
                <th>Gross Weight</th>
                <th>Tare Weight</th>
                <th>Net Weight</th>
                <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
          		<tr>
                    <td>{{$transaction->materialType->name}}</td>
                    <td>{{$transaction->material_rate}}</td>
                    <td>{{$transaction->gross_weight}}</td>
                    <td>{{$transaction->tare_weight}}</td>
                    <td>{{abs($transaction->net_weight)}}</td>
                    <td>{{abs($transaction->total_cost)}}</td>
                </tr>


                <tr style="font-weight: bold;">
                    <td colspan="1">Total:</td>
                    <td colspan=""></td>
                    <td>{{$transaction->gross_weight}}</td>
                    <td>{{$transaction->tare_weight}}</td>
                    <td>{{abs($transaction->net_weight)}}</td>
                    <td></td>

                </tr>

                
          </tbody>
           
         </table>


</body>

</html>
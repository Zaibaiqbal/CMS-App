

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
		font-size: 12px;
		text-align: center;
        background-color: transparent;
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
       <center>ezWeigh Summary</center>
       
       <br>

       <hr>

       <br>
 
        <table style=" width:100%; background:#eee;">
           
          <tr>
            <td>Invoice</td>

            @php($ticket_no = $transaction->ticket_no) 
       @php($parts = explode('-', $ticket_no)) 
       @php($parts[2] = '<b>' . $parts[2] . '</b>') 
       @php($modify_ticket = implode('-', $parts))

            <td><?php echo html_entity_decode($modify_ticket); ?></td>

            <td>Invoice Date:</td>
            <td><input type="text" value="{{$transaction->created_at}}"></td>
       
          </tr>

          <tr>
            <td>License No.</td>
            <td><input type="text" value="{{$transaction->plate_no}}"></td>

            <td>Job Id / PO No.</td>
            <td><input type="text" value="{{$transaction->job_id}}"></td>
          </tr>
          
          <tr>
          <td>Client:</td>
            <td><input type="text" value="{{$transaction->client_name}}"></td>


            <td>Contact No.</td>
            <td><input type="text" value="{{$transaction->contact_no}}"></td>

          </tr>
         
          <tr>
          <td>Driver Name:</td>
            <td><input type="text" value="{{$transaction->driver->name}}"></td>


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
            </tr>
          </thead>
          <tbody>
          		<tr>
                    <td>{{$transaction->materialType->name}}</td>
                    <td>{{$transaction->material_rate}}</td>
                    <td>{{$transaction->gross_weight}}</td>
                    <td>{{$transaction->tare_weight}}</td>
                    <td>{{$transaction->net_weight}}</td>
                </tr>


                <tr style="font-weight: bold;">
                    <td colspan="2">Total:</td>
                    <td>{{$transaction->gross_weight}}</td>
                    <td>{{$transaction->tare_weight}}</td>
                    <td>{{$transaction->net_weight}}</td>

                </tr>

                
          </tbody>
           
         </table>


</body>

</html>
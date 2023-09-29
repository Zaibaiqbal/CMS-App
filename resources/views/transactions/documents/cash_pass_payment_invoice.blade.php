

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
  font-size: 15px;
  font-weight: bold;
}

</style>
</head>

<body style="font-size:14px !important; margin-top:5%">
           

@if($format)    
        <div class="" style="">
            <form action="{{route('transaction.invoice')}}"  method="post">
                @csrf
                <input type="hidden" value="{{$transaction->id}}" name="transaction">
                <input type="hidden" value="pdf" name="format">
                <div style="">
                <a href="{{route('transactions.list')}}" style=""><img src="{{asset('images/back.png')}}" width="2%"></a>

                <button style="margin-left: 96% !important;border:none;background-color:transparent;" type="submit" class="pdf" title="Generate PDF" name="pdf" value="pdf"><img src="{{asset('images/pdf-icon.png')}}" width="60%"></button>

                </div>
               
            </form>
        </div>
        @endif

        <table style=" width:100%;">
          <tr>
             <td style="width: 100%;"> <center> <img src="logos/tes02.png"  width="10%"/></center></td>
          </tr>
          <tr>

            <td>
              <center>
                <p>Topps Environmental Solutions
                <br>
                Beckwith Transfer Site
                <br>
                9271 Cavanagh Road, Carleton Place, ON, K7C 0C5
                <br>
                613-257-1195 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bts@toppsenv.com
                </p>
              </center>
          </td>

          </tr>
    
        </table>
         
       <hr style="border-style: dotted;">

 
        <table style=" width:100%; background:#eee;">
           
          <tr>
            <td class="customer_info">Date:</td>
            <td><input type="text" value="{{date_format(now(),'Y-m-d H:i')}}"></td>
            <td class="customer_info">Transaction Id:</td>

            @php($ticket_no = $transaction->ticket_no) 
            @php($parts = explode('-', $ticket_no)) 
            @php($parts[2] = '<b>' . $parts[2] . '</b>') 
            @php($modify_ticket = implode('-', $parts))

            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo html_entity_decode($modify_ticket); ?></td>
          </tr>
          <tr>
      
            <td class="customer_info">In Time:</td>
            <td><input type="text" value="{{date_format($transaction->created_at,'Y-m-d H:i')}}"></td>

            <td class="customer_info">Out Time:</td>
            <td><input type="text" value="{{date_format($transaction->updated_at,'Y-m-d H:i')}}"></td>
          </tr>

        </table>

        <hr style="border-style: dotted;">
        <table style=" width:100%; background:#eee;">
          
 
           <tr>
             <td class="customer_info">License No:</td>
             <td><input type="text" value="{{$transaction->plate_no}}"></td>
 
             <td class="customer_info">Driver Name:</td>
             <td><input type="text" value="{{$transaction->driver->name}}"></td>
 
           </tr>
           
           <tr>
 
             <td class="customer_info">Account No.</td>
             <td><input type="text" value="{{$transaction->userAccount->account->account_no}}"></td>
 
             <td class="customer_info">Client:</td>
             <td><input type="text" value="{{$transaction->client_name}}"></td>
 
           </tr>
          
           <tr>
         
             <td class="customer_info">Contact No:</td>
             <td><input type="text" value="{{$transaction->contact_no}}"></td>
 
           </tr>
          
         </table>
         <hr style="border-style: dotted;">

         <div class="clear">
           <center> <h3>ezWeigh Summary</h3> </center>

         </div>

         <table style=" width:100%; background:#eee;">
          
 
          <tr>
            <td class="customer_info">ezWeigh Type:</td>
            <td><input type="text" value="{{$transaction->operation_type}}"></td>

            <td class="customer_info">ezWeigh Ticket Number:</td>
            <td><input type="text" value="{{$transaction->ticket_no}}"></td>

          </tr>
          
          <tr>

            <td class="customer_info">Gross Weight:</td>
            <td><input type="text" value="{{$transaction->gross_weight}}"></td>

            <td class="customer_info">Passes Used:</td>
            <td><input type="text" value="{{$transaction->payment->no_of_passes}}"></td>

          </tr>
         
          <tr>

         
            <td class="customer_info">Total Weight Covered:</td>
            <td><input type="text" value="{{$transaction->payment->passes_weight}}"></td>

            <td class="customer_info">Weight Due:</td>
            <td><input type="text" value="{{$transaction->payment->quantity - $transaction->payment->passes_weight}}"></td>

          </tr>

          <tr>
        
            <td class="customer_info">Payment Method:</td>
            <td><input type="text" value="Pass Only"></td>

            <td class="customer_info">Amount Due:</td>
            <td><input type="text" value=""></td>

          </tr>

          <tr>
        
            <td class="customer_info">Amount Paid:</td>
            <td><input type="text" value=""></td>

            <td class="customer_info">Change:</td>
            <td><input type="text" value=""></td>

          </tr>
         
        </table>
        <hr style="border-style: dotted;">
          <div class="clear">
            <p>
              <b>Notes:</b>
              {{$transaction->note}}
            </p>


          </div>
          <div class="clear">
            <p>Thank you for your business with Topps Environmental Solutions!</p>

            <center>
              <img src="logos/ezzton_light_initials.png"  width="20%"/></center>
            </center>
          </div>
          
  {{--
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

      --}}
</body>

</html>
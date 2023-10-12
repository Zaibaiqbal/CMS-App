

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Operator Summary</title>

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
		font-size: 10px;
		text-align: center;
        background-color: transparent;
	}

.customer_info{
  font-size: 17px;
  font-weight: bold;
}

#transaction table {
    border:none;
    border-collapse: collapse;
}

#transaction table td {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
}

#transaction table td:first-child {
    border-left: none;
}

#transaction table td:last-child {
    border-right: none;
}

</style>
</head>

<body style="font-size:13px !important;%">
           
    <div class="clear">
        <table style=" width:100%;font-size:12px;">
      
        <tr>
            
            <td style="width: 80%;"> 
                <center>
                <p> <b style="font-size: 15px;">Operator Summary</b> 
                <br>
                    {{date_format(now(),'M d Y')}}
                    <br>
                    All Facilities
                 </p>
                </center>
         
        
            </td>
        
        
        </tr>
        </table>
    </div>
       <br>
   
        <br>
        <div class="clear">
            <!-- <p><b>Business No. </b></p> -->
          <center><b  style="text-align: center;">GFL CLIENTS</b></center>  

        </div>
        <br>
        <table border="0" style="border-collapse: collapse; text-align: left; width:100%; font-size: 12px;">
       
           <thead border="0" style="text-align: left;">
            <tr>
                <th style="text-align: left;">Ticket Number</th>
                <th style="text-align: left;">Truck #</th>
                <th style="text-align: left;">Material</th>
                <th style="text-align: left;">Material Rate</th>
                <th style="text-align: left;">Billing Quantity</th>
                <th style="text-align: left;">Material Total</th>
                
            </tr>
          </thead>
          <tbody>
            @foreach($transaction_list as $rows)
            <tr>
                <td>{{$rows->ticket_no}}</td>
                <td>{{$rows->plate_no}}</td>
                <td>{{$rows->material_name}}</td>
                <td>{{$rows->material_rate}}</td>
                <td>{{$rows->quantity}}</td>
                <td>{{$rows->amount}}</td>
              

            </tr>
         
            @endforeach
            </tbody>
        
      
            <tfoot style="margin-top:20%;">
            <tr>
                <td colspan="6"><br></td>
               
        
            </tr>
            <tr>
                <td colspan="6"><br></td>

            </tr>
            <tr>
                 <td>Tickets Reported</td>
                <td>{{$transaction_list->count()}}</td>
                <td>Items Reported</td>
                <td>{{$transaction_list->count()}}</td>
              
                <td>Customer Totals:</td>
                <td>{{$transaction_list->sum('amount')}}</td>
            

                
            </tr>
            @if(isset($material_wise_list) && $material_wise_list->count() > 0 )
            <tr>
                <td colspan="4" style="text-align: left;">Material Summary</td>
           
                <td>Billing Quantity</td>
                <td>Material Total</td>
            </tr>
            @foreach($material_wise_list as $rows)
            <tr>
                <td colspan="4" style="text-align: left;">{{$rows->name}} </td>
           
                <td>{{$rows->net_weight}}</td>
                <td>{{$rows->total_amount}}</td>
            
                
            </tr>
            @endforeach
            @endif

            </tfoot>

                
           
         </table>


         <div class="clear" style="margin-top: 30px;">
            <!-- <p><b>Business No. </b></p> -->
          <center><b  style="text-align: center;">TOPPS CLIENTS</b></center>  

        </div>
        <br>
        <table border="0" style="border-collapse: collapse; text-align: left; width:100%; font-size: 12px;">
       
           <thead border="0" style="text-align: left;">
            <tr>
                <th style="text-align: left;">Ticket Number</th>
                <th style="text-align: left;">Truck #</th>
                <th style="text-align: left;">Material</th>
                <th style="text-align: left;">Material Rate</th>
                <th style="text-align: left;">Billing Quantity</th>
                <th style="text-align: left;">Material Total</th>
                
            </tr>
          </thead>
          <tbody>
            @foreach($transaction_list as $rows)
            <tr>
                <td>{{$rows->ticket_no}}</td>
                <td>{{$rows->plate_no}}</td>
                <td>{{$rows->material_name}}</td>
                <td>{{$rows->material_rate}}</td>
                <td>{{$rows->quantity}}</td>
                <td>{{$rows->amount}}</td>
              

            </tr>
         
            @endforeach
            </tbody>
        
      
            <tfoot style="margin-top:20%;">
            <tr>
                <td colspan="6"><br></td>
               
        
            </tr>
            <tr>
                <td colspan="6"><br></td>

            </tr>
            <tr>
                 <td>Tickets Reported</td>
                <td>{{$transaction_list->count()}}</td>
                <td>Items Reported</td>
                <td>{{$transaction_list->count()}}</td>
              
                <td>Customer Totals:</td>
                <td>{{$transaction_list->sum('amount')}}</td>
            

                
            </tr>
            @if(isset($material_wise_list) && $material_wise_list->count() > 0 )
            <tr>
                <td colspan="4" style="text-align: left;">Material Summary</td>
           
                <td>Billing Quantity</td>
                <td>Material Total</td>
            </tr>
            @foreach($material_wise_list as $rows)
            <tr>
                <td colspan="4" style="text-align: left;">{{$rows->name}} </td>
           
                <td>{{$rows->net_weight}}</td>
                <td>{{$rows->total_amount}}</td>
            
                
            </tr>
            @endforeach
            @endif

            </tfoot>

                
           
         </table>
</body>

</html>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Summary Customer Activity Report</title>

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
            <td style="width: 30%;">
                <p>All Ticket Types
                    <br>
                    History and Waiting
                </p>
            </td>
            <td style="width: 80%;"> 
                <center>
                <p> <b style="font-size: 15px;">Summary Customer Activity Report</b> 
                <br>
                    {{date_format($start_date,'M d Y')}},{{date_format($end_date,'M d Y')}}
                    <br>
                    All Facilities
                 </p>
                </center>
         
        
            </td>
            <td style="width: 25%;float:right;">
                <p>Confirmed Qty Applied to Billing
                   
                
                </p>
            </td>
        </tr>
        </table>
    </div>
       <br>
   
        <br>
        <div class="clear">
            <!-- <p><b>Business No. </b></p> -->
        </div>
        <table border="0" style="border-collapse: collapse; text-align: center; width:100%; font-size: 12px;">
           <thead border="0" style="">
           <tr>
            <td></td>
            <td colspan="2">Weight</td>
            <td colspan="2">Volume</td>
            <td colspan="2">Count</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           </tr>
            <tr >
                <th>Customer</th>
                <th>Inbound</th>
                <th>Outbound</th>
                <th>Inbound</th>
                <th>Outbound</th>
                <th>Inbound</th>
                <th>Outbound</th>
                <th>Billing Qty</th>
                <th>Material Total</th>
                <th>Tax Total</th>
                <th>Total</th>
                <th>Item Count</th>
                <th>Ticket Count</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transaction_list as $rows)
            <tr>
                <td>{{date_format($rows->created_at,'m/d/Y')}}</td>
                <td>{{$rows->ticket_no}}</td>
                <td>TOPPS</td>
                <td>{{$rows->plate_no}}</td>
                <td></td>
                <td>{{$rows->material_name}}</td>
                <td>{{$rows->material_rate}}</td>
                <td>{{$rows->quantity}}</td>
                <td>{{$rows->amount}}</td>
                <td>{{$rows->tax_amount}}</td>
                <td>{{$rows->amount + $rows->tax_amount}}</td>

            </tr>
         
            @endforeach
            </tbody>
        
      
            <tfoot style="margin-top:20%;">
            <tr>
                <td><br></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><br></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                 <td>Tickets Reported</td>
                <td>{{$transaction_list->count()}}</td>
                <td>Items Reported</td>
                <td>{{$transaction_list->count()}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>Customer Totals:</td>
                <td>{{$transaction_list->sum('amount')}}</td>
                <td>{{$transaction_list->sum('tax_amount')}}</td>
                <td>{{$transaction_list->sum('amount')+$transaction_list->sum('tax_amount')}}</td>

                
            </tr>
            <tr>
                <td>Material Summary</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Billing Quantity</td>
                <td>Material Total</td>
                <td>Tax Total</td>
                <td>Total</td>
            </tr>
            <tr>
                <td>CD - CONST. & DEMO. </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$transaction_list->sum('quantity')}}</td>
                <td>{{$transaction_list->sum('amount')}}</td>
                <td>{{$transaction_list->sum('tax_amount')}}</td>
                <td>{{$transaction_list->sum('amount')+$transaction_list->sum('tax_amount')}}</td>
            
                
            </tr>

            </tfoot>

                
           
         </table>


</body>

</html>
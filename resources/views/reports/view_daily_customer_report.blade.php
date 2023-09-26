

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Daily Customer Activity Report</title>

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
                <p> <b style="font-size: 15px;">Detail Customer Activity Report</b> 
                <br>
                    {{date_format(now(),'M d Y')}}
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
            <tr >
                <th>Date</th>
                <th>Ticket Number</th>
                <th>Client</th>
                <th>Group</th>
                <th>Truck #</th>
                <th>Material</th>
                <th>Material Rate</th>
                <th>Billing Quantity</th>
                <th>Material Total</th>
                <th>Tax Total</th>
                <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transaction_list as $rows)
            <tr>
                <td>{{date_format($rows->created_at,'m/d/Y')}}</td>
                <td>{{$rows->ticket_no}}</td>
                <td>{{$rows->client_name}}</td>
                <td>{{$rows->client_group}}</td>
                <td>{{$rows->plate_no}}</td>
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
            @if(isset($material_wise_list) && $material_wise_list->count() > 0 )
            <tr>
                <td colspan="7" style="text-align: left;">Material Summary</td>
           
                <td>Billing Quantity</td>
                <td>Material Total</td>
                <td>Tax Total</td>
                <td>Total</td>
            </tr>
            @foreach($material_wise_list as $rows)
            <tr>
                <td colspan="7" style="text-align: left;">{{$rows->name}} </td>
           
                <td>{{$rows->net_weight}}</td>
                <td>{{$rows->total_amount}}</td>
                <td>{{$rows->tax_amount}}</td>
                <td>{{$rows->total_amount+$rows->tax_amount}}</td>
            
                
            </tr>
            @endforeach
    @endif
            </tfoot>

                
           
         </table>


</body>

</html>
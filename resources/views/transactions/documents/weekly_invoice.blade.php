

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

<body style="font-size:16px !important; margin-top:5%">
           
    @if($format)    
        <div class="" style="">
            <form action="{{route('generateweeklyinvoice')}}"  method="post">
                @csrf
                <input type="hidden" value="{{$user->id}}" name="id">
                <input type="hidden" value="pdf" name="format">
                <button style="margin-left: 96% !important;border:none;background-color:transparent;" type="submit" class="pdf" title="Generate PDF" name="pdf" value="pdf"><img src="{{asset('images/pdf-icon.png')}}" width="60%"></button>
            </form>
        </div>
        @endif

    <div class="clear">
        <table style=" width:100%;">
        <tr>
          <td style="width: 30%;"><img src="logos/tes02.png"  width="25%"/></td>

          <td>
          <table border="0" style="border-collapse: collapse;font-size: 10pt;float:right;">

            <tbody>
                <tr>
                    <td colspan="2"><h4>INVOICE</h4></td>
                </tr>
                <tr>
                    <td>Invocie No:</td>
                    <td><input type="text" value="980928309" style="width: 60%;"></td>
                </tr> 
                <tr>
                    <td>Date:</td>
                    <td><input type="text" value="{{date_format(now(),'Y-m-d')}}" style="width: 70%;"></td>
                </tr>

                <tr>
                    <td>Ship Date:</td>
                    <td><input type="text" style="width: 60%;"></td>
                </tr>

                <tr>
                    <td>Page:</td>
                    <td><input type="text" style="width: 60%;"></td>
                </tr>
                <tr>
                    <td>Re: Order No.</td>
                    <td><input type="text" style="width: 60%;"></td>
                </tr>
            </tbody>

          </table>
            

          </td>

          </tr>
        <tr>
            <td> 
            <p>LaFleche, Div. Veckwith Transfer
            <br>
            6271 Cavanagh Road. Carleton Place,
            <br>
            Ontario K7C 0C4 </p>
        
            </td>
        </tr>
        </table>
    </div>
       <br>
    <div class="clear">

        <table border="0" style="width: 70%;border-collapse: collapse;font-size: 12pt;margin-left:10%;">
            <thead>
                    <tr>
                        <td> Sold To</td>
                        <td >Ship To</td>
                    </tr>

            </thead>

            <tbody>
                <tr style="">
                        <td>
                            <p> <b> {{$user->name}} </b>
                            <br>
                            {{$user->street}}
                            <br>

                            {{$user->city}}
                            <br>

                            {{$user->province}}, {{$user->postal_code}}</p>

                        </td>

                        <td>
                            <p> <b> {{$user->name}} </b>
                            <br>
                            {{$user->street}}
                            <br>

                            {{$user->city}}
                            <br>

                            {{$user->province}}, {{$user->postal_code}}</p>

                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
        <br>
        <div class="clear">
            <p><b>Business No. </b></p>
        </div>
        <table border="0" style="border-collapse: collapse; text-align: center; width:100%; font-size: 12pt;">
           <thead border="1" style="border: 1px solid black;">
            <tr >
                <th>Item No</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Tax</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($transaction_list as $rows)
            <tr>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">{{$rows->plate_no}}</td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">{{$rows->net_weight}}</td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">{{$rows->ticket_no}}</td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">{{$rows->total_cost}}</td>

                

            </tr>
         
            @endforeach
            <tr>
                 <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">Total</td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">{{($transaction_list->sum('total_cost'))}}</td>

                
            </tr>
            <tr>
            @php($surcharge_amount = 0)

                 <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">@if(isset($surcharge_hst->id)) SURCHARGE @ {{$surcharge_hst->surcharge_per}} @endif</td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                @if(isset($surcharge_hst->id)) 
                    @php($surcharge = $surcharge_hst->surcharge_per/100)
                    @php($surcharge_amount = $surcharge * $transaction_list->sum('total_cost'))

                @endif
                <td style="border-left: 1px solid black;border-right: 1px solid black;">{{$surcharge_amount}}</td>

                
            </tr>
            <tr>
            @php($tax_amount = 0)

                 <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;">@if(isset($surcharge_hst->id)) HST @ {{$surcharge_hst->hst_per}} @endif</td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                <td style="border-left: 1px solid black;border-right: 1px solid black;"></td>
                @if(isset($surcharge_hst->id)) 
                    @php($tax_per = $surcharge_hst->hst_per/100)
                    @php($tax_amount = $tax_per * $transaction_list->sum('total_cost'))

                @endif
                <td style="border-left: 1px solid black;border-right: 1px solid black;">{{$tax_amount}}</td>

                
            </tr>
            <tfoot style="border:1px solid black;">
                <tr rowspan="3">
                    <td>Shipped By:</td>
                    <td></td>

                    <td colspan="2"> Tracking Number</td>
                    <td></td>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;">Total Amount</td>
                    @php($sub_total = $surcharge_amount + $transaction_list->sum('total_cost')+$tax_amount)
                    <td>{{($sub_total)}}</td>
                    
                </tr>
                <tr>

                    <td>Comment:</td>
                    <td></td>

                    <td colspan="2"></td>
                    <td></td>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;">Amount Paid</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Sold By:</td>
                    <td></td>

                    <td colspan="2"></td>
                    <td></td>
                    <td style="border-left: 1px solid black;border-right: 1px solid black;">Amount Owning</td>
                    <td></td>
                </tr>

            </tfoot>

                
          </tbody>
           
         </table>


</body>

</html>
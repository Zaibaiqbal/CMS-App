
<!DOCTYPE html>
<html>
<head>

  <title>Account Statement</title>


  <style type="text/css">

    
    *{

        margin: 0;
     }

     /* GENERAL CSS APPLY ALL SECTIONS*/


  *{
    margin: 0;
  /*  padding-top: 6px;*/
  }
  .margin{
    padding-top: 8px;
  }

  .title{

    text-align: center;
    font-weight: bold;
  }


  .container1{

    margin-left: 7%;
    margin-right: 5%; 
    
  }

  .title1{

    text-align: center;
    margin-top: 2%;
    background: #a8a8a8;
    color: #fff;
    width: 30%;
    height: 2%;
    border-radius: 15px;
    vertical-align: middle;
    line-height: 29px;
    margin-left: 34.5%;
  }

  

  .clear{

    clear: both;
  }

  .top-section{
    margin-left: 4%;
  }

  input[type=text]
  {
    

    
    border-top: 0;
    border-right: 0;
    border-left: 0;
    border-bottom: 1px solid;
    font-size: 12px;
    text-align: center;
    background-color: transparent;

  }

/*  #START=> APPARTMENT SECTION */
  .main-section .row .col{
    
  
    width: 25%;
    margin-right: 30px;
    padding-right: 10px;
    float: left;
  }

  .main-section .row{

    /*margin-left: 4%;*/


  }

  .main-section .col label{
    font-size: 12px;
    /*font-weight: bold;*/
  }

  

  .main-section .row .col .check{
    vertical-align: middle;
    margin-top: 10px;
    margin-right:  90px; 
  }

/*  #END=> APPARTMENT SECTION */




  

  
/*  #END=> OFFICE USE SECTION */

/*  #START=>  IMAGE SECTION */

 .image-section{

    width: 100px;
    height: 100px;
    
    border: 1px solid #000;
    text-align: center;
    position: absolute;
    margin-left:  84%;
    top:  10%;

    
  }



  small{
    font-size: 12px;
    margin-left: 15;
  }

     .container{

        
     }
     
 

  </style>
</head>

<body style="margin:3% 7.5% 4% 7.5%;">

    <header>
      <div  class="header">
          <center> <img src="logos/tes02.png"  width="15%"/> </center>
      </div>
    </header>
    
     <br>

     <div class="container">
        <div class="main-section">
          <center> <h3>Today's Summary</h3></center>
          <br>
        <br>
        <h4> Employee Information: </h4>
       
      
        <div class="row clear">
          <div class="col margin" style="width: 45%">
            <label>Name: </label><input style="width: 94%"; value="{{$user->name}}" type="text">
          </div>
           <div class="col margin" style="width: 45%">
            <label>Email: <input style="width: 100%"; value="{{$user->email}}" type="text"></label>
          </div>
        </div>
        
        <div class="row clear">
          <div class="col margin" style="width: 45%">
            <label>Contact No. <input style="width: 94.5%"; value="{{$user->contact}}"  type="text"></label>
          </div>
          <div class="col margin" style="width: 45%">
            <label>Sign Off Date: <input style="width: 100%"; value="{{$date}}" type="text"></label>
          </div>
        </div>

     

      <div class="row clear">
    
          <table border="1" style="border-collapse: collapse; margin-top:3%; text-align: center; width:100%;">
            <thead>
              <tr>
              <th colspan="5" style="background: #2e5a88;color:white; ">Transactions</th>
                
              </tr>
           
                <tr>
                    <th>#</th>
                    <th>License No</th>
                    <th>Description</th>
                    <th>Client</th>
                    <th>Ticket No.</th>

                </tr>
              </thead>
              <tbody>
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
                
              </tbody>
              
            </thead>
          </table>
      </div>


              <!-- INSTALLMENT PLAN -->
        
        </div>
     </div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Approved</title>
</head>
<body>
<div class="card">

<div class="card-header">
  Registration
</div>

<div class="card-body">

  <center><img src="logos/tes02.png"  width="20%"/></center>

  <p>Your request for the registration against following details has been approved by Admin. </p>
    
    <p><b>Name: </b> {{$user['name']}} </p>
    <p><b>Contact: </b>{{$user['contact']}} </p>
   <p> <b>Email: </b> {{$user['email']}} </p>
    
 <p> Your password is: <b> {{$user['password']}}  </b> </p>


    <p>Thank you</p>
</div>

</div>

</body>
</html>

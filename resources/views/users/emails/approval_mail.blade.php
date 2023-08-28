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

  <center><img src="{{logos/tes02.png}}"  width="20%"/></center>

  <p>Your request for the registration against following details has been approved by Admin.
    
    <br>
    <h4>Name</h4> <b>{{$user['name']}}</b> 
    <h4>Contact</h4> <b>{{$user['contact']}}</b> 
    <h4>Email</h4> <b>{{$user['email']}}</b> 
    
  Your password is: <b> {{$user['password']}}  </b> </p>


    <p>Thank you</p>
</div>

</div>

</body>
</html>

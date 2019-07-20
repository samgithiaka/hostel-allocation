<?php
 ob_start();
 include('session2.php');
 if(!isSET($_SESSION['username'])){
    header("Location:student_login.php");
 }
  require_once 'connection.php'; 
 
  $error = false;
 
 if ( isSET($_POST['btn-checkresult']) ) {
    $studid=$_SESSION['username'];

    $sql7="SELECT * FROM users WHERE user_id = $studid";
    $sqlresults7=mysqli_query($con,$sql7);
    $output7=mysqli_fetch_array($sqlresults7);
    $rowcheck7=mysqli_num_rows($sqlresults7);
    $email7=$output7['Admission_no'];

     $sql13="SELECT * FROM users WHERE user_id=$studid";
    $sqlresults13=mysqli_query($con,$sql13);
    $output13=mysqli_fetch_array($sqlresults13);
    $rowcheck13=mysqli_num_rows($sqlresults13);
    $gender=$output13['Gender'];

    $sql6="SELECT * FROM users WHERE user_id=$studid";
    $sqlresults6=mysqli_query($con,$sql6);
    $output6=mysqli_fetch_array($sqlresults6);
    $rowcheck6=mysqli_num_rows($sqlresults6);
    $disabled=$output6['Disabled'];
    if($gender=="FEMALE"){
    if($disabled==0){

    $sql="SELECT min(Room_no) as roomno FROM female_rooms WHERE status=0 and Room_no>5";
    $sqlresults=mysqli_query($con,$sql);
    $output=mysqli_fetch_array($sqlresults);
    $rowcheck=mysqli_num_rows($sqlresults);
    $roomno=$output['roomno'];

    $sql5="SELECT * FROM users WHERE user_id=$studid";
    $sqlresults5=mysqli_query($con,$sql5);
    $output=mysqli_fetch_array($sqlresults5);
    $room=$output['Room_no'];

$sql9="SELECT * FROM users WHERE user_id=$studid";
    $sqlresults9=mysqli_query($con,$sql9);
    $output=mysqli_fetch_array($sqlresults9);
    $hostels=$output['hostel'];

    $sql10="SELECT * FROM users WHERE user_id=$studid";
    $sqlresults10=mysqli_query($con,$sql10);
    $output=mysqli_fetch_array($sqlresults10);
    $durations=$output['duration'];

    if($room==0){
    if($rowcheck>0){
    $sql1="UPDATE users SET Room_no=$roomno WHERE user_id=$studid";
    $res1=mysqli_query($con,$sql1);

    $sql2="UPDATE female_rooms SET occupants=occupants+1 WHERE Room_no=$roomno";
    $res2=mysqli_query($con,$sql2);

    $sql3="SELECT occupants FROM female_rooms WHERE Room_no=$roomno";
    $res3=mysqli_query($con,$sql3);
    $row3=mysqli_fetch_array($res3);
    $occupants=$row3['occupants'];

    if($occupants>0){
         $sql4="UPDATE female_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      echo'<div>Room Allocated Successfully</div>';
         
    }
    else{
      echo'<div>Too many people</div>';
    }

   }
   else{
    echo'<div id="full">No more room</div>';
   }
   }
else{
  echo'<div id="allocated">You have been allocated '.$hostels.'Room '.$room. 'please pay via either </br><img src="img/lipa.jpeg"></br> Bank account </br> KCB 1101632445
</div>';
}
if($durations=="ONE MONTH"){
  echo 'please pay 3500';
}elseif($durations=="TWO MONTHS"){
echo 'please pay 3500';
}elseif($durations=="THREE MONTHS"){
echo 'please pay 7000';
}elseif($durations=="FOUR MONTHS"){
echo 'please pay 7000';
}
    }
else{
  $sql="SELECT min(Room_no) as roomno FROM female_rooms WHERE status=0 and Room_no<6";
    $sqlresults=mysqli_query($con,$sql);
    $output=mysqli_fetch_array($sqlresults);
    $rowcheck=mysqli_num_rows($sqlresults);
    $roomno=$output['roomno'];

    $sql5="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults5=mysqli_query($con,$sql5);
    $output=mysqli_fetch_array($sqlresults5);
    $room=$output['Room_no'];

$sql9="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults9=mysqli_query($con,$sql9);
    $output=mysqli_fetch_array($sqlresults9);
    $hostels=$output['hostel'];

$sql10="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults10=mysqli_query($con,$sql10);
    $output=mysqli_fetch_array($sqlresults10);
    $durations=$output['duration'];


    if($room==0){
    if($rowcheck>0){
    $sql1="UPDATE users SET Room_no=$roomno WHERE user_id=$studid";
    $res1=mysqli_query($con,$sql1);

    $sql2="UPDATE female_rooms SET occupants=occupants+1 WHERE Room_no=$roomno";
    $res2=mysqli_query($con,$sql2);

    $sql3="SELECT occupants FROM female_rooms WHERE Room_no=$roomno";
    $res3=mysqli_query($con,$sql3);
    $row3=mysqli_fetch_array($res3);
    $occupants=$row3['occupants'];

  

    if($occupants>0){
         $sql4="UPDATE female_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      echo'<div>Room Allocated Successfully</div>';
         
    }
    else{
      echo'<div>Too many people</div>';
    }

   }
   else{
    echo'<div id="full">No more room</div>';
   }
   }
else{
  echo'<div id="allocated">You have been allocated '.$hostels.'Room '.$room. 'please pay via either </br><img src="img/lipa.jpeg"></br> Bank account </br> KCB 1101632445
</div>';
}
if($durations=="ONE MONTH"){
  echo 'please pay 3500';
}elseif($durations=="TWO MONTHS"){
echo 'please pay 3500';
}elseif($durations=="THREE MONTHS"){
echo 'please pay 7000';
}elseif($durations=="FOUR MONTHS"){
echo 'please pay 7000';
}
}}
    
  else{
    if($disabled==0){

    $sql="SELECT min(Room_no) as roomno FROM male_rooms WHERE status=0 and Room_no>5";
    $sqlresults=mysqli_query($con,$sql);
    $output=mysqli_fetch_array($sqlresults);
    $rowcheck=mysqli_num_rows($sqlresults);
    $roomno=$output['roomno'];

    $sql5="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults5=mysqli_query($con,$sql5);
    $output=mysqli_fetch_array($sqlresults5);
    $room=$output['Room_no'];

$sql9="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults9=mysqli_query($con,$sql9);
    $output=mysqli_fetch_array($sqlresults9);
    $hostels=$output['hostel'];

$sql10="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults10=mysqli_query($con,$sql10);
    $output=mysqli_fetch_array($sqlresults10);
    $durations=$output['duration'];

    if($room==0){
    if($rowcheck>0){
    $sql1="UPDATE users SET Room_no=$roomno WHERE user_id=$studid";
    $res1=mysqli_query($con,$sql1);

    $sql2="UPDATE male_rooms SET occupants=occupants+1 WHERE Room_no=$roomno";
    $res2=mysqli_query($con,$sql2);

    $sql3="SELECT occupants FROM male_rooms WHERE Room_no=$roomno";
    $res3=mysqli_query($con,$sql3);
    $row3=mysqli_fetch_array($res3);
    $occupants=$row3['occupants'];

    if($occupants>0){
         $sql4="UPDATE male_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      echo'<div>Room Allocated Successfully</div>';
         
    }
    else{
      echo'<div>Too many people</div>';
    }

   }
   else{
    echo'<div id="full">No more room</div>';
   }
   }
else{
  echo'<div id="allocated">You have been allocated '.$hostels.'Room '.$room. 'please pay via MPESA</div>';

}
if($durations=="ONE MONTH"){
  echo 'please pay 3500';
}elseif($durations=="TWO MONTHS"){
echo 'please pay 3500';
}elseif($durations=="THREE MONTHS"){
echo 'please pay 7000';
}elseif($durations=="FOUR MONTHS"){
echo 'please pay 7000';
}
    }
else{
  $sql="SELECT min(Room_no) as roomno FROM male_rooms WHERE status=0 and Room_no<6";
    $sqlresults=mysqli_query($con,$sql);
    $output=mysqli_fetch_array($sqlresults);
    $rowcheck=mysqli_num_rows($sqlresults);
    $roomno=$output['roomno'];

    $sql5="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults5=mysqli_query($con,$sql5);
    $output=mysqli_fetch_array($sqlresults5);
    $room=$output['Room_no'];

$sql10="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults10=mysqli_query($con,$sql10);
    $output=mysqli_fetch_array($sqlresults10);
    $durations=$output['duration'];


$sql9="SELECT * FROM users WHERE user_id='$studid'";
    $sqlresults9=mysqli_query($con,$sql9);
    $output=mysqli_fetch_array($sqlresults9);
    $hostels=$output['hostel'];

    if($room==0){
    if($rowcheck>0){
    $sql1="UPDATE users SET Room_no=$roomno WHERE user_id=$studid";
    $res1=mysqli_query($con,$sql1);

    $sql2="UPDATE male_rooms SET occupants=occupants+1 WHERE Room_no=$roomno";
    $res2=mysqli_query($con,$sql2);

    $sql3="SELECT occupants FROM male_rooms WHERE Room_no=$roomno";
    $res3=mysqli_query($con,$sql3);
    $row3=mysqli_fetch_array($res3);
    $occupants=$row3['occupants'];

    if($occupants>0){
         $sql4="UPDATE male_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      echo'<div>Room Allocated Successfully</div>';
         
    }
    else{
      echo'<div>Too many people</div>';
    }

   }
   else{
    echo'<div id="full">No more room</div>';
   }
   }
else{
  echo'<div id="allocated">You have been allocated '.$hostels.'Room '.$room. 'please pay via either </br><img src="img/lipa.jpeg"></br> Bank account </br> KCB 1101632445  </div>';

}
if($durations=="ONE MONTH"){
  echo 'please pay 3500';
}elseif($durations=="TWO MONTHS"){
echo 'please pay 3500';
}elseif($durations=="THREE MONTHS"){
echo 'please pay 7000';
}elseif($durations=="FOUR MONTHS"){
echo 'please pay 7000';
}
}}
   }


  
 if ( isSET($_POST['btn-stkPush']) ) {
  
    $phone_no1 = trim($_POST['mpesa_phone_no']);
    $phone_no1 = strip_tags($phone_no1);
    $phone_no1 = htmlspecialchars($phone_no1);

    $amount = trim($_POST['amount']);
    $amount = strip_tags($amount);
    $amount = htmlspecialchars($amount);

    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
      
    $curl = curl_init();
    curl_SETopt($curl, CURLOPT_URL, $url);
    curl_SETopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type:application/json',
        'Authorization:Bearer DsMf8xwGGlre6nxbRG4FxXhAVJls'
    )
    ); //SETting custom header
    
  
    $curl_post_data = array(
      //Fill in the request parameters with valid values
      'BusinessShortCode' => '174379',
      'Password' => 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTkwNjE3MTY1MzAw',
      'Timestamp' => '20190617165300',
      'TransactionType' => 'CustomerPayBillOnline',
      'Amount' => $amount,
      'PartyA' => $phone_no1,
      'PartyB' => '174379',
      'PhoneNumber' => $phone_no1,
      'CallBackURL' => 'https://75ea7e18.ngrok.io /hooks/mpesa',
      'AccountReference' => 'test',
      'TransactionDesc' => 'test'
    );
    
    $data_string = json_encode($curl_post_data);
    
    curl_SETopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_SETopt($curl, CURLOPT_POST, true);
    curl_SETopt($curl, CURLOPT_POSTFIELDS, $data_string);
    
    $curl_response = curl_exec($curl);
    if (strpos($curl_response, 'Success') !==false) {
     header("Location: payment_confirmation.php");
      $errTyp = "success";
      $errMSG = "Successfully sent stkpush on phone";
      echo "Success. Request accepted for processing";
     } else {
      $errTyp = "danger";
      $errMSG = "Something went wrong, try again later..."; 
      echo "danger";
     } 
   // print_r($curl_response);
    
    // echo $curl_response;
        }

 ?>
<!DOCTYPE html>
<html>
    <style>
        .split {
  height: 70%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 40;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Control the left side */
.left {
  left: 0;
  background-color: green;
}

/* Control the right side */
.right {
  right: 0;
  background-color:goldenrod;
}

        </style>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="split left">
  <div class="centered">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<div class="form-group">
            <!-- <button type="button" class="btn btn-block btn-primary" name="stkPush">PAY VIA MPESA</button> -->
             <button type="submit"  class="btn btn-block btn-primary" name="btn-checkresult">CHECK RESULT</button>
            </div>
</form>
</div>
</div>

<div class="split right">
  <div class="centered">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">



<label>
              Mpesa number<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="integer" placeholder="254xxxxxxx" class="form-control" name="mpesa_phone_no" value= "<?php echo $phone_no1 ?>" required autocomplete="off"/>
          </div>
          <span class="text-danger"><?php echo $phone_noError; ?></span>
           </div>
           Amount<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="integer"  class="form-control" name="amount" value= "<?php echo $amount ?>" required autocomplete="off"/>
          </div>
          <span class="text-danger"><?php echo $phone_noError; ?></span>
           </div>

           
<div class="form-group">
            <button type="submit" class="btn btn-block btn-primary" name="btn-stkPush">PAY VIA MPESA</button>
             <!-- <button type="submit"  class="btn btn-block btn-primary" name="btn-checkresult">CHECK RESULT</button> -->
            </div>
            </form>

            </div>
</div>
</body>
</html>
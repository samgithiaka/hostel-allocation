<?php
 ob_start();
 session_start();
 
 if(!isset($_SESSION['username'])){
   header("Location: index.php");
   exit;
}
 require_once 'connection.php'; 

 $error = false;
 if ( isset($_POST['btn-payment']) ) {
  $_SESSION['apply']="apply";
  header("Location:payment_details.php");

 }
 if ( isset($_POST['btn-apply']) ) {
$time=time();
$hostel= ($_POST['hostel']);
$duration= ($_POST['duration']);
if( !$error ) {
      $studid=$_SESSION['username'];
 $sql8="UPDATE `users` SET `hostel` = '$hostel'  WHERE user_id =$studid";
    $res=mysqli_query($con,$sql8);
     $sql11="UPDATE `users` SET `duration` = '$duration'  WHERE user_id =$studid";
    $res=mysqli_query($con,$sql11);
    $sql12="UPDATE `users` SET `allocation_date` = '$time'  WHERE user_id =$studid";
    $res=mysqli_query($con,$sql12);
   if ($res) {
    
    $errTyp = "success";
    $errMSG = "Successfully applied";
  
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
  
   } }}


   if ( isset($_POST['btn-checkresult']) ) {
    $studid=$_SESSION['username'];
    $_SESSION['apply']="apply";
    
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

    $sql="SELECT min(Room_no) as roomno FROM female_rooms WHERE status=0 and Room_no>2";
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

    if($occupants>1){
         $sql4="UPDATE female_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      // echo'<div>Room Allocated Successfully</div>';
      $errTyp2="success";
      $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';
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
  $errTyp2="success";
  $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';
}
if($durations=="ONE MONTH"){
  $errTyp1="success";
  $errMSG1='please pay  3500 via Mpesa';
}elseif($durations=="TWO MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  3500 via Mpesa';
}elseif($durations=="THREE MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}elseif($durations=="FOUR MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}
    }
else{
  $sql="SELECT min(Room_no) as roomno FROM female_rooms WHERE status=0 and Room_no<3";
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

  

    if($occupants>1){
         $sql4="UPDATE female_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      // echo'<div>Room Allocated Successfully</div>';
      $errTyp2="success";
  $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';
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
  $errTyp2="success";
  $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';
}
if($durations=="ONE MONTH"){
  $errTyp1="success";
  $errMSG1='please pay  3500 via Mpesa';
}elseif($durations=="TWO MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay 3500 via Mpesa';
}elseif($durations=="THREE MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}elseif($durations=="FOUR MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}
}}
    
  else{
    if($disabled==0){

    $sql="SELECT min(Room_no) as roomno FROM male_rooms WHERE status=0 and Room_no>2";
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

    if($occupants>1){
         $sql4="UPDATE male_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      $errTyp2="success";
      $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';
         
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
  $errTyp2="success";
  $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';

}
if($durations=="ONE MONTH"){
  $errTyp1="success";
  $errMSG1='please pay  3500 via Mpesa';
}elseif($durations=="TWO MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  3500 via Mpesa';
}elseif($durations=="THREE MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}elseif($durations=="FOUR MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}
    }
else{
  $sql="SELECT min(Room_no) as roomno FROM male_rooms WHERE status=0 and Room_no<3";
    $sqlresults=mysqli_query($con,$sql);
    $output=mysqli_fetch_array($sqlresults);
    $rowcheck=mysqli_num_rows($sqlresults);
    $roomno=$output['roomno'];

    $sql5="SELECT * FROM users WHERE user_id=$studid";
    $sqlresults5=mysqli_query($con,$sql5);
    $output=mysqli_fetch_array($sqlresults5);
    $room=$output['Room_no'];

$sql10="SELECT * FROM users WHERE user_id=$studid";
    $sqlresults10=mysqli_query($con,$sql10);
    $output=mysqli_fetch_array($sqlresults10);
    $durations=$output['duration'];


$sql9="SELECT * FROM users WHERE user_id=$studid";
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

    if($occupants>1){
         $sql4="UPDATE male_rooms SET status=1 WHERE Room_no=$roomno";
         $res4=mysqli_query($con,$sql4);    
    }
    if($res1){
      // echo'<div>Room Allocated Successfully</div>';
      $errTyp2="success";
      $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';

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
  $errTyp2="success";
  $errMSG2='<div id="allocated">You have been allocated '.$hostels.'Room '.$room. '</div>';

}
if($durations=="ONE MONTH"){
  $errTyp1="success";
  $errMSG1='please pay 3500 via Mpesa';
}elseif($durations=="TWO MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay 3500 via Mpesa';
}elseif($durations=="THREE MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}elseif($durations=="FOUR MONTHS"){
  $errTyp1="success";
  $errMSG1='please pay  7000 via Mpesa';
}
}}
   }


  

  ?>
 <!DOCTYPE html>
<html>
<head>


<style>
        .split {
  height: 90%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 1;
  overflow-x: hidden;
  padding-top: 0px;
  padding:30px;
}

/* Control the left side */
.left {
  left: 0;
  
}

/* Control the right side */
.right {
  
  right: 0;

}


        </style>
        
</head>
<link rel="stylesheet" href="Registerstyle.css" type="text/css" />
<body>
<div class="split left">
  <div class="centered">
  <div class="container-details">
			<div class="wrap-details">
     
    <?php
      if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
   <div class="wrap-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
     <label>
              Select Hostel<span class="req">*</span>
            </label>
             <div class="form-group">
             <div>
             <span class="focus-input100"></span>
            <select class="input100" name="hostel">
    <option class="input100" value="TUK MEN HOSTEL" name="men_hostel" >TUK MEN HOSTEL</option>
    <option class="input100" value="TUK LADIES HOSTEL" name="ladies_hostel">TUK LADIES HOSTEL</option>/>
  
    </select>
          </div>
               </div>
<label>
           Select Duration Of Stay<span class="req">*</span>
            </label>
             <div class="form-group">
             <div>
             <span class="focus-input100"></span>
            <select class="input100" name="duration">
      <option class="input100" value="ONE MONTH">ONE MONTH</option>
      <option class="input100" value="TWO MONTHS">TWO MONTHS</option>
      <option class="input100" value="THREE MONTHS">THREE MONTHS</option>
      <option class="input100" value="FOUR MONTHS">FOUR MONTHS</option>
 
    </select>
</div>
          </div>
          <br/>
          <br/>

      <div class="form-group">
             <button type="submit" class="login100-form-btn" name="btn-apply">APPLY</button>
            </div>
           
      
  
      </form>
    </div>
  </div>
  </div>
  </div>
  </div>
  
<div class="split right">
  <div class="centered">
  <div class="container-details">
  
			<div class="wrap-details">
      
      <div class="wrap-form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<div class="form-group">
           <button type="submit"  class="login100-form-btn" name="btn-checkresult">CHECK RESULT</button>
            </div>
            <br>
            <br>
            <br>
            <?php
      if ( isset($errMSG2) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp2=="success") ? "success" : $errTyp2; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG2; ?>
                </div>
             </div>
                <?php
   }
   ?>
   <?php
      if ( isset($errMSG1) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp1=="success") ? "success" : $errTyp1; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG1; ?>
                </div>
             </div>
                <?php
   }
   ?>
   <div class="form-group">
          <button type="submit"  class="login100-form-btn" name="btn-payment">PROCEED TO PAYMENT</button>
            </div>
</form>
  </div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>
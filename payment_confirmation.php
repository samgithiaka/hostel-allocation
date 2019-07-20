<?php
 ob_start();
 include('session2.php');
 
 if(!isset($_SESSION['username'])){
   header("Location:payment_confirmation.php");
}
 require_once 'connection.php'; 

 $error = false;

 if ( isset($_POST['btn-send']) ) {
  
    $mpesa_code = trim($_POST['mpesa_code']);
    $mpesa_code = strip_tags($mpesa_code);
    $mpesa_code = htmlspecialchars($mpesa_code);
    if( empty($mpesa_code) == false) {
        $mpesa_code1="paid";
    }else{
        $mpesa_code1="unpaid";
        echo "please enter confirmation code";
    }
    if( !$error ) {
        $studid=$_SESSION['username'];
   $sql8="UPDATE `users` SET `payment_status` = '$mpesa_code1'  WHERE `user_id` ='$studid'";
      $res=mysqli_query($con,$sql8);

      if ($mpesa_code1=="paid") {
        $errTyp = "success";
        $errMSG = "Successfully paid";
      echo "successfully paid ,you can now checkin to your allocated room";
       } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later..."; 
        echo $errMSG;
       }
    }}
 ?>
  <!DOCTYPE html>
<html>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<label>
              CONFIRMATION CODE<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" placeholder="NGD19E2Y9D" class="form-control" name="mpesa_code" value= "<?php echo $mpesa_code ?>" autocomplete="off"/>
          </div>
          <span class="text-danger"><?php echo $phone_noError; ?></span>
           </div>
           <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary" name="btn-send">SEND</button>
            
            </div>
           </form>
</body>
</html>
<?php ob_end_flush(); ?>
<?php
 ob_start();
 include('session2.php');
 
 if(!isset($_SESSION['username'])){
   header("Location:student_login.php");
}
 require_once 'connection.php'; 

 $error = false;

 if ( isset($_POST['btn-send']) ) {
  
  $mpesa_code = trim($_POST['mpesa_code']);
  $mpesa_code = strip_tags($mpesa_code);
  $mpesa_code = htmlspecialchars($mpesa_code);
$mpesa_code1="paid";
  if(strlen($mpesa_code) < 10){
    $error=true;
    $mpesa_code1= "unpaid";
    $mpesa_Error= "INVALID";
  }elseif(strlen($mpesa_code) > 10){
    $error=true;
    $mpesa_code1= "unpaid";
    $mpesa_Error= "INVALID";
  }
  elseif( empty($mpesa_code)!== false) {
    $error=true;
    $mpesa_code1= "unpaid";
    $mpesa_Error= "PLEASE ENTER MPESA VERIFICATION CODE";
  }
  if( !$error ) {
      $studid=$_SESSION['username'];
 $sql8="UPDATE `users` SET `payment_status` = '$mpesa_code1'  WHERE `user_id` ='$studid'";
    $res=mysqli_query($con,$sql8);

    if ($mpesa_code1=="paid") {
      header("Location:studReport.php");
      $errTyp = "success";
      $errMSG = "Successfully paid";
    echo "successfully paid ,you can now checkin to your allocated room";
     } else {
      $errTyp = "danger";
    echo "danger";
   } 
  }}
 ?>
  <!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Registerstyle.css" type="text/css" /> 
</head>
<body>

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
    <?php
      if ( isset($mpesa_Error) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($mpesa_code1=="unpaid") ? "unpaid" : $mpesa_code1; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $mpesa_Error; ?>
                </div>
             </div>
                <?php
   }
   ?>
      <div class="wrap-form">
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
<label>
              CONFIRMATION CODE<span class="req">*</span>
            </label>
             <div class="form-group">
                       
            <input type="text" placeholder="NGD19E2Y9D" class="input100" name="mpesa_code" value= "<?php echo $mpesa_code ?>" autocomplete="off"/>
            <span class="focus-input100"></span>
          </div>
          <span class="text-danger"><?php echo $phone_noError; ?></span>
           </div>
           <div class="form-group">
            <button type="submit" class="login100-form-btn" name="btn-send">VERIFY</button>
            
            </div>
           </form>
</div>
</div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>
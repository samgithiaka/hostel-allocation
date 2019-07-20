<?php
 ob_start();
 include('session2.php');
 if(!isset($_SESSION['username'])){
   header("Location:index.php");
}
 require_once 'connection.php';
 
 
 $error = false;
 
 if ( isset($_POST['btn-next']) ) {
  
  // clean user inputs to prevent sql injections
  $fname = trim($_POST['fname']);
  $fname = strip_tags($fname);
  $fname = htmlspecialchars($fname);

   $lname = trim($_POST['lname']);
  $lname = strip_tags($lname);
  $lname = htmlspecialchars($lname);
  

   $ID_no = trim($_POST['ID_no']);
  $ID_no = strip_tags($ID_no);
  $ID_no = htmlspecialchars($ID_no);

   $phone_no = trim($_POST['phone_no']);
  $phone_no = strip_tags($phone_no);
  $phone_no = htmlspecialchars($phone_no);

   $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

   $relationship = trim($_POST['relationship']);
  $relationship = strip_tags($relationship);
  $relationship = htmlspecialchars($relationship);
 
 
// basic name validation
  if (empty($fname)) {
   $error = true;
   $fnameError = "Please enter your first name.";
  } else if (strlen($fname) < 3) {
   $error = true;
   $fnameError = "first Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$fname)) {
   $error = true;
   $fnameError = "first Name must contain alphabets and space.";
  }

  elseif (empty($lname)) {
   $error = true;
   $lnameError = "Please enter your last name.";
  } else if (strlen($lname) < 3) {
   $error = true;
   $lnameError = "Last Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$lname)) {
   $error = true;
   $lnameError = "last Name must contain alphabets and space.";
  }

  //phone number validation
   if (!preg_match('/^[0-9]*$/', $phone_no)) {
        $error=true;
$phone_noError = "please enter a numeric value";
    } elseif(strlen($phone_no) < 10){
      $error=true;
      $phone_noError= "Phone number is too short";
    }elseif(strlen($phone_no) > 10){
      $error=true;
      $phone_noError= "Phone number is too long";
    }

    //ID NUMBER VALIDATION
    
   if (!preg_match('/^[0-9]*$/', $ID_no)) {
        $error=true;
$ID_noError = "please enter a numeric value";
    } elseif(strlen($ID_no) < 8){
      $error=true;
      $ID_noError= "ID number is too short";
    }elseif(strlen($ID_no) > 8){
      $error=true;
      $ID_noError= "ID number is too long";
    }

     //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } 
if( !$error ) {
  $query = "INSERT INTO next_of_kin(fname,lname,ID_no,phone_no,email,relationship) VALUES('$fname','$lname','$ID_no','$phone_no','$email','$relationship')";
   $res = mysqli_query($con,$query);
    
   if ($res) {
   // $_SESSION['user'] = $row['user_id'];
    header("Location: apply.php");
   } 
   else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
} }
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="nokstyle.css" type="text/css" />
<body>

 <div id="details-form">
    <form method="post" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">NEXT OF KIN DETAILS</h2>
            </div>
        
         <div class="form-group">
             <hr />
            </div>
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


            
            <label>
              First Name<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="fname" value="<?php echo $fname ?>" required autocomplete="off"/>
          </div>
          <span class="text-danger"><?php echo $fnameError; ?></span>
</div>
          
            <label>
              Last Name<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="lname" value="<?php echo $lname ?>" required autocomplete="off"/>
          </div>
<span class="text-danger"><?php echo $lnameError; ?></span>
           </div>
          
            <label>
              ID number<span class="req">*</span>
            </label>

           <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="ID_no" value="<?php echo $ID_no ?>" required autocomplete="off"/>
          </div>
          <span class="text-danger"><?php echo $ID_noError; ?></span>
           </div>
          
            <label>
              Phone number<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="integer" name="phone_no" value= "<?php echo $phone_no ?>" required autocomplete="off"/>
          </div>
           <span class="text-danger"><?php echo $phone_noError; ?></span>
           </div>

            <label>
              Email address<span class="req">*</span>
            </label>

           <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="character" name="email" value="<?php echo $email ?>" required autocomplete="off"/>
          </div>
          <span class="text-danger"><?php echo $emailError; ?></span>
           </div>

 Relationship<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <select name="relationship">
  <option value="FATHER">FATHER</option>
  <option value="MOTHER">MOTHER</option>
  <option value="SISTER">SISTER</option>
  <option value="BROTHER">BROTHER</option>
  <option value="GUARDIAN">GUARDIAN</option>
 
</select>
         
          
         

         <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-next">NEXT</button>
            </div>
             
 
</form>
    
</body>
</html>
<?php ob_end_flush(); ?>

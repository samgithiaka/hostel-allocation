<?php
 ob_start();
 session_start();
 if(!isset($_SESSION['user'])){
   header("Location:index.php");
}
 require_once 'dbconnect.php';
 
 // if session is not set this will redirect to login page
 /*if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }*/
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
 
 // select loggedin users detail
// $res=mysql_query("SELECT * FROM personal_details WHERE userId=".$_SESSION['user']);
// $userRow=mysql_fetch_array($res);

if( !$error ) {
  $query = "INSERT INTO next_of_kin(fname,lname,ID_no,phone_no,email,relationship) VALUES('$fname','$lname','$ID_no','$phone_no','$email','$relationship')";
   $res = mysql_query($query);
    
   if ($res) {
   // $_SESSION['user'] = $row['user_id'];
    header("Location: apply.php");
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
} }
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css" type="text/css" />
<body>

 <div id="details-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
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
            <input type="text" name="fname" required autocomplete="off"/>
          </div>

          
            <label>
              Last Name<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="lname" required autocomplete="off"/>
          </div>

          
            <label>
              ID number<span class="req">*</span>
            </label>

           <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="ID_no" required autocomplete="off"/>
          </div>
          
          
            <label>
              Phone number<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="integer" name="phone_no" required autocomplete="off"/>
          </div>
          
            <label>
              Email address<span class="req">*</span>
            </label>

           <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="character" name="email" required autocomplete="off"/>
          </div>

          <label>
              Relationship<span class="req">*</span>
            </label>

           <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="character" name="relationship" required autocomplete="off"/>
          </div>
          
          
         

         <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-next">NEXT</button>
            </div>
             
 
</form>
    
</body>
</html>
<?php ob_end_flush(); ?>

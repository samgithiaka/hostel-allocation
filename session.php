<?php
 ob_start();
 session_start();

 
 require_once ('connection.php');
 
 $error = false;
 
 if( isset($_POST['btn-login']) ) { 
  
   $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
 
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
 
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } 
  // if there's no error, continue to login
  if (!$error) {
   
   $password = hash('sha256', $pass); // password hashing using SHA256
   $query="SELECT * FROM admin WHERE email='$email'";
   $res=mysqli_query($con,$query);
   $row=mysqli_fetch_array($res);
   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
   $passworddb=$row['password'];
   $email=$row['email'];
   echo$email;

   if( $count == 1 && $password==$passworddb  ) {
    echo'successssssssssssssssssss';
    $_SESSION['username'] = $email;
    header("Location: admin_portal.php");
   } 
   else {
    $errMSG = "Incorrect Credentials, Try again...";
   }
    
  }
  
 }
?>
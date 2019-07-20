<?php
 ob_start();
 session_start();

 require_once ('connection.php');
 $error = false;
 
 if( isset($_POST['btn-login']) ) { 
  
   $admin_no = trim($_POST['Admin_no']);
  $admin_no = strip_tags($admin_no);
  $admin_no = htmlspecialchars($admin_no);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
 
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
 
   if (empty($admin_no)) {
   $error = true;
   $admError = "Please enter your full admission number.";
  } else if (strlen($admin_no) < 12) {
   $error = true;
   $admError = "Admission number must have atleat 12 characters.";
  } 
  
  // if there's no error, continue to login
  if (!$error) {

   $password = hash('sha256', $pass); // password hashing using SHA256
   $query="SELECT * FROM users WHERE Admission_no='$admin_no'";
   $res=mysqli_query($con,$query);
   $row=mysqli_fetch_array($res);
   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
   $passworddb=$row['userPass'];
   $user_id=$row['user_id'];
  //  echo$user_id;

   if( $count == 1 && $password==$passworddb  ) {
         echo'successssssssssssssssssss';
     $_SESSION['username'] = $user_id;
    header("Location: apply.php");

   } 
   else {
    $errMSG = "Incorrect Credentials, Try again...";
   }
  }
  }
  
?>
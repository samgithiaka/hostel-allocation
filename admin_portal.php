
<?php
  ob_start();
 session_start();
 include_once 'connection.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {
    
   $admin_no = trim($_POST['Admin_no']);
  $admin_no = strip_tags($admin_no);
  $admin_no = htmlspecialchars($admin_no);

  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  
   // basic admission number validation
 if (empty($admin_no)) {
   $error = true;
   $admError = "Please enter your full admission number.";
  } else if (strlen($admin_no) < 12) {
   $error = true;
   $admError = "Admission number must have atleast 12 characters.";
  } 
  
   // check email exist or not
   $query = "SELECT Admission_no FROM users WHERE Admission_no='$admin_no'";
   $result = mysqli_query($con,$query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $admError = "Provided Admission Number is already registered.";
   }
  }
  // password validation
  // if (empty($pass)){
  //  $error = true;
  //  $passError = "Please enter Students ID Number";
  // } else if(strlen($pass) < 8) {
  //  $error = true;
  //  $passError = "ID Number must have atleast 8 characters.";
  // }
  
  // password encrypt using SHA256();
  $password = hash('sha256', $pass);
  
  // if there's no error, continue to signup
  if( !$error ) {
//     INSERT INTO archive_table(field1, field2, field3)
// SELECT field7, field8, field9 FROM original_table WHERE id = 1
$query = "INSERT INTO users(fname,lname,Admission_no,ID_no,phone_no,email,Gender,Disabled,image,userPass) SELECT fname,lname,admin_no,ID_no,phone_no,email,Gender,Disabled,image,'$password' FROM personal_details WHERE admin_no='$admin_no'";
  //  $query = "INSERT INTO users(Admission_no,userPass) VALUES('$admin_no','$password')";
   $res = mysqli_query($con,$query);
    
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered";
    echo "yeeeh";
    unset($admin_no);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
    echo "DANGER";
   } 
    
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>STUDENT REGISTRATION</title>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: blue;
  color: white;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active">REGISTER STUDENTS</a>
  <a href="unregister.php">UNREGISTER STUDENTS</a>
  <a href="reports.php">REPORTS</a>
  <a href="#contact">RESET ROOMS</a>
</div>
<div style="padding-left:16px">
 
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
			
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
				<form class="login100-form validate-form">
					<span class="login100-form-title">
						REGISTER STUDENTS
					</span>
<label>
              ADMISSION NUMBER<span class="req">*</span>
            </label>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="Admin_no" placeholder="Admission Number">
            <span class="focus-input100"></span>
            <span class="text-danger"><?php echo $admError; ?></span>
						<span class="symbol-input100">
							<i class="fa fa-address-card-o" aria-hidden="true"></i>
						</span>
					</div>
<label>
              ID NUMBER<span class="req">*</span>
            </label>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="text" name="pass" placeholder="ID NUMBER">
            <span class="focus-input100"></span>
            <span class="text-danger"><?php echo $passError; ?></span>
						<!-- <span class="symbol-input100">
						
							<i class="fa fa-lock" aria-hidden="true"></i>
							
						</span>
						<i onclick="myFunction2()" class="fa fa-fw fa-eye field-icon toggle-password"></i>
					</div> -->
					<style>
					.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
</style>
<!-- <script>
function myFunction2() {
  var x = document.getElementById("password-field");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script> -->
		
					<div class="container-login100-form-btn">
						<button type="submit" name="btn-signup" class="login100-form-btn">
							REGISTER
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
  </body>
</html>
<?php ob_end_flush(); ?>

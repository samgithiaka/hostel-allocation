<?php
 ob_start();
  
 if(!isset($_SESSION['user'])){
   header("Location:index.php");
}

 $error = false;
 
 if ( isset($_POST['btn-next']) ) {
  
  // clean user inputs to prevent sql injections
  $fname = trim($_POST['fname']);
  $fname = strip_tags($fname);
  $fname = htmlspecialchars($fname);

   $lname = trim($_POST['lname']);
  $lname = strip_tags($lname);
  $lname = htmlspecialchars($lname);
  
   $admin_no = trim($_POST['admin_no']);
  $admin_no = strip_tags($admin_no);
  $admin_no = htmlspecialchars($admin_no);

   $ID_no = trim($_POST['ID_no']);
  $ID_no = strip_tags($ID_no);
  $ID_no = htmlspecialchars($ID_no);

   $phone_no = trim($_POST['phone_no']);
  $phone_no = strip_tags($phone_no);
  $phone_no = htmlspecialchars($phone_no);

   $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

   $Gender = trim($_POST['Gender']);
  $Gender = strip_tags($Gender);
  $Gender = htmlspecialchars($Gender);

  $disabled = trim($_POST['disabled']);
  $disabled = strip_tags($disabled);
  $disabled = htmlspecialchars($disabled);
 
 //image
 $target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

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
    
 if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } 
 
if(isset($_POST['disabled'])){
   $disabled = true;
   
}else{
   $disabled = false;
   
}
  
if( !$error ) {
  $query = "INSERT INTO personal_details(fname,lname,admin_no,ID_no,phone_no,email,gender,Disabled,image) VALUES('$fname','$lname','$admin_no','$ID_no','$phone_no','$email','$Gender','$disabled','$target_file')";
   $res = mysqli_query($con,$query);
 
     //basic email validation
     
   if ($res) {
   //  $_SESSION['user'] = $row['user_id'];
    header("Location: nextofkin.php");
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
} }
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="detailsstyle.css" type="text/css" />
<body>
<h2>Please enter your details in the personal details table below</h2>

 <div id="details-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">PERSONAL DETAILS FORM</h2>
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
          <span class="text-danger"><?php echo $fnameError; ?></span>
 </div>
          
            <label>
              Last Name<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="lname" required autocomplete="off"/>
          </div>
<span class="text-danger"><?php echo $lnameError; ?></span>
           </div>

            <label>
              Admission number<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="character" name="admin_no" required autocomplete="off"/>
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
              Gender<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="Gender" required autocomplete="off"/>
          </div>

          <label>
              disabled
            </label>
          
             <div class="form-group">
            
                
            <input type="checkbox" value="1" name="disabled" checked="FALSE" />

          </div>
         

         <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-next">NEXT</button>
            </div>
            
 
</form>
    
</body>
</html>
<?php ob_end_flush(); ?>

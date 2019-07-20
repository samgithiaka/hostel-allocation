<?php
  include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<Title>TUK HOSTELS</Title>
<link rel="icon" type="image/ico" href="img/logo.png" />
<link rel="stylesheet" href="indexstyle.css" type="text/css" />
<style>
.mySlides {display:none;}
</style>
</head>

<body background="none">

<h2 class="w3-center">WELCOME TO TUK HOSTELS</h2>



<div class="container">

 <div id="login-form">
    <form method="POST" autocomplete="on">
    
     <div class="col-md-12">
        <h3>Do you have an existing account?</h3>
         <div class="form-group">
             <h2 class="">log in.</h2>
            </div>
        
         <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
           <label>
              Admission Number<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="Admin_no"  placeholder="Enter Admission number" maxlength="50" value="<?php echo $admin_no ?>" />
                </div>
                <span class="text-danger"><?php echo $admError; ?></span>
            </div>
            
            <label>
              PASSWORD<span class="req">*</span>
            </label>
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" value="" class="form-control"  maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-login">Log In</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            <h3>Don't you have an account yet?</h3>
            <div class="form-group">
             <a href="Register.php">Sign Up Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>
<?php ob_end_flush(); ?>

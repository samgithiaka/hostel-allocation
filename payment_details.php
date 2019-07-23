<?php
 ob_start();
 session_start();
 if(!isset($_SESSION['username'])){
    header("Location:index.php");
 }elseif(!isset($_SESSION['apply'])){
  header("Location:no_page.php");
}
  require_once 'connection.php'; 
 
  $error = false;
 
  
 if ( isSET($_POST['btn-stkPush']) ) {
 
  $phone_no1 = trim($_POST['mpesa_phone_no']);
  $phone_no1 = strip_tags($phone_no1);
  $phone_no1 = htmlspecialchars($phone_no1);

  $amount = trim($_POST['amount']);
  $amount = strip_tags($amount);
  $amount = htmlspecialchars($amount);

  $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    
  $curl = curl_init();
  curl_SETopt($curl, CURLOPT_URL, $url);
  curl_SETopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type:application/json',
      'Authorization:Bearer 9oNLWiTbQirNsSHJ3ZPgIDxmaHPH'
  )
  ); //SETting custom header
  

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => '174379',
    'Password' => 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTkwNjE3MTY1MzAw',
    'Timestamp' => '20190617165300',
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone_no1,
    'PartyB' => '174379',
    'PhoneNumber' => $phone_no1,
    'CallBackURL' => 'https://71b67119.ngrok.io/hooks/mpesa',
    'AccountReference' => 'test',
    'TransactionDesc' => 'test'
  );
  
  $data_string = json_encode($curl_post_data);
  
  curl_SETopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_SETopt($curl, CURLOPT_POST, true);
  curl_SETopt($curl, CURLOPT_POSTFIELDS, $data_string);
  
  $curl_response = curl_exec($curl);
  if (strpos($curl_response, 'Success') !==false) {
    $_SESSION['payment']="SUCCESS";
   header("Location: payment_confirmation.php");
    $errTyp3 = "success";
    $errMSG3 = "Successfully sent stkpush on phone";
   
    echo "Success. Request accepted for processing";
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
    echo $curl_response;
    echo "danger";
   } 
 // print_r($curl_response);
 // echo $curl_response;
      }

        

 ?>
<!DOCTYPE html>
<html>


       <link rel="stylesheet" href="Registerstyle.css" type="text/css" /> 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container-details">

			<div class="wrap-details">
      <p><a href="apply.php" class="btn-back">&#8592; BACK</a></p>
      <div class="wrap-form">
      
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">



<label>
              Mpesa number<span class="req">*</span>
            </label>
             <div class="form-group">
             <div>
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="integer" placeholder="254xxxxxxx" class="input100" name="mpesa_phone_no" value= "<?php echo $phone_no1 ?>" required autocomplete="off"/>
            <span class="focus-input100"></span>
          </div>
          <span class="text-danger"><?php echo $phone_noError; ?></span>
           </div>
           Amount<span class="req">*</span>
            </label>
             <div class="form-group">
             <div>
                
            <input type="integer"  class="input100" name="amount" value= "<?php echo $amount ?>" required autocomplete="off"/>
            <span class="focus-input100"></span>
          </div>
          <span class="text-danger"><?php echo $phone_noError; ?></span>
           </div>

           
<div class="form-group">
            <button type="submit" class="login100-form-btn" name="btn-stkPush">PAY VIA MPESA</button>
             <!-- <button type="submit"  class="btn btn-block btn-primary" name="btn-checkresult">CHECK RESULT</button> -->
            </div>
            </form>
    </div>
    </div>
    </div>
           
</body>
</html>
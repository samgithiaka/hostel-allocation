<?php
 ob_start();
 include('session2.php');
 
 if(!isset($_SESSION['username'])){
   header("Location: student_login.php");
}
 require_once 'connection.php'; 

 $error = false;
   
 if ( isset($_POST['btn-apply']) ) {
  
$hostel= ($_POST['hostel']);
$duration= ($_POST['duration']);
if( !$error ) {
      $studid=$_SESSION['username'];
 $sql8="UPDATE `users` SET `hostel` = '$hostel'  WHERE `user_id` ='$studid'";
    $res=mysqli_query($con,$sql8);
     $sql11="UPDATE `users` SET `duration` = '$duration'  WHERE `user_id` ='$studid'";
    $res=mysqli_query($con,$sql11);
   if ($res) {
    header("Location: payment_details.php");
    $errTyp = "success";
    $errMSG = "Successfully applied";
    echo "success";
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
    echo "danger";
   } }}


  ?>
 <!DOCTYPE html>
<html>
<head>
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script> 
<script type="text/javascript" src="tablesort.js"></script> 
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/tablesort.css">

<style>
        .split {
  height: 90%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 0px;
  padding:30px;
}

/* Control the left side */
.left {
  left: 0;
  background-color: #7ef542;
}

/* Control the right side */
.right {
  padding:30px;
  right: 0;
  background-color:#4bf542;
}
label{
  color:white;
}

        </style>
</head>
<!-- <link rel="stylesheet" href="applystyle.css" type="text/css" /> -->
<body onload="rotateTable()">
<div class="split right">
  <div class="centered">
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
   
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
     <label>
              Select Hostel<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <select name="hostel">
    <option value="TUK MEN HOSTEL" name="men_hostel" >TUK MEN HOSTEL</option>
    <option value="TUK LADIES HOSTEL" name="ladies_hostel">TUK LADIES HOSTEL</option>/>
  
    </select>
          </div>
               </div>
<label>
           Select Duration Of Stay<span class="req">*</span>
            </label>
             <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <select name="duration">
      <option value="ONE MONTH">ONE MONTH</option>
      <option value="TWO MONTHS">TWO MONTHS</option>
      <option value="THREE MONTHS">THREE MONTHS</option>
      <option value="FOUR MONTHS">FOUR MONTHS</option>
 
    </select>
</div>
          </div>
          <br/>
          <br/>

      <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-apply">APPLY</button>
            </div>
           
      
  
      </form>
    </div>
  </div>


<div class="split left">
  <div class="centered">
  <h1></h1>
   
    <button type="button" onclick="printFunction()">
            Print Form
         </button>
         
    <table style="width:100%">
        <thead>
  <tr id="tr">
        <th>STUDENT PERSONAL DETAILS</th>
        <!-- <th class="ctable-sort">Date:</th> -->
    <th>Admission Number</th>
       <th class="table-sort">First Name</th>
       <th>Last Name</th>
       <th>ID NUMBER</th>
       <th>Phone</th>
        <th>Email</th>
        <th>Hostel</th>
        <th>Room</th>
        <th>Duration</th>
</thead>
  <?php 
$studid=$_SESSION['username'];
  $i=1;
  $query="SELECT * FROM users WHERE user_id=$studid";
	$res=mysqli_query($con, $query);
	$count=mysqli_num_rows($res);
	if($count>0)
	{
	while($row=mysqli_fetch_array($res))
	{
  
?>
<tbody>

     <tr>
        <td><?php echo ""; ?></td>  
      <td><?php echo $row['Admission_no'];?></td>
      <td><?php echo $row['fname'];?></td>
      <td><?php echo $row['lname'];?></td>
      <td><?php echo $row['ID_no'];?></td>
      <td><?php echo $row['phone_no'];?></td>
      <td><?php echo $row['email'];?></td>
      <td><?php echo $row['Room_no'];?></td>
      <td><?php echo $row['hostel'];?></td>
      <td><?php echo $row['duration'];?></td>
    </tr> 
	<?php $i++;}}else{
		 echo "No record Found!";
    echo $studid;
    echo $count;
	} ?>
  </tbody>
</table>
<script type="text/javascript">
            // For Demo Purposes
            $(function () {
                $('table.table-sort').tablesort();
                hljs.initHighlightingOnLoad(); // Syntax Hilighting
            });
        </script>
    
    <script>
                    function rotateTable() {
                     
                      $("table").each(function() {
        var $this = $(this);
        var newrows = [];
        $this.find("tr").each(function(){
            var i = 0;
            $(this).find("td, th").each(function(){
                i++;
                if(newrows[i] === undefined) { newrows[i] = $("<tr></tr>"); }
                if(i == 1)
                    newrows[i].append("<th>" + this.innerHTML  + "</th>");
                else
                    newrows[i].append("<td>" + this.innerHTML  + "</td>");
            });
        });
        $this.find("tr").remove();
        $.each(newrows, function(){
            $this.append(this);
        });
    });
    
    return true;
}

                    </script>
             <script>
                    function printFunction() {
                      window.print();
                    }
                    </script>
  </div>
</div>

</body>
</html>
<?php ob_end_flush(); ?>
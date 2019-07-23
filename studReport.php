<?php
ob_start();
include('session2.php');
if(!isset($_SESSION['username'])){
   header("Location:index.php");
}elseif(!isset($_SESSION['confirmation'])){
  header("Location:no_page.php");
}
 require_once 'connection.php'; 

 
?>
<!DOCTYPE html>
<html>
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script> 
<script type="text/javascript" src="tablesort.js"></script> 
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/tablesort.css">
<link rel="stylesheet" href="Registerstyle.css" type="text/css" /> 
<p><a href="payment_confirmation.php" class="btn-back">&#8592; BACK</a></p>
<h6> <a href="logout.php" class="btn-logout">LOGOUT</a></h6>
<style>
h6{
    line-height: 12px;
    width: 18px;
    font-size: 15pt;
    font-family: tahoma;
    margin-top: 10px;
    margin-right: 100px;
    position:absolute;
    top:0;
    right:0;
}
</style>
<h1></h1>
   <body onload="rotateTable()">
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
        <th>Allocation Date</th>
        <th>Payment Status</th>
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
      <td><?php echo $row['allocation_date'];?></td>
      <td><?php echo $row['payment_status'];?></td>
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
                    <body>
                    </html>
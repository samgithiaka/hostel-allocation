
<!DOCTYPE html>
<html>
  
<head> 
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script> 
<script type="text/javascript" src="tablesort.js"></script> 

<link rel="stylesheet" type="text/css" href="css/tablesort.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="Registerstyle.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

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
  background-color: #4CAF50;
  color: white;
}

    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}

th, td {
    padding: 15px;
}

table {
    border-spacing: 5px;
}

</style>

<div class="topnav">
  <a  href="admin_portal.php">REGISTER STUDENTS</a>
  <a href="unregister.php" >UNREGISTER STUDENTS</a>
  <a class="active">REPORTS</a>
  <a href="reset_rooms.php">RESET ROOMS</a>
</div>
<h1>Students Record</h1>
   
    <button type="button" onclick="printFunction()">
            Print Form
         </button>
         
    <table style="width:100%" class="table-sort table-sort-search table-sort-show-search-count" id="ex-table">
        <thead>
  <tr id="tr">
        <th>Serial No:</th>
        <!-- <th class="ctable-sort">Date:</th> -->
    <th>Admission Number</th>
       <th class="table-sort">First Name</th>
       <th>Last Name</th>
       <th>ID NUMBER</th>
       <th>Phone</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Disability</th>
        <th>Image for Disabled</th>
        <th>Hostel</th>
        <th>Room</th>
        <th>Duration</th>
        <th>Payment Status</th>
</thead>


  <?php 
  session_start();
include "connection.php";
  $i=1;
  $query="Select * from users";
	$res=mysqli_query($con, $query);
	$count=mysqli_num_rows($res);
	if($count>0)
	{
	while($row=mysqli_fetch_array($res))
	{
  
?>
<tbody>

     <tr>
        <td><?php echo $i; ?></td>  
      <td><?php echo $row['Admission_no'];?></td>
      <td><?php echo $row['fname'];?></td>
      <td><?php echo $row['lname'];?></td>
      <td><?php echo $row['ID_no'];?></td>
      <td><?php echo $row['phone_no'];?></td>
      <td><?php echo $row['email'];?></td>
      <td><?php echo $row['Gender'];?></td>
      <td><?php echo $row['Disabled'];?></td>
      <td><?php echo $row['image'];?></td>
      <td><?php echo $row['hostel'];?></td>
      <td><?php echo $row['Room_no'];?></td>
      <td><?php echo $row['duration'];?></td>
      <td><?php echo $row['payment_status'];?></td>
    </tr> 
	<?php $i++;}}else{
		 echo "No record Found!";
		
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
                    function printFunction() {
                      window.print();
                    }
                    </script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script> 
<script type="text/javascript" src="tablesort.js"></script> 
<link rel="stylesheet" type="text/css" href="css/tablesort.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <link rel="stylesheet" href="Registerstyle.css" type="text/css" /> -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
.button {
  font: bold 11px Arial;
  text-decoration: none;
  background-color: rgb(243,0,107);
  color: white;
  padding: 2px 6px 2px 6px;
  border-top: 1px solid #CCCCCC;
  border-right: 1px solid #333333;
  border-bottom: 1px solid #333333;
  border-left: 1px solid #CCCCCC;
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
</style>
</head>
<body>

<div class="topnav">
  <a  href="admin_portal.php">REGISTER STUDENTS</a>
  <a class="active" >UNREGISTER STUDENTS</a>
  <a href="reports.php">REPORTS</a>
  <a href="reset_rooms.php">RESET ROOMS</a>
</div>
<div style="padding-left:16px">
<h1>Students Record</h1>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
    <th>Serial No</th>
      <th>Admission Number</th>
      
    </tr>
  </thead>
  <tbody>
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
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row['Admission_no'];?></td>
	  <td>  <a href="delete_student.php?admin_no=<?php echo $row['Admission_no'];?>" class="button">Unregister</a></td>
    </tr>
	<?php $i++;}}else{
		 echo "No record Found!";
		
	} ?>
  </tbody>
</table> 
</div>
</div>
<script type="text/javascript">
            // For Demo Purposes
            $(function () {
                $('table.table-sort').tablesort();
                hljs.initHighlightingOnLoad(); // Syntax Hilighting
            });
        </script>
</html>
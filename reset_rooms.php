
<!DOCTYPE html>
<html>
<head>
<script src="http://yandex.st/highlightjs/7.3/highlight.min.js"></script> 
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script> 
<script type="text/javascript" src="tablesort.js"></script> 
<link rel="stylesheet" type="text/css" href="css/tablesort.css">
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
<link rel="stylesheet" href="Registerstyle.css" type="text/css" />
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<style>
        .split {
  height: 100%;
  width: 50%;
  position: fixed;
  z-index: 1;
  top: 40;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Control the left side */
.left {
  left: 0;

}

/* Control the right side */
.right {
  right: 0;
  
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
.btn-logout{
  line-height: 12px;
    font-family: tahoma;
    margin-top: 10px;
    margin-right: 100px;
    position:absolute;
    top:0;
    right:0;
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
  <a  href="unregister.php">UNREGISTER STUDENTS</a>
  <a href="reports.php">REPORTS</a>
  <a class="active">RESET ROOMS</a>
  <a href="logout.php" class="btn-logout">LOGOUT</a>
</div>

<div style="padding-left:16px">
<div class="split left">
  <div class="centered">
<h1>Female Students Rooms Record</h1>
<a href="reset_all.php" class="button">RESET ALL FEMALE ROOMS</a>
<!-- <table class="table table-striped table-hover "> -->
<table style="width:100%" class="table table-striped table-hover" >
        <thead>
  <tr id="tr">
      <th>Room Number</th>
      <th>Room status</th>
      <th>Room occupants</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  include('session2.php');
  if(!isset($_SESSION['username1'])){
    header("Location: index.php");
    exit;
  }
include "connection.php";
  $query="Select * from female_rooms";
	$res=mysqli_query($con, $query);
	$count=mysqli_num_rows($res);
	if($count>0)
	{
	while($row=mysqli_fetch_array($res))
	{
  
  ?>
    <tr>
      <td><?php echo $row['Room_no']; ?></td>
      <td><?php echo $row['Status'];?></td>
       <td><?php echo $row['occupants'];?></td>
	  <td> <a href="reset.php?room_no=<?php echo $row['Room_no'];?>" class="button">Reset</a></td>
    </tr>
	<?php }}else{
		 echo "No record Found!";
		
	} ?>
  </tbody>
</table> 

</div>
</div>
</div>

<div class="split right">
  <div class="centered">
<h1>Male Students Rooms Record</h1>
<a href="reset_all_male.php" class="button">RESET ALL MALE ROOMS</a>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>Room Number</th>
      <th>Room status</th>
      <th>Room occupants</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  session_start();
include "connection.php";
  $query="Select * from male_rooms";
	$res=mysqli_query($con, $query);
	$count=mysqli_num_rows($res);
	if($count>0)
	{
	while($row=mysqli_fetch_array($res))
	{
  
  ?>
    <tr>
      <td><?php echo $row['Room_no']; ?></td>
      <td><?php echo $row['Status'];?></td>
       <td><?php echo $row['occupants'];?></td>
	  <td> <a href="reset_male.php?room_no=<?php echo $row['Room_no'];?>" class="button">Reset</a></td>
    </tr>
	<?php }}else{
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
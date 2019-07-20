<?php

  define('admin', TRUE);
?>
<!DOCTYPE html>
<html>
  <link rel="stylesheet" href="indexstyle.css" type="text/css" />
<head>
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
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
 

<div class="topnav">
  <a class="active" href="index.php">Home</a>
  <a href="admin_login.php">LOGIN AS ADMIN</a>
  <a href="student_login.php">LOGIN AS STUDENT</a>
 
</div>
 <h1> WELCOME TO TUK HOSTELS</h1>
 <div class="split left">
  <div class="centered">
    <img src="img/menhostel.jpg" alt="men hostel">
    <h2>TUK MEN HOSTEL</h2>
    <p>SOUTH B</p>
  </div>
</div>

<div class="split right">
  <div class="centered">
    <img src="img/ladieshostel.jpg" alt="ladies hostel">
    <h2>TUK LADIES HOSTEL</h2>
    <p>UPPERHILL</p>
  </div>
</div>
</body>
</html>
<?php ob_end_flush(); ?>

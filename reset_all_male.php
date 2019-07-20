<?php
session_start();
include "connection.php";

	
	// $query="update `male_rooms` set 'Status'='0' where `Status`='$status'";
	 $query="UPDATE male_rooms SET Status=0,occupants=0 ";
	
	$res=mysqli_query($con,$query);
	if($res){
		$_SESSION['success']="successfully Reset!";
		header('Location:reset_rooms.php');
	}else{
		echo "Not reset , please try again!";
	}

?>
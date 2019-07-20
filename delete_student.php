<?php
session_start();
include "connection.php";
$admin_no=$_GET['admin_no'];
	
	$query="delete from `users` where `Admission_no`='$admin_no'";
	
	$res=mysqli_query($con,$query);
	if($res){
		$_SESSION['success']="Delete Successfully successfully!";
		header('Location:unregister.php');
	}else{
		echo "Not Deleted , please try again!";
	}

?>
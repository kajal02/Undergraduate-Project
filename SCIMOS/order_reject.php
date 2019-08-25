<?php

	session_start();
	$uid= $_SESSION['name'];
	$date = $_SESSION['date'];
	$pid = $_SESSION['pid'];
	$orderfrom = $_SESSION['orderfrom'];
	
	
	$type=$_SESSION['type'];
	$con = mysqli_connect("localhost","root",null,"scimos");

	if(! $con)
	{
		die('Connection Failed'.mysql_error());
	}

	mysqli_select_db($con, "scimos");
	
	
	$deleteorder = mysqli_query($con ,"DELETE FROM `all_orders` WHERE date='$date' && pid = '$pid' && orderfrom = '$orderfrom'");
	if($deleteorder)
		echo 'true';
	else
		echo 'false';
	

?>
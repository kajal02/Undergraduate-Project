<?php

	session_start();
	$uid= $_SESSION['name'];
	$date = $_SESSION['date1'];
	$pid = $_SESSION['pid1'];
	$pname = $_SESSION['pname1'];
	$orderfrom = $_SESSION['orderfrom1'];
	
	if (isset($_POST["reject"])) {
	
        $_SESSION['order_status'] = "reject";
		
    } else {
        $_SESSION['order_status'] = "accept";
    }
	
	$order_status = $_SESSION['order_status'];
	
	
	$type=$_SESSION['type'];
	$con = mysqli_connect("localhost","root",null,"scimos");

	if(! $con)
	{
		die('Connection Failed'.mysql_error());
	}
	mysqli_select_db($con, "scimos");
	
	$fetchorder = mysqli_query($con ,"DELETE FROM `all_orders` WHERE order_to = '$uid' && order_from = '$orderfrom' && date = '$date' && pid = '$pid'");

	$message = "";
	if($order_status == "reject") //reject order
	{
	echo 'reject order';
		$message = "Your order has been rejected!
		"."Order details:
		To : ".$orderfrom."
		Date : ".$date."
		Product ID : ".$pid."
		Product Name : ".$pname."
		Supplier/Manufacturer ID : ".$uid;
		
	}
	if($order_status == "accept") //accept order
	{
		echo 'accepted';
			$message = "Your order has been accepted and you'll receive it within 2-3 days!
		"."Order details:
		To : ".$orderfrom."
		Date : ".$date."
		Product ID : ".$pid."
		Product Name : ".$pname."
		Supplier/Manufacturer ID : ".$uid;
	
	}
	
	$check= mail("demo@localhost.com","Scimos",$message, "From: scimos@localhost.com");
			if($check== true)
				echo 'done email';
			else
				echo 'not sent';

	
	unset($_SESSION['order_status']);

?>
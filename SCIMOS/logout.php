<?php
		session_start();
		unset($_SESSION['name']);
		unset($_SESSION['type']);
		unset($_SESSION['fname']);
		$_SESSION['status']= false;
		header("location: index.php");
		$_SESSION['logged_in'] = false;
		unset($_SESSION['final_stock']);
		unset($_SESSION['pid1']);
		unset($_SESSION['pname1']);
		unset($_SESSION['date1']);
		unset($_SESSION['orderfrom1']);
		
		
		
?>

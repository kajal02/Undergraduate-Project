<?php

	session_start();
	$uid= $_SESSION['name'];
	$type=$_SESSION['type'];
	$final_stock = $_SESSION['final_stock'];
	$rem_stock = $_POST["rem_stock"];
	$con = mysqli_connect("localhost","root",null,"scimos");

	if(! $con)
	{
		die('Connection Failed'.mysql_error());
	}

	mysqli_select_db($con, "scimos");

	$dt= date("d/m/Y");
	$from= $uid;
	$fetchprodids = mysqli_query($con , "SELECT `pid` from `user_products` where uid= '$uid'");
	$ans = mysqli_fetch_all($fetchprodids, MYSQL_BOTH);
	
	$products= array();
	foreach($ans as $a)
	{
		array_push($products , $a[0]);
	}
	$fields_num = mysqli_num_rows($fetchprodids);
	$dataArray= array();
	
    foreach($ans as $cf)
	{
	 array_push($dataArray, $cf[0]);	
	}
	
	for($i=0; $i<$fields_num; $i++)
	{
		$pid= $dataArray[$i];
		
		$stock= $final_stock[$i] - $rem_stock[$i];
		
		$fetchmanu = mysqli_query($con , "SELECT `company_name` from `company_products_all` where pid= '$dataArray[$i]'");
		$ans = mysqli_fetch_row($fetchmanu);
		
		$to= $ans[0];
		$fetchmanu = mysqli_query($con , "insert into `all_orders` values('$dt', '$pid', $stock, '$from', '$to')");
	}

?>
<?php
session_start();

// Make sure we connected succesfully
$con = mysqli_connect("localhost","root",null,"scimos");

if(!$con)
{
    die('Connection Failed'.mysql_error());
}
mysqli_select_db($con, "scimos");

$uid = $_SESSION['name'];

	$products_id = $_POST["prod_id"];
	$products_name = $_POST["prod_name"];
	$products_price = $_POST["prod_price"];
	$c = 0;
	for($j=0; $j<5; $j++)
	{
	 if($products_id[$j]=='')
	 {
		$c= $j;
		break;
	 }
	 
	if($j == 4)
		$c = 5;
	}
	if($c == 0)
	{
	 $_SESSION['empty'] = true;
	 header("location: manufacturer_pre_home.php");
	 }
	else 
   {	
	$table_name= $uid.'_history';
	$query1 = mysqli_query($con, "create table `$table_name` (`pid` varchar(30), `week` int,`manufacturer` varchar(30))");
	mysqli_query($con, $query1);
	$table_name1= $uid.'_chromo';
	$query2 = mysqli_query($con, "create table `$table_name1` (`pid` varchar(30) ,`mid` varchar(30))");
	
		$_SESSION['step'] = $_SESSION['step']+1;		
		for($i=0;$i< $c; $i++)
		{
			$p1= $products_id[$i];
			$p2= $products_name[$i];
			$p3= $products_price[$i];
			
			$query = mysqli_query($con, "INSERT INTO `company_products_all` (`pid`, `product_name`, `company_name`, `price`) VALUES ('$p1', '$p2', '$uid', '$p3')");
			mysqli_query($con, $query);
		$query3 = mysqli_query($con, "INSERT INTO `$table_name1` (`pid`, `mid`) VALUES ('$p1', '$uid')");
	
	}	
		
	header("location: upload_history.php");
	}	
	
?>
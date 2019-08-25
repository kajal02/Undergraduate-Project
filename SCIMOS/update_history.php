<?php
session_start();
// Grab User submitted information
$products = $_POST["prod"];
$date = $_POST["date"];

$count = count($products);
echo $count;

if($_SESSION['status'] ==  true)
{

// Connect to the database
$con = mysqli_connect("localhost","root",null,"scimos");

// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysqli_select_db($con, "scimos");

$uid = $_SESSION['name'];
$fetchprodids = mysqli_query($con , "select pid from `company_products_all` where company_name = '$uid'");
$ans = mysqli_fetch_all($fetchprodids, MYSQL_BOTH);

$prodids = array();
$count = count($ans);
$i = 0;
foreach($ans as $a)
{
	$temp = $a[0];
	array_push($prodids , $temp);
}

for($i = 0;$i < $count;$i++)
{
$currentpid = $prodids[$i];
$currentamt = $products[$i];
$updatequery = mysqli_query($con , "INSERT INTO `remaining_stock`(`Date`, `uid`, `pid`, `amount`) VALUES ('$date' , '$uid' , '$currentpid','$currentamt')");
}
echo 'updated';




}

?>
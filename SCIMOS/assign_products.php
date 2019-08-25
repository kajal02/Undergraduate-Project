<?php

// Grab User submitted information
$uid = $_POST["uid"];
$user_prods_array = $_POST['user_products'];

// Connect to the database
$con = mysqli_connect("localhost","root",null,"scimos");

// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysqli_select_db($con, "scimos");

foreach($user_prods_array as $value) {
  $query = mysqli_query($con,"INSERT INTO `user_products`(`uid`, `pid`) VALUES ('$uid','$value')");
	mysqli_query($con, $query);

}

?>
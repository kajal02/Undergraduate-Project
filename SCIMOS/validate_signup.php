<?php

// Grab User submitted information
$uid = $_POST["uid"];
$pass = $_POST["pwd"];
$uname = $_POST["uname"];
$comp = $_POST["company"];
$email = $_POST["email"];
$type = $_POST["type"];

// Connect to the database
$con = mysqli_connect("localhost","root",null,"scimos");

// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysqli_select_db($con, "scimos");

$check_unique_uid = mysqli_query($con, "SELECT * FROM `users` where `uid`='$uid'");
$check_unique_email = mysqli_query($con, "SELECT * FROM `users` where `email`='$email'");


$uid_fields = mysqli_num_rows($check_unique_uid);

$email_fields = mysqli_num_rows($check_unique_email);

if($uid_fields == 0 && $email_fields == 0)
{
	$query = mysqli_query($con,"INSERT INTO `users`(`name`, `uid`, `email`, `password`, `type`,`company`) VALUES ('$uname','$uid','$email','$pass','$type','$comp')");
	mysqli_query($con, $query);
	
	session_start();
	 $_SESSION['status']= true;
	 $_SESSION['name']=$uid;
	 $_SESSION['fname'] = $uname;
	 $_SESSION['type']=$type;
	$_SESSION['step']=1;
	 switch($type)
	 {
	 case "supplier":
        header("location: supplier_pre_home.php");
        break;
     case "retailer":
        header("location: supplier_pre_home.php");
        break;
     case "manufacturer":
        header("location: manufacturer_pre_home.php");
        break;
	 }	
}
else if($uid_fields > 0)
{
	
printf ("Username already exists");

}
else if($email_fields > 0)
{
printf ("Email address is already registered");

}
else
{
printf ("Username and Email address already exist");

}

?>
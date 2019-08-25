<?php

// Connect to the database
$con = mysqli_connect("localhost","root",null,"scimos");
$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['msg'];

// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}
echo 'cuming here';
// Select the database to use
mysqli_select_db($con, "scimos");
$message = "Name : ".$name."
Message : ".$msg."
From : ".$email;

		$check= mail("demo@localhost.com","Scimos",$message, "From: scimos@localhost.com");
			if($check== true)
				echo 'done email';
			else
				echo 'not sent';

?>
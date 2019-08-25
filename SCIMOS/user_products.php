<?php
	session_start();
	
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
	
	
	if(!empty($_POST['user_product'])) 
    {
	 // Counting number of checked checkboxes.
	 $checked_count = count($_POST['user_product']);
	 if($checked_count >5)
		echo 'Maximum 5 products are allowed';
	 else
	 {
		$_SESSION['step'] = $_SESSION['step']+1;
		// Loop to store and display values of individual checked checkbox.
		$i = 0;
		
		foreach($_POST['user_product'] as $selected)
		{
			$query = mysqli_query($con,"INSERT INTO `user_products`(`uid`, `pid`) VALUES ('$uid','$selected')");
			mysqli_query($con, $query);
			$query = mysqli_query($con,"SELECT `company_name` FROM `company_products_all` WHERE `pid`= '$selected'");
			$manu_name= mysqli_fetch_row($query);
			$query = mysqli_query($con,"SELECT `email` FROM `users` WHERE `uid`= '$manu_name[0]'");
			$manu_email= mysqli_fetch_row($query);
			
			$msg="Dear ".$manu_name[0].',
'.$uid.' is now supplying your product '.$selected.'. 



Thank you
'.'Receiver\'s Email Id : '.$manu_email[0];
			$msg = wordwrap($msg, 70);
			$check= mail("demo@localhost.com","Scimos",$msg, "From: scimos@localhost.com");
			if($check== true)
				echo 'done email';
			else
				echo 'not sent';
			
			$i++;
		}
		header("location: upload_history.php");
	 }
    }
	else
	{
	 echo "<b>Please Select Atleast One Option.</b>";
	}

?>
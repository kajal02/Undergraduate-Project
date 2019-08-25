
<?php
 session_start();
// Grab User submitted information

$uid = $_POST["uid"];
$pass = $_POST["pwd"];

// Connect to the database
$con = mysqli_connect("localhost","root",null,"scimos");

// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysqli_select_db($con, "scimos");

$result = mysqli_query($con,"SELECT type, name, uid, password FROM users WHERE uid = '$uid'");

$row = mysqli_fetch_array($result, MYSQL_BOTH);
$temp = false;
$log_type = $row["type"];
$sname = $row["name"];
$_SESSION['checkuid']=false;
//checking empty o not///////////////////
	if($_POST["uid"]=='')
	{
	header("location: index.php");
	}
	if($_POST["pwd"]=='')
	{
	header("location: index.php");
	}

	if($row["uid"]==$uid && $row["password"]==$pass) 
    {
	 $temp = true;
	
	 $_SESSION['status']= true;
	 
	 $_SESSION['name']=$uid;
	 $_SESSION['fname'] = $sname;
	 $_SESSION['type']=$log_type;
	 
	 $_SESSION['logged_in']= true;
	 
	 switch($log_type)
	 {
	 case "supplier":
        header("location: supplier_home.php");
        break;
     case "retailer":
        header("location: retailer_home.php");
        break;
     case "manufacturer":
        header("location: manufacturer_home.php");
        break;
	 }
	 
	}
else
{
	$_SESSION['valid']=true;
	header("location: index.php");
}
	
?>

<!--jQuery-->

<?php
session_start();
$uid = $_SESSION['name'];
// Connect to the database
$con = mysqli_connect("localhost","root","","scimos");


// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
$db = mysqli_select_db($con, "scimos");
$databasetable = "YOUR_TABLE";

/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'historytest.xlsx'; 
$table_name= $uid.'_history';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$type = $_SESSION['type'];

if($type == 'manufacturer')
{

for($i=2;$i<=$arrayCount;$i++)
{
$pid = trim($allDataInSheet[$i]["A"]);
$week = trim($allDataInSheet[$i]["B"]);
$manufacturer = trim($allDataInSheet[$i]["C"]);

$insertTable= mysqli_query($con,"insert into `$table_name`(pid , week , manufacturer) values('$pid', '$week', '$manufacturer');");
}
header("location: manufacturer_home.php");
}
if($type == 'supplier')
{
	
	//////echo 'i am a supp';
//$productid = array();	
$tabletemp = mysqli_query($con, "create table `productids` (pid varchar(8)) ");
for($i = 2;$i < $arrayCount;$i++)
{
	$temp = trim($allDataInSheet[$i]["A"]);
	//array_push($productid, $temp);
	$hey = mysqli_query($con,"insert into productids(pid) values ('$temp')");
}


$sid = $_SESSION["name"];

$check_unique_pid = mysqli_query($con, "SELECT company_name FROM `company_products_all` where pid IN (select * from `productids`)");
$uid_fields = mysqli_num_rows($check_unique_pid);
//////echo 'no of row = '.$uid_fields;

//for($k = 0;$k<$uid_fields;$k++)
//{
	
	$row = mysqli_fetch_all($check_unique_pid, MYSQLI_BOTH);
	foreach($row as $r)
	{  
	$table_name = $r['company_name'].'_history';
	//////echo 'table_name = '.$table_name; 
	$table_name1 = $r['company_name'].'_chromo';
	//////echo $table_name1;
	$alterquery = mysqli_query($con , "ALTER TABLE `$table_name` ADD `$sid` INT(25) AFTER `manufacturer`;");
	$alterquery1 = mysqli_query($con , "ALTER TABLE `$table_name1` ADD `$sid` varchar(25) AFTER `mid`;");	

	for($i=2;$i<=$arrayCount;$i++)
   {
	$pid = trim($allDataInSheet[$i]["A"]);
	$week = trim($allDataInSheet[$i]["B"]);
	$supp = trim($allDataInSheet[$i]["C"]);

	$result = mysqli_query($con,"SELECT company_name, pid FROM company_products_all WHERE pid = '$pid'");
	$row = mysqli_fetch_array($result, MYSQL_BOTH);
	$table_name = $row['company_name'].'_history';
	//////echo '<br>'.$table_name.' table<br>';
	////echo '<br>'.$pid.' pid<br>';
	
	//$findpidnweek = mysqli_query($con,"SELECT week FROM $table_name WHERE pid = '$pid'");
	//$row1 = mysqli_fetch_array($findpidnweek, MYSQL_BOTH);
	//$weekno = $row1['week'];
	////echo '<br>'.$weekno.'<br>kajdf';
	//////echo '<br>'.$week.'<br>kajdf';

	//////echo $sid;
	//////echo $r['company_name'];
	$temp1 = $r['company_name'];
	$updatequery = mysqli_query($con , "UPDATE `$table_name` SET `$sid`='$supp' WHERE `pid` = '$pid' && `week` = '$week'");
	//$updatequery1 = mysqli_query($con , "UPDATE `$table_name1` SET `$sid`= '$sid' WHERE `pid` = '$pid'"); //new query
	$updatequery1 = mysqli_query($con , "UPDATE `$table_name1` SET `$sid`= '$sid' WHERE `mid` = '$temp1'");
	
   }	
}

	$dropquery = mysqli_query($con , "drop table `productids`");

header("location: supplier_home.php");
}
if($type == 'retailer')
{
	////////echo 'hey i am retailer';
$tabletemp = mysqli_query($con, "create table `productids` (pid varchar(8)) ");
for($i = 2;$i < $arrayCount;$i++)
{
	$temp = trim($allDataInSheet[$i]["A"]);
	$hey = mysqli_query($con,"insert into productids(pid) values ('$temp')");
}


$sid = $_SESSION["name"];

$check_unique_pid = mysqli_query($con, "SELECT company_name FROM `company_products_all` where pid IN (select * from `productids`)");
$uid_fields = mysqli_num_rows($check_unique_pid);
////////echo 'no of row = '.$uid_fields;

	
	$row = mysqli_fetch_all($check_unique_pid, MYSQLI_BOTH);
	foreach($row as $r)
	{  
	$table_name = $r['company_name'].'_history';
	////////echo 'table_name = '.$table_name; 
	$table_name1 = $r['company_name'].'_chromo';
	////////echo $table_name1;
	$alterquery = mysqli_query($con , "ALTER TABLE `$table_name` ADD `$sid` INT(25) ");
	$alterquery1 = mysqli_query($con , "ALTER TABLE `$table_name1` ADD `$sid` varchar(25) ");	
	
	for($i=2;$i<=$arrayCount;$i++){
	$pid = trim($allDataInSheet[$i]["A"]);
	$week = trim($allDataInSheet[$i]["B"]);
	$supp = trim($allDataInSheet[$i]["C"]);

	$result = mysqli_query($con,"SELECT company_name, pid FROM company_products_all WHERE pid = '$pid'");
	$row = mysqli_fetch_array($result, MYSQL_BOTH);
	$table_name = $row['company_name'].'_history';

	//$findpidnweek = mysqli_query($con,"SELECT week FROM $table_name WHERE pid = '$pid'");
	//$row1 = mysqli_fetch_array($findpidnweek, MYSQL_BOTH);
	//$weekno = $row1['week'];
	$temp1 = $r['company_name'];

	$updatequery = mysqli_query($con , "UPDATE `$table_name` SET `$sid`='$supp' WHERE `pid` = '$pid' && `week` = '$week'");
	//$updatequery1 = mysqli_query($con , "UPDATE `$table_name1` SET `$sid`= '$sid' WHERE `pid` = '$pid'");
	$updatequery1 = mysqli_query($con , "UPDATE `$table_name1` SET `$sid`= '$sid' WHERE `mid` = '$temp1'");
	////////echo 'updating for '.$pid.' ';
}
}

$dropquery = mysqli_query($con , "drop table `productids`");

header("location: retailer_home.php");
}


?>
<body>
</html>
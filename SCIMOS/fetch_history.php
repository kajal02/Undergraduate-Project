<?php

session_start();
$cid= $_SESSION['name'];

$con = mysqli_connect("localhost","root",null,"scimos");

if(! $con)
{
    die('Connection Failed'.mysql_error());
}

mysqli_select_db($con, "scimos");

$table_name= $cid.'_history';
//echo $table_name;
$result = mysqli_query($con,"SELECT distinct pid from $table_name");
$row = mysqli_fetch_all($result, MYSQL_BOTH);
//echo $row['pid'];
$chromos[] = array();
$chromosome = array();

$k = 0;
$table_name= $cid.'_chromo';
 
foreach($row as $r)
{
$chromos[$k] = array();
echo 'CHROMOSOME OF PID : '.$r['pid'].'        ';
array_push($chromosome , $cid);
array_push($chromos[$k] , $cid);


 $cpid = $r['pid'];
 //echo $cpid;
 $findrespuid= mysqli_query($con, "SELECT * FROM `$table_name` WHERE pid = '$cpid'"); 
 $row1= mysqli_fetch_row($findrespuid);
 $count = count($row1);
 //echo $count;
 for($i = 2;$i<$count;$i++)
 {
	//echo $row1[$i];
	if($row1[$i] == NULL) ///////////////////here we can remove NULL values  - atasathi thevle ahet
	{	array_push($chromosome , "NULL");
		array_push($chromos[$k] , "NULL");
	}
	else
	{	array_push($chromosome, $row1[$i]);
		array_push($chromos[$k] , $row1[$i]);
	}
	
 }
 foreach($chromos[$k] as $c)
 {
	echo $c.'     ';
 }
 echo "<br><br><br>";
 $k++;
}

?>
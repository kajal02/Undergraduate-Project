<?php 
session_start();
$type = $_SESSION['type'];
$uid = $_SESSION['name'];
$table_name= $uid.'_history';
// Connect to the database
$con = mysqli_connect("localhost","root","","scimos");


// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
$db = mysqli_select_db($con, "scimos");

$setCounter = 0;

$setExcelName = "scimos_history";

//$setSql = "YOUR SQL QUERY GOES HERE";
switch($type)
{
	case "supplier":

			$fetchprodids = mysqli_query($con , "select distinct(pid) from `user_products` where uid = '$uid'");
			$ans = mysqli_fetch_all($fetchprodids, MYSQL_BOTH);
			$prodids = array();
			$prodnames = array();

			foreach($ans as $a)
			{
				array_push($prodids , $a[0]);
				$temp = $a[0];
				$fetchprod = mysqli_query($con , "select product_name from `company_products_all` where pid = '$temp'");
				$pname = mysqli_fetch_row($fetchprod);
				array_push($prodnames , $pname[0]);
			}
			$countprods = count($ans);

			//////////////////getting all the manufacturers who's products he supplies
			$manucount = 0;
			$count = count($prodids);
			/////making temporary table for storing product ids for IN query
			$prodidtable = mysqli_query($con , "create table `prodidstemp`(`pid` varchar(8)) ");
			for($i = 0;$i<$count;$i++)
			{
				$insertquery = mysqli_query($con , "insert into `prodidstemp`(`pid`) values ('$prodids[$i]')");
			}
			
			$manulist = array();
			$getmanulist = mysqli_query($con , "select distinct(company_name) from `company_products_all` where pid IN (select pid from `prodidstemp`)");
			$ans = mysqli_fetch_all($getmanulist, MYSQL_BOTH);
			$tptable = mysqli_query($con , "create table `tptable`(`pid` varchar(30),`week` INT(11),`uid` varchar(25)) ");
			foreach($ans as $a)
			{
				$tablename = $a[0].'_history';
				$fetchhistory = mysqli_query($con , "INSERT INTO `tptable` (`pid`,`week`,`uid`) select pid , week , `$uid` from `$tablename` where $uid IS NOT NULL" );
			}
			$setRec= mysqli_query($con,"select * from `tptable`;");
			$dropquery =  mysqli_query($con , "drop table `prodidstemp`");
        break;
     case "retailer":
        $fetchprodids = mysqli_query($con , "select distinct(pid) from `user_products` where uid = '$uid'");
		$ans = mysqli_fetch_all($fetchprodids, MYSQL_BOTH);
		$prodids = array();
		$prodnames = array();

		foreach($ans as $a)
		{
			array_push($prodids , $a[0]);
			$temp = $a[0];
			$fetchprod = mysqli_query($con , "select product_name from `company_products_all` where pid = '$temp'");
			$pname = mysqli_fetch_row($fetchprod);
			array_push($prodnames , $pname[0]);
		}
		$countprods = count($ans);
		$manucount = 0;
		$count = count($prodids);
		/////making temporary table for storing product ids for IN query
		$prodidtable = mysqli_query($con , "create table `prodidstemp`(`pid` varchar(8)) ");
		for($i = 0;$i<$count;$i++)
		{
			$insertquery = mysqli_query($con , "insert into `prodidstemp`(`pid`) values ('$prodids[$i]')");
		}

		$manulist = array();
		$getmanulist = mysqli_query($con , "select distinct(company_name) from `company_products_all` where pid IN (select pid from `prodidstemp`)");
		$ans = mysqli_fetch_all($getmanulist, MYSQL_BOTH);
		$tptable = mysqli_query($con , "create table `tptable`(`pid` varchar(30),`week` INT(11),`uid` varchar(25)) ");
		foreach($ans as $a)
		{
			$tablename = $a[0].'_history';
			$fetchhistory = mysqli_query($con , "INSERT INTO `tptable` (`pid`,`week`,`uid`) select pid , week , `$uid` from `$tablename` where $uid IS NOT NULL" );
		}
		$setRec= mysqli_query($con,"select * from `tptable`;");
		$dropquery =  mysqli_query($con , "drop table `prodidstemp`");
        break;
     case "manufacturer":
        $setRec= mysqli_query($con,"select `pid`,`week`,`manufacturer` from `$table_name`;");
        break;
}



//$setRec = mysql_query($setSql);
//$setMainHeader= array();
$setData='';
$setCounter = mysqli_num_fields($setRec);
/*
for ($i = 0; $i < $setCounter; $i++) {
    $setMainHeader = mysql_field_name($setRec, $i)."\t";
}
*/
$setMainHeader = mysqli_fetch_fields($setRec);
			/*for ($i = 0; $i < $setCounter; $i++) {
				foreach ($setMainHeader as $val) {
					$headers[$i] .= $val->name;
				}
			}
			*/
while($rec = mysqli_fetch_row($setRec))  {
  $rowLine = '';
  foreach($rec as $value)       {
    if(!isset($value) || $value == "")  {
      $value = "\t";
    }   else  {
//It escape all the special charactor, quotes from the data.
      $value = strip_tags(str_replace('"', '""', $value));
      $value = '"' . $value . '"' . "\t";
    }
    $rowLine .= $value;
  }
  $setData .= trim($rowLine)."\n";
}
  $setData = str_replace("\r", "", $setData);

if ($setData == "") {
  $setData = "\nno matching records found\n";
}

$setCounter = mysqli_num_fields($setRec);

//This Header is used to make data download instead of display the data
 header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");

header("Pragma: no-cache");
header("Expires: 0");

//It will print all the Table row as Excel file row with selected column name as header.

echo $setData."\n";
$dropquery =  mysqli_query($con , "drop table `tptable`");
?>
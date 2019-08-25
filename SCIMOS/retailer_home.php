<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<html>
<head>
<title>Supplier SCIMOS</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href='css/table.css' rel='stylesheet' type='text/css' media='screen' />
<!------ js ------>
<script src="js/jquery.min.js"> </script>
<!------ js ------>
<!---- start-smoth-scrolling---->
		<script type="text/javascript" src="js/move-top.js"></script>
		<script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
<!---- start-smoth-scrolling---->
<!--- fonts --->
<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Monda:400,700' rel='stylesheet' type='text/css'>
<!--- fonts --->
</head>
<body style="background:#eeeeee">

<!--- header-bottom ---->
<!-- Sticky Nav --->

<!-- top-nav -->
<!-- Sticky Nav --->
<!--- content ---->

<?php
session_start();
$name= $_SESSION['fname'];
?>

	<div class="content">
		<!--- container ---->
		<div class="container">
		<div>
			<div class="content-about-text" style="float: left; width:30%; padding-top: 15px">
					<a href="#"><img src="images/logoblack.png" height = "70px"alt=""/></a> 
					<span> </span>
			</div>
			<div style="width:70%; float: right; padding-top: 15px">
					<h1><strong>Welcome 
						<?php 
						echo $name; 
						?>
					</strong></h1> 
			</div>
		</div>
		<form id="logout" method="post" action="logout.php"> 
		<div class="email" style="float: right; padding-left: 390px; margin-top: -40px">
			<a href="#" id="logout1">&nbsp Logout &nbsp</a>
		</div>
		</form>
		<div class="row" style="padding-top: 15px">
		
			<div class="col-md-6 content-about-grid-left" style="width:30%">
					<img src="images/screen1.png">
					
					
			</div>
			<div class="col-md-6 content-about-grid-right" style="width:70%;">					
						
				<div class="table_area" style="height: 50%; padding-left:100px; overflow-y: scroll;">		
		
		<table>
	
<?php

if($_SESSION['status']==true)
{
// Connect to the database
$con = mysqli_connect("localhost","root","","scimos");

// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysqli_select_db($con, "scimos");

////////////////////////////////////adding here
$uid = $_SESSION['name'];
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

echo '<tr>';
echo '<th>PRODUCT NAME</th>';
echo '<th>WEEK NO</th>';
echo '<th>AMOUNT</th>';
echo '</tr>';

echo '<tr>';
echo '<th>PRODUCT NAME</th>';
echo '<th>WEEK NO</th>';
echo '<th>AMOUNT</th>';
echo '</tr>';

foreach($ans as $a)
{
	$tablename = $a[0].'_history';
	$fetchhistory = mysqli_query($con , "select pid , week , `$uid` from `$tablename` where $uid IS NOT NULL");
	$histresult = mysqli_fetch_all($fetchhistory ,MYSQL_BOTH);
	$countrows = count($histresult);

	$currentprodname =	$prodnames[0];
		
foreach($histresult as $hr)
{
 echo '<tr>';
 $temp = $hr[0];
 for($j = 0;$j<$countprods ; $j++)
 {
	if($prodids[$j] == $temp)
	{	
		$currentprodname =	$prodnames[$j];
		break;
	}
 }	
	echo '<td>'.$currentprodname.'</td>';
	echo '<td>'.$hr[1].'</td>';
	echo '<td>'.$hr[2].'</td>';

 echo '</tr>';
}
}


$dropquery =  mysqli_query($con , "drop table `prodidstemp`");
}
else
{
header("location: index.php");
}	
?>
	
		
	</table>

				</div>	
				<div style="height: 50%; padding-top: 45px; float: down">
					<div style="height: 20%">
						<div class="email" style="float:left; width: 50%; padding-left:100px">
								<a  href="retailer_home.php">&nbsp&nbsp&nbsp&nbsp History &nbsp&nbsp&nbsp&nbsp</a>
						</div>
						<div class="email"  style="float:left; width: 50%;padding-left:100px " >
							<a href="retailer_place_order.php">&nbsp&nbsp Place Order &nbsp&nbsp</a>
						</div>	
						
						
					</div>
					<div style="height: 20%">
						
						
						<form id="History" method="post" action="History_download.php">
						<div class="email" style="float:left; width: 100%; padding-left:280px"">
								<a  href="#" id="History1"> Download History </a>
						</div>
						</form>	
					</div>
					
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>

		</div>
		<!--- container ---->
		
	</div>
	<!--- content ---->
<script src="\jquery-ui-1.11.3.custom\jquery-ui.js"></script>
<script>	
$(function () {
    $('#logout1').on('click', function () {

        //fire the submit event on the form
        $('#logout').trigger('submit');

        //stop the default behavior of the link
        return false;
    });
});
</script>
<script>	
$(function () {
    $('#History1').on('click', function () {

        //fire the submit event on the form
        $('#History').trigger('submit');

        //stop the default behavior of the link
        return false;
    });
});
</script>

</body>
</html>
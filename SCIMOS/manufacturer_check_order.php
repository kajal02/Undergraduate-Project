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
					<h1><strong> Welcome
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

	//////////////////////////////////////////adding here
	$uid = $_SESSION['name'];

	$fetchprodids = mysqli_query($con , "SELECT * from `all_orders` where order_to= '$uid'");
	$ans = mysqli_fetch_all($fetchprodids, MYSQL_BOTH);

	$fields_num = count($ans);
	echo '<form name = "checkorder" id = "checkorder" method = "post" action = "order_status_update.php">';
	echo '<tr style="height: 120px">';
	echo '<th style="width: 130px">DATE</th>';
	echo '<th style="width: 130px">PRODUCT ID</th>';
	echo '<th style="width: 130px">PRODUCT NAME</th>';
	echo '<th style="width: 130px">CURRENT STOCK LEVEL</th>';
	echo '<th style="width: 130px">ORDER FROM</th>';
	echo '<th style="width: 130px">ORDER AMOUNT</th>';
	echo '<th style="width: 130px">ACCEPT/REJECT ORDER</th>';
	
	echo '</tr>';	
	
	$dataArray = array();
    foreach($ans as $cf)
	{
	 array_push($dataArray, $cf);	
	}
	
	for($i=0; $i<$fields_num; $i++)
	{
		echo '<tr>';
		//DATE
		echo '<td>';
		echo $dataArray[$i][0];
		$_SESSION['date1'] = $dataArray[$i][0];
		echo '</td>';

		//product id
		echo '<td>';
		echo $dataArray[$i][1];
		$_SESSION['pid1'] = $dataArray[$i][1];
		$pid1 = $dataArray[$i][1];
		
		echo '</td>';
		
		//product name
		$temp = $dataArray[$i][1];
		$fetchmanu = mysqli_query($con , "SELECT `product_name` from `company_products_all` where pid= '$temp'");
		$ans = mysqli_fetch_row($fetchmanu);
		echo '<td>';
		echo $ans[0];
		$_SESSION['pname1'] = $ans[0];
		echo '</td>';
	
		//stock level
		echo '<td>';
		$table_hist_name= $dataArray[$i][1].'_hist';
		$fetchmanu = mysqli_query($con , "select `manufacturer` from `$table_hist_name` where id =(select max(id) from `$table_hist_name`)");
		if($fetchmanu)
		{
		$ans = mysqli_fetch_row($fetchmanu);
		echo $ans[0];
		}
		else
			echo 'false';
			echo '</td>';
		
		//Order from which supp
		echo '<td>';
		echo $dataArray[$i][3];
		$_SESSION['orderfrom1'] = $dataArray[$i][3];
		$order_from1 = $dataArray[$i][3];
		echo '</td>';
		
		//order amount
			//stock level
		echo '<td>';
		$table_hist_name= $dataArray[$i][1].'_hist';
		$supp_name = $dataArray[$i][3];
		$fetchmanu = mysqli_query($con , "select `stock` from `all_orders` where `pid` = '$pid1' && `order_from` = '$order_from1' && `order_to` = '$uid' ");
		if($fetchmanu)
		{
		$ans = mysqli_fetch_row($fetchmanu);
		echo $ans[0];
		}
		else
			echo 'false';
			echo '</td>';
	
		//Accept or reject button
		echo '<td>';
		echo '<input type="submit" name="accept" id = "accept" value="ACCEPT">';
		echo '<br><br>';
		echo '<input type="submit" name="reject" id = "reject" value="REJECT">';
			
		echo '</td>';
		
		
		echo '</tr>';
			
	}
	echo '</form>';
	
    
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
								<a  href="supplier_home.php">&nbsp&nbsp&nbsp&nbsp Home &nbsp&nbsp&nbsp&nbsp</a>
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
	
</body>
</html>
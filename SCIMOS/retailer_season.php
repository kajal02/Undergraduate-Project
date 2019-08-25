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
					<form id="confirm" method="post" action="season_order_confirm_ret.php">
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
	$final_stock = $_SESSION['final_stock'];
	
	$fetchprodids = mysqli_query($con , "SELECT `pid` from `user_products` where uid= '$uid'");
	$ans = mysqli_fetch_all($fetchprodids, MYSQL_BOTH);

	$products= array();
	foreach($ans as $a)
	{
		array_push($products , $a[0]);
	}

	$fields_num = mysqli_num_rows($fetchprodids);
	
	echo '<tr style="height: 120px">';
	echo '<th style="width: 150px">PRODUCT ID</th>';
	echo '<th style="width: 150px">PRODUCT NAME</th>';
	echo '<th style="width: 150px">QUANTITY</th>';
	echo '<th style="width: 150px">PLACE AN ORDER TO</th>';
	echo '<th style="width: 150px">REMAINING STOCK</th>';
	echo '</tr>';	
	$dataArray= array();
	
    foreach($ans as $cf)
	{
	 array_push($dataArray, $cf[0]);	
	}
	
	for($i=0; $i<$fields_num; $i++)
	{
		echo '<tr>';
		
		echo '<td>';
		echo $dataArray[$i];
		echo '</td>';
		
		$fetchmanu = mysqli_query($con , "SELECT `product_name` from `company_products_all` where pid= '$dataArray[$i]'");
		$ans = mysqli_fetch_row($fetchmanu);
		
		echo '<td>';
		echo $ans[0];
		echo '</td>';
		
		echo '<td>';
		echo $final_stock[$i];
		echo '</td>';
		
		
		
		echo '<td><select name= "type_select[]" value="type_select[]">';
		$fetchmanu = mysqli_query($con , "SELECT `uid` FROM `user_products` WHERE pid='$dataArray[$i]' and `uid` IN (select `uid` from `users` where `type`= 'supplier')");
		$ans = mysqli_fetch_all($fetchmanu, MYSQL_BOTH);
				
		foreach($ans as $c)
		{
			echo '<option value="'.$c[0].'">'.$c[0].'</option>';
		}
		
		echo '</select></td>';
		
		echo '<td><input type="text" name="rem_stock[]" style="width:50%;"></td>';
		
		echo '</tr>';
	}
	
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
								<a  href="retailer_home.php">&nbsp&nbsp&nbsp&nbsp&nbsp Home &nbsp&nbsp&nbsp&nbsp&nbsp</a>
						</div>
											
						<div class="email"  style="float:left; width: 50%; padding-left:80px" >
							<a href="#" id = "confirm1">&nbsp&nbspConfirm Order&nbsp&nbsp</a>
						</div>	
					</div>
				</div>
				</form>
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
    $('#confirm1').on('click', function () {

        //fire the submit event on the form
        $('#confirm').trigger('submit');

        //stop the default behavior of the link
        return false;
    });
});
</script>	
	
</body>
</html>
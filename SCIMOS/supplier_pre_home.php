<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<html>
<head>
<title>SCIMOS</title>
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
					<h1><strong>SCIMOS</strong></h1> 
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
		
			<h4><strong>Select the products you want to supply :</strong></h4>
					
				<div class="table_area" style="height: 50%; padding-left:100px; overflow-y: scroll;">		
		
		<div id="select_prods_table">
		
		<form id="select" method="post" action="user_products.php">
	
		<table>
	
	<tr>
		<th>Product ID</th>
		<th>Product Name</th> <!-- Blank :) But you can enable this by removing "th:first-child{}" in css style :) -->
		<th>Current Price</th>
		<th>Attribute 1</th>
		<th>Select</th>
		
		
	</tr>
	<tr>
		<th>Product ID</th>
		<th>Product Name</th> <!-- Blank :) But you can enable this by removing "th:first-child{}" in css style :) -->
		<th>Current Price</th>
		<th>Company</th>
		<th>Select</th>
		
	</tr>
	
<?php

if($_SESSION['status']==true )
{

if($_SESSION['step'] == 2)
{
		switch($_SESSION['type'])
		{
		 case "supplier":
			header("location: supplier_home.php");
			break;
		 case "retailer":
			header("location: retailer_home.php");
			break;
		}
	
}

// Connect to the database
$con = mysqli_connect("localhost","root","","scimos");

// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}
// Select the database to use
mysqli_select_db($con, "scimos");

$result = mysqli_query($con,"SELECT * FROM company_products_all");

$fields_num = mysqli_num_rows($result);

     if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_array($result)){
                  $dataArray[] = $row ;
            }		
}

for($i = 0;$i<mysqli_num_rows($result) ; $i++)
{
	echo '<tr>';
  for($j = 0;$j<4;$j++)
  {
  echo '<td>';
	echo $dataArray[$i][$j];
	echo '</td>';
  }	
 $pid = $dataArray[$i][0];
   echo "<td><input type='checkbox' name='user_product[]' value='$pid'/></td></tr>";
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

				</div>	
				<div style="height: 50%; padding-top: 45px; float: down">
					<div style="height: 20%">
					
							<div class="email" style="float:left; width: 50%; padding-left:100px">
								<a  href="#" type="submit" id="select1">&nbsp&nbsp&nbsp Select &nbsp&nbsp&nbsp</a>
							</div>
					
						<div class="email"  style="float:left; width: 50%; padding-left:80px" >
							<a href="#" id="clear">&nbsp&nbsp&nbspClear&nbsp&nbsp&nbsp</a>
						</div>	
					</div>
				</div>
				</form>
				
<script src="\jquery-ui-1.11.3.custom\jquery-ui.js"></script>
<script>
		$(function () {
    $('#select1').on('click', function () {

        //fire the submit event on the form
        $('#select').trigger('submit');

        //stop the default behavior of the link
        return false;
    });
});

	</script>
					
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
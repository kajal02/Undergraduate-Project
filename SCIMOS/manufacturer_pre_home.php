<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<html>
<head>
<title>Manufacturer SCIMOS</title>
<link rel="stylesheet" href="css1/styles.css">

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
		
		<form id="submit_product" method="post" action="company_products.php">
	
		<table>
	
	<tr>
		<th style="width: 180px">Product ID</th>
		<th style="width: 180px">Product Name</th> <!-- Blank :) But you can enable this by removing "th:first-child{}" in css style :) -->
		<th style="width: 180px">Current Price</th>
		
	</tr>
	<tr>
		<th style="width: 180px">Product ID</th>
		<th style="width: 180px">Product Name</th> <!-- Blank :) But you can enable this by removing "th:first-child{}" in css style :) -->
		<th style="width: 180px">Current Price</th>
	</tr>
	
<?php
if($_SESSION['status']==true )
{

if($_SESSION['step'] == 2)
{
	header("location: manufacturer_home.php");
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

for($i = 0;$i<5 ; $i++)
{
	echo '<tr>';
  
	echo '<td style="height:50px;width:180px">';
	echo '<INPUT TYPE="TEXT" name= "prod_id[]" id="prod_id[]" style="height:40px;width:180px">';
	echo '</td>';

	echo '<td style="height:50px;width:180px">';
	echo '<INPUT TYPE="TEXT" name= "prod_name[]" id="prod_name[]" style="height:40px;width:180px">';
	echo '</td>';

	echo '<td style="height:50px;width:180px">';
	echo '<INPUT TYPE="TEXT" name= "prod_price[]" id="prod_price[]" style="height:40px;width:180px">';
	echo '</td>';
	
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
	<div style="height: 50%; padding-top: 30px; float: down">
		<div style="height: 20%">
			<div class="email" style="float:left; width: 50%; padding-left:100px">
				<a  href="#" type="submit" id="submit_product1" name="submit_product1">&nbsp&nbsp&nbsp Submit &nbsp&nbsp&nbsp</a>
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
    $('#submit_product1').on('click', function () {

        //fire the submit event on the form
        $('#submit_product').trigger('submit');

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


<!-- popup msg session starts-->

<div id="modal" class="model">
	<div id="heading" class="heading">	
	</div>

	<div id="content" class="content">
	<a href="#"  style="left-padding:100px" class="button green close"><img src="images/tick.png">OK</a>	
	</div>
	
</div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/jquery.reveal.js"></script>

	<!--jQuery-->
	
	<script type="text/javascript">
	
	<?php
	$phpVar= $_SESSION['empty'];
	echo "var valid = '{$phpVar}';";
	?>
		$(document).ready(function() {
			$('.ok').html( valid);
				if(valid==1)
				{
					// Button which will activate our modal
			   	$('#modal').reveal({ // The item which will be opened with reveal
				  	animation: 'fade',                   // fade, fadeAndPop, none
					animationspeed: 600,                       // how fast animtions are
					//$( "#modal" ).html( "<p>All new content. <em>You bet!</em></p>" );
					
					closeonbackgroundclick: true,              // if you click background will modal close?
					dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
				});
				$('.heading').html( "<p>No product is entered! </p>" );
				$('.content').prepend( "<p style='color:#ebebeb;'>Please enter at least 1 product</p>" );
				}
				else
				{
					//return false;
				}
			});
	</script>

		
<?php
unset($_SESSION['empty']);
?>

</body>
</html>
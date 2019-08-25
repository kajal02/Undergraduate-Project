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
<?php
session_start();
$name= $_SESSION['fname'];
?>

<!--- header-bottom ---->
<!-- Sticky Nav --->

<!-- top-nav -->
<!-- Sticky Nav --->
<!--- content ---->

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
		
			<h2><strong>Upload history in excel file</strong></h2>
			<p>(Upload the history from FIRST WEEK OF JANUARY till current week)</p>
					<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
				<div class="table_area" style="height: 20%; padding-left:0px; padding-right: 450px">		
				<!-- div area started  -->
				<table width="600" style="margin: 35px auto; background:#f8f8f8; border:1px solid #eee; padding:0px;">

				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

				<tr>

				<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Select file</td>

				<td width="50%" style="border-bottom:1px solid #eee; padding-left: 15px;"><input type="file" name="file" id="file" /></td>

				</tr>
				<tr>

				<td style="font:bold 12px tahoma, arial, sans-serif; text-align:right; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Submit</td>

				<td width="50%" style=" padding:5px;"><input type="submit" name="submit" /></td>

				</tr>

				</table>
				<!-- div area ended  -->
	
				</div>
				</form>
		</div>	
		<form action="realupdate.php" method="post" >
	<div style="height: 50%; padding-top: 0px">
		<div style="height: 20%">
			<div class="email" style="float:left; width: 40%; padding-left:50px">
				<a href='realupdate.php'>&nbsp&nbsp&nbsp Click Here&nbsp&nbsp&nbsp</a>
			</div>
					
			<div class="email"  style="float:left; width: 50%; padding-right:500px" >
				<a href="#" id="clear">&nbsp&nbsp&nbspClear&nbsp&nbsp&nbsp</a>
			</div>	
			
			
		</div>
	</div>
	</form>
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
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38304687-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	
</body>
</html>
<?php

$uploadedStatus = 0;

if ( isset($_POST["submit"]) ) {
if ( isset($_FILES["file"])) {
//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else {
if (file_exists($_FILES["file"]["name"])) {
unlink($_FILES["file"]["name"]);
}
$storagename = "historytest.xlsx";
move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
$uploadedStatus = 1;
}
} else {
echo "No file selected <br />";
}
}
?>
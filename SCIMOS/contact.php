<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<html>
<head>
<title>Contact Us</title>
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
<div class="content" >
		<!--- container ---->
		
		<div class="container" >
		<div>
			<div class="content-about-text" style="float: left; width:30%; padding-top: 15px">
					<a href="#"><img src="images/logoblack.png" height = "70px"alt=""/></a> 
					<span> </span>
			</div>
			<div style="width:70%; float: right; padding-top: 15px; padding-left: 400px">
					<h1><strong>Contact Us</strong></h1> 
			</div>
		</div>
		
		<div class="Get-in-touch-grids">
				<div class="col-md-6" >
					<form method="post" action="contact_mail.php" id="contact">
					</br>
						<input type="text" maxlength="20" id= "name"value="Your Name" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Name';}">
						<input type="text" maxlength="20" id="email"value="Your Email" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Email';}">
						<textarea value="Your Message" id="msg"name="msg" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Message';}"></textarea>
						<div class="clearfix"></div>
						
					
				</div>
				<div class="col-md-6">
					<div class="Get-in-touch-right-grid">
					</br>
						<P>
							For any queries or suggestions, please contact us.
						</p>
						
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		<div>
		
		<div class="content-about-text" style="float: left; width:30%; padding-top: 0px">
			<div class="container" >
					<div class="email" style="float: left; padding-left: 390px; margin-top: -150px; margin-left:-200px">
					<a href="#" type="submit" id="submit" name="submit">&nbsp Submit &nbsp</a>
					</div>
				</form>
			</div>
		</div>
			
		</div>
		<!--- container ---->
	</div>
	
</div>
	<!--- content ---->
	
	
<script src="\jquery-ui-1.11.3.custom\jquery-ui.js"></script>	
<script>
$(function () {
    $('#submit').on('click', function () {

        //fire the submit event on the form
        $('#contact').trigger('submit');

        //stop the default behavior of the link
        return false;
    });
});
	
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
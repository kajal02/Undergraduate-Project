<html>
<head>
<title>SCIMOS</title>
<link rel="stylesheet" href="css1/styles.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="css1/styles.css">
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
<body>

<?php
	session_start();
	$temp = false;
	if(isset($_SESSION['logged_in']))
		$temp = $_SESSION['logged_in'];
	if($temp == true)
	{
		switch($_SESSION['type'])
	 {
	 case "supplier":
        header("location: supplier_home.php");
        break;
     case "retailer":
        header("location: retailer_home.php");
        break;
     case "manufacturer":
        header("location: manufacturer_home.php");
        break;
	 }
	}
?>



	<!--- header-top ---->
	<div id="home" class="header-top" >
		<!--- container ---->
		<div class="container" style="

background-image:url(../images/bg.jpg);
background-attachment: fixed;
background-size: cover;
background-position: center center;" >
		
			<div class="header-logo">
			<a href="#"><img src="images/logo1.png" alt=""/></a>
			</div>
			
			<div class="header-sub-text">
			<h2>Low Inventory, High Profit</h2>
			</div>
			
			
			<div class="header-bottom-grids" >
			<div class="col-md-6 left-grid text-left">
					
					<div class="about-nav">
					<a href="about_us.html"><span class="nav-icon"> </span><label>About</label></a>
					</div>
					
					<div class="about-nav1">
						<a href="team.html"><span class="nav-icon1"> </span><label>Team</label></a>
					</div>
					
			<!--		<div class="clearfix"> </div>
					
					<div class="about-nav">
						<a class="scroll" href="#about"><span class="nav-icon"> </span><label>Contact</label></a>
					</div>   -->
					<div class="about-nav" style="margin-left: 90px">
						<a href="contact.php"><span class="nav-icon"> </span><label>Contact</label></a>
					</div>					
			</div>
			
			<div  class="col-md-6 right-grid text-right">
			
			<style>

html, body
{
    height: 100%;
}

body
{
    font: 12px 'Lucida Sans Unicode', 'Trebuchet MS', Arial, Helvetica;    
    margin: 0;
    background-color: #d9dee2;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebeef2), to(#d9dee2));
    background-image: -webkit-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -moz-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -ms-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: -o-linear-gradient(top, #ebeef2, #d9dee2);
    background-image: linear-gradient(top, #ebeef2, #d9dee2);    
}

/*--------------------*/

#login
{
    background-color: #fff;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#eee));
    background-image: -webkit-linear-gradient(top, #fff, #eee);
    background-image: -moz-linear-gradient(top, #fff, #eee);
    background-image: -ms-linear-gradient(top, #fff, #eee);
    background-image: -o-linear-gradient(top, #fff, #eee);
    background-image: linear-gradient(top, #fff, #eee);  
    height: 280px;
    width: 450px;
    margin: 30px 0 0 -180px;
    padding: 30px;
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 0;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;  
    -webkit-box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),
          0 1px 1px rgba(0, 0, 0, .2),
          0 3px 0 #fff,
          0 4px 0 rgba(0, 0, 0, .2),
          0 6px 0 #fff,  
          0 7px 0 rgba(0, 0, 0, .2);
    -moz-box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),  
          1px 1px   0 rgba(0,   0,   0,   .1),
          3px 3px   0 rgba(255, 255, 255, 1),
          4px 4px   0 rgba(0,   0,   0,   .1),
          6px 6px   0 rgba(255, 255, 255, 1),  
          7px 7px   0 rgba(0,   0,   0,   .1);
    box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),  
          0 1px 1px rgba(0, 0, 0, .2),
          0 3px 0 #fff,
          0 4px 0 rgba(0, 0, 0, .2),
          0 6px 0 #fff,  
          0 7px 0 rgba(0, 0, 0, .2);
}

#login:before
{
    content: '';
    position: absolute;
    z-index: -1;
    border: 1px dashed #ccc;
    top: 5px;
    bottom: 5px;
    left: 5px;
    right: 5px;
    -moz-box-shadow: 0 0 0 1px #fff;
    -webkit-box-shadow: 0 0 0 1px #fff;
    box-shadow: 0 0 0 1px #fff;
}


#signup
{
    background-color: #fff;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#eee));
    background-image: -webkit-linear-gradient(top, #fff, #eee);
    background-image: -moz-linear-gradient(top, #fff, #eee);
    background-image: -ms-linear-gradient(top, #fff, #eee);
    background-image: -o-linear-gradient(top, #fff, #eee);
    background-image: linear-gradient(top, #fff, #eee);  
    height: 520px;
    width: 450px;
    margin: 30px 0 0 -180px;
    padding: 30px;
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 0;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;  
    -webkit-box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),
          0 1px 1px rgba(0, 0, 0, .2),
          0 3px 0 #fff,
          0 4px 0 rgba(0, 0, 0, .2),
          0 6px 0 #fff,  
          0 7px 0 rgba(0, 0, 0, .2);
    -moz-box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),  
          1px 1px   0 rgba(0,   0,   0,   .1),
          3px 3px   0 rgba(255, 255, 255, 1),
          4px 4px   0 rgba(0,   0,   0,   .1),
          6px 6px   0 rgba(255, 255, 255, 1),  
          7px 7px   0 rgba(0,   0,   0,   .1);
    box-shadow:
          0 0 2px rgba(0, 0, 0, 0.2),  
          0 1px 1px rgba(0, 0, 0, .2),
          0 3px 0 #fff,
          0 4px 0 rgba(0, 0, 0, .2),
          0 6px 0 #fff,  
          0 7px 0 rgba(0, 0, 0, .2);
}

#signup:before
{
    content: '';
    position: absolute;
    z-index: -1;
    border: 1px dashed #ccc;
    top: 5px;
    bottom: 5px;
    left: 5px;
    right: 5px;
    -moz-box-shadow: 0 0 0 1px #fff;
    -webkit-box-shadow: 0 0 0 1px #fff;
    box-shadow: 0 0 0 1px #fff;
}

/*--------------------*/

h1
{
    text-shadow: 0 1px 0 rgba(255, 255, 255, .7), 0px 2px 0 rgba(0, 0, 0, .5);
    text-transform: uppercase;
    text-align: center;
    color: #666;
    margin: 0 0 30px 0;
    letter-spacing: 4px;
    font: normal 26px/1 Verdana, Helvetica;
    position: relative;
}

h1:after, h1:before
{
    background-color: #777;
    content: "";
    height: 1px;
    position: absolute;
    top: 15px;
    width: 120px;   
}

h1:after
{ 
    background-image: -webkit-gradient(linear, left top, right top, from(#777), to(#fff));
    background-image: -webkit-linear-gradient(left, #777, #fff);
    background-image: -moz-linear-gradient(left, #777, #fff);
    background-image: -ms-linear-gradient(left, #777, #fff);
    background-image: -o-linear-gradient(left, #777, #fff);
    background-image: linear-gradient(left, #777, #fff);      
    right: 0;
}

h1:before
{
    background-image: -webkit-gradient(linear, right top, left top, from(#777), to(#fff));
    background-image: -webkit-linear-gradient(right, #777, #fff);
    background-image: -moz-linear-gradient(right, #777, #fff);
    background-image: -ms-linear-gradient(right, #777, #fff);
    background-image: -o-linear-gradient(right, #777, #fff);
    background-image: linear-gradient(right, #777, #fff);
    left: 0;
}

/*--------------------*/

fieldset
{
    border: 0;
    padding: 0;
    margin: 0;
}

/*--------------------*/

select
{
	background: #f1f1f1;
    padding: 15px 15px 15px 30px;
    margin: 0 0 10px 0;
    width: 353px; /* 353 + 2 + 45 = 400 */
    border: 1px solid #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;

}

select:focus
{
    background-color: #fff;
    border-color: #e8c291;
    outline: none;
    -moz-box-shadow: 0 0 0 1px #e8c291 inset;
    -webkit-box-shadow: 0 0 0 1px #e8c291 inset;
    box-shadow: 0 0 0 1px #e8c291 inset;

}

option
{
	
    padding: 15px 15px 15px 30px;
    margin: 0 0 10px 0;
    width: 353px; /* 353 + 2 + 45 = 400 */
    border: 1px solid #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;

}

#inputs input
{
    background: #f1f1f1 url(http://www.red-team-design.com/wp-content/uploads/2011/09/login-sprite.png) no-repeat;
    padding: 15px 15px 15px 30px;
    margin: 0 0 10px 0;
    width: 353px; /* 353 + 2 + 45 = 400 */
    border: 1px solid #ccc;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    -webkit-box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
    box-shadow: 0 1px 1px #ccc inset, 0 1px 0 #fff;
}

#username
{
    background-position: 5px -2px !important;
}

#password
{
    background-position: 5px -52px !important;
}

#inputs input:focus
{
    background-color: #fff;
    border-color: #e8c291;
    outline: none;
    -moz-box-shadow: 0 0 0 1px #e8c291 inset;
    -webkit-box-shadow: 0 0 0 1px #e8c291 inset;
    box-shadow: 0 0 0 1px #e8c291 inset;
}

/*--------------------*/
#actions
{
    margin: 25px 0 0 0;
}

#submit
{		
    background-color: #9f449b;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#b269af), to(#9f449b));
    background-image: -webkit-linear-gradient(top, #b269af, #9f449b);
    background-image: -moz-linear-gradient(top, #b269af, #9f449b);
    background-image: -ms-linear-gradient(top, #b269af, #9f449b);
    background-image: -o-linear-gradient(top, #b269af, #9f449b);
    background-image: linear-gradient(top, #b269af, #9f449b);
    
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
    
     -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
     -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
     box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;    
    
    border-width: 1px;
    border-style: solid;
    border-color: #30142E #30142E #30142E #30142E;

    float: left;
    height: 35px;
    padding: 0;
    width: 120px;
    cursor: pointer;
    font: bold 15px Arial, Helvetica;
    color: #30142E;
}

#submit:hover,#submit:focus
{		
    background-color: #b269af;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#9f449b), to(#b269af));
    background-image: -webkit-linear-gradient(top, #9f449b, #b269af);
    background-image: -moz-linear-gradient(top, #9f449b, #b269af);
    background-image: -ms-linear-gradient(top, #9f449b, #b269af);
    background-image: -o-linear-gradient(top, #9f449b, #b269af);
    background-image: linear-gradient(top, #9f449b, #b269af);
}	

#submit:active
{		
    outline: none;
   
     -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
     box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;		
}

#submit::-moz-focus-inner
{
  border: none;
}

#actions a
{
    color: #ffffff;    
    float: right;
    line-height: 35px;
    margin-left: 10px;
}


/*--------------------*/

#back
{
    display: block;
    text-align: center;
    position: relative;
    top: 60px;
    color: #999;
}


</style>
<form id="login" method="post" action="validate_login.php"> 
    <h1>Log In</h1>
    <fieldset id="inputs">
	
    
        <input  name="uid" type="text" placeholder="Username" autofocus required>   
        <input  name="pwd" type="password" placeholder="Password" required>
    </fieldset>
    
	<fieldset id="actions">
        <div class="clearfix"></div>
						<div class="email" style="float:left; " >
							
							<a href="#" id="login1" type="submit">LOGIN</a>
						</div>
						<div class="email" style="float:right; padding-top:-60px; padding-right:20px" >
							<a href="#" id="signup1">SIGN UP</a>
						</div>
        
    </fieldset>
    
</form>



<form id="signup" style="padding-bottom:100px;" method="post" action="validate_signup.php">
    <h1>Sign Up</h1>
    <fieldset id="inputs">
        <input id="name" name="uname" type="text" placeholder="Name" autofocus required>   
        <input id="company" name="company" type="company" placeholder="Company" required>
		<select style="color:#a3a3a3" name="type">
			<option value="type" >Select type</option>
			<option value="retailer">Retailer</option>
			<option value="supplier">Supplier</option>
			<option value="manufacturer">Manufacturer</option>
		</select>
        <input id="email" name="email"type="text" placeholder="Email"  required>   
       	<input id="username" name="uid"type="text" placeholder="Username" required>   
        <input id="password" name="pwd"type="password" placeholder="Password" required>
		
    </fieldset>
	<fieldset id="actions">
        <div class="clearfix"></div>
						<div class="email" style="float:left; " >
							
							<a href="#"  id="login2">LOGIN</a>
						</div>
						<div class="email" style="float:right; padding-top:-60px; padding-right:20px" >
							<a href="#" type="submit" id="signup2">SIGN UP</a>
						</div>
        
    </fieldset>
    
</form>


<!-- BSA AdPacks code -->
<script src="\jquery-ui-1.11.3.custom\jquery-ui.js"></script>
<script>

$(function () {
    $('#signup2').on('click', function () {

        //fire the submit event on the form
        $('#signup').trigger('submit');

        //stop the default behavior of the link
        return false;
    });
});

$(function () {
    $('#login1').on('click', function () {

        //fire the submit event on the form
        $('#login').trigger('submit');

        //stop the default behavior of the link
        return false;
    });
});

$(document).ready(function(){

  // Hide div 2 by default
  $('#signup').hide();

  $('#signup1').click(function(){ 
      $('#login').hide();
      $('#signup').show();
	  
	  
  });
 
	
 
  $('#login2').click(function(){ 
      $('#signup').hide();
      $('#login').show();
  }); 
});

(function(){
  var bsa = document.createElement('script');
     bsa.async = true;
     bsa.src = js/script1.js;
  (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
})();
</script>
			
			</div>
			
			<div class="clearfix"> </div>
			</div>

	</div>
	<!--- container ---->	
	<div class="bottom_back" style="
		background-image:url(../images/bg.jpg);
	height: 30vh;
	background-attachment: fixed;
background-size: cover;
background-position: center center;

	">
	</div>
	<!-- bottom_back --->
	</div>
<!--- home ---->

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
	$phpVar= $_SESSION['valid'];
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
				$('.heading').html( "<p>Invalid Credentials! </p>" );
				$('.content').prepend( "<p style='color:white'>You have Entered Wrong Username or Password!</p>" );
				//pass_is=false;
				//uid_is=false;
				//return false;
				}
				else
				{
					//return false;
				}
			});
	</script>

	


<?php
unset($_SESSION['valid']);
?>
	
</body>

</html>

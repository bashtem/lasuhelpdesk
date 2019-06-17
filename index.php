<?php session_start();

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Lasu eHelpdesk</title>
    
    <script type="text/javascript" src="/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/ajaxCode.js"></script>
    <link rel="stylesheet" href="custom/css/normalize.css">

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="custom/css/style.css">
    <link href="custom/css/styles.css" rel="stylesheet" type="text/css">
    
  
	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="custom/engine0/style.css" />
	<script type="text/javascript" src="custom/engine0/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->
	<style type="text/css">
	#lasu-img {
	position: absolute;
	top: 66px;
	left: 302px;
}
.titleh {
		font-family: "Times New Roman", Times, serif;
		position: absolute;
		text-align: center;
		font-size: 20px;
		color: #000000;
		font-weight: bolder;
	}
	.info {
		font-family: garamond;
		position: absolute;
		color: #000000;
	}
	.footti {
	font-family: "times New Roman", Times, serif;
	color: #FFFFFF;
	text-align: center;
	position: absolute;
	top: 6px;
	left: 361px;
}
#flash1 {
	position: absolute;
	top: 85px;
	left: 274px;
	width: 372px;
	height: 24px;
}
	</style>
  </head>

  <body>

    <div class="container" style="float:right">
  <ul>
  <?php
  	if(!( isset($_SESSION['email']) || isset($_SESSION['emailse'])) ){
					
    echo '<li class="dropdown">
      <a href="signup.php" data-toggle="dropdown" >New User</a>
    </li>';
}
    
	if(!isset($_SESSION['emailse'])){

  // echo  '<li class="dropdown">
  //     <a href="#" data-toggle="dropdown" >Existing User <i class="icon-arrow"></i></a>
  //     <ul class="dropdown-menu">
  //       <li><a href="panel.php" >Check Status</a></li>
  //       <li><a href="panel.php"  >Submit New Request</a></li>
  //     </ul>
  //   </li>';

    echo  '<li class="dropdown">
      <a href="panel.php" data-toggle="dropdown"  > User Login </a>
    </li>';
}
if(!( isset($_SESSION['email'])  ) )
					echo '<li class="dropdown"><a href="service/" data-toggle="dropdown" >Schedule Officer Login</a></li>';
    ?>
  </ul>
</div>
    
    <script src="custom/js/index.js"></script>    
    <div id="top-nav" style="float:right">
		<div id="cssmenu">
			<ul>
				<li><a href="./"><span>Home</span></a></li>
				<li><a href="about.php"><span>About Us</span></a></li>
				<li class="last"><a href="contact.php"><span>Contact Us</span></a></li>
				<li class="active has-sub"><a href="#"><span>Quicklinks</span></a>
					<ul>
						<?php 

							if(!isset($_SESSION['emailse'])){
									echo '
								<li class="has-sub"><a href="signup.php"><span>New User</span></a>
								</li>
								<li class="has-sub"><a href="panel.php"><span>User Login</span></a>
								
								</li>
									';
								}
							?>
						
						<li>
							<?php 

							if(!isset($_SESSION['email'])){
									echo '<li><a href="service/" ><span>Schedule Officer Login</span></a></li>';
								}
							?>


						</li>
					</ul>
				</li>
				<?php
					
					if( isset($_SESSION['email']) ){
							
							include_once("connect.php");
							$email = $_SESSION['email'];
							$sql = "select * from user where email='$email'";
							if(($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query) >= 1)){
								$row = mysqli_fetch_array($query);
									$sname = $row['sname'];
									$onames = $row['onames'];
									$name = strtoupper($sname." ".$onames);
		
						}
						echo "<li><a href=\"logout.php\" style=\"text-align:right; margin-left:300px\" >$name Logout <span style=\"color:red\" class=\"glyphicon glyphicon-off\"></span></a></li>";
					}

					if(isset($_SESSION['emailse'])){
						include_once("connect.php");
						$email = $_SESSION['emailse'];
						$sql = "select * from service where email='$email'";
						if(($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query) >= 1)){
							$row = mysqli_fetch_array($query);
								$lname = $row['lname'];
								$title = $row['title'];
								$name = strtoupper($title." ".$lname);
						
						echo "<li><a href=\"service/logout.php\" style=\"text-align:right; margin-left:300px\" >$name Logout <span style=\"color:red\" class=\"glyphicon glyphicon-off\"></span></a></li>";
					}}
				?>

			</ul>
			
		</div>
	</div>

    
    
    
    <div id="logo" style="float:right">
		<img id="imghelp" height="45" src="custom/images/ehelp.png" width="286"><img id="img" alt="" height="24" src="custom/images/head2.png" width="279"></div>
	<div id="slider" style="float:right">
	<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container0">
	<div class="ws_images"><ul>
		<li><img src="custom/data0/images/1.jpg" alt="1" title="1" id="wows0_0"/></li>
		<li><img src="custom/data0/images/2.jpg" alt="2" title="2" id="wows0_1"/></li>
		<li><a href="http://wowslider.com"><img src="custom/data0/images/3.jpg" alt="html slideshow" title="3" id="wows0_2"/></a></li>
		<li><img src="custom/data0/images/4.jpg" alt="4" title="4" id="wows0_3"/></li>
	</ul></div>
	<div class="ws_bullets"><div>
		<a href="#" title="1"><span><img src="custom/data0/tooltips/1.jpg" alt="1"/>1</span></a>
		<a href="#" title="2"><span><img src="custom/data0/tooltips/2.jpg" alt="2"/>2</span></a>
		<a href="#" title="3"><span><img src="custom/data0/tooltips/3.jpg" alt="3"/>3</span></a>
		<a href="#" title="4"><span><img src="custom/data0/tooltips/4.jpg" alt="4"/>4</span></a>
	</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">jquery carousel slider</a> by WOWSlider.com v8.0</div>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="custom/engine0/wowslider.js"></script>
	<script type="text/javascript" src="custom/engine0/script.js"></script>
	<!-- End WOWSlider.com BODY section -->
	</div>

    
    
    
    <div id="content" style="float:right">
		<img height="107" src="custom/images/logo2.gif" width="114" id="lasu-img"><img id="lasuimg" height="35" src="custom/images/lasu2.png" width="335"><div id="submit">
			<img id="login-img" height="88" src="custom/images/login.png" width="168"></div>
	</div>
	<div id="content2" style="float:right">
		<div id="titlehead" class="titleh">
			How to Use!</div>
		<div id="info" class="info">
			With this System, you can Make a Complaint/Submit a Request. To use 
			this service, you have to create an account; and to do this just click 
			the <b> New User </b> Menu or <b> User Login </b> to Continue if you already 
			have an account. Unit representatives should click <b> Schedule Officer Login </b> 
			to treat submitted requests </div>
		<div id="footer">
			<span class="footti">Designed by e-Helpdesk Team © <?php echo date('Y')?> 
		</span> 
		</div>
	</div>

    
    
    
    <div id="search">
	</div>

    
    
    
  </body>
</html>

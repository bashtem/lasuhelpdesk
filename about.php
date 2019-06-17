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

 
    
    <script src="custom/js/index.js"></script>    
    <div id="top-nav" style="float:right">
		<div id="cssmenu">
			<ul>
				<li><a href="./"><span>Home</span></a></li>
				<li><a href="#"><span>About Us</span></a></li>
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

	<div  style=" margin-top: 150px ;margin-left: 150px; margin-right: 200px; padding-bottom: -100px; position: absolute; max-height: 10px;">

	<h3>About Us</h3>
LASU e-Helpdesk is an electronic customer care platform developed by the e-Helpdesk Development team of LASU to 
provide support for the general public on the services of LASU. With e-Helpdesk, anybody can submit requests, 
complaints or suggestions to us and  our trained and dedicated personnel will treat and respond through the 
e-Helpdesk platform.  With e-Helpdesk, you do not need to travel to LASU to make enquiries as such could be 
done on your mobile phone, ipad or computer. e-Helpdesk is hence an innovation of LASU channeled towards 
embrassing technology in our service delivery.

For any enquiry about e-HelpDesk or if you want us to develop a similar software
for you or your company, just contact us at compsc@lasu.edu.ng.


	<h3>Who Can Use LASU e-Helpdesk </h3>	
		Anybody can use e-HelpDesk. All you need is just to register using your email address and other 
		relevant information. Just for example, you can use this platform if you belong to any of these categories :-
		Parents, Current Students, Prospective Students, Employers, Investors, Staff, etc.
		
		
<h3>Brief on the Objectives of the University</h3>
Lagos State University (LASU), was established in 1984 as a multi-campus, non-residential University, Twenty-eight years after, the University is manifesting the dream of its founding fathers, put together in form of the objectives of the University, to meet the peculiar needs of Lagos State as follows:
<ul>
	<li>To form the apex of the educational system of the state, to provide facilities for learning, and to give instruction and training in such branches of knowledge as the University may desire to foster, and in doing so, to enable students obtain the advantage of liberal education;</li>
	<li>to promote, by research and other means, the advancement of knowledge and its practical application in social, cultural, economic, scientific and technological problems;</li>
	<li>to encourage the advancement in general, and to provide the opportunity for acquiring higher and liberal education;</li>
	<li>to act as a vehicle of development in general, and, in particular, to act as an instrument to effectively stimulate the development of the State through continuing education, applied research, technical assistance, direct consultation, informational services and internship programs;</li>
	<li>to provide innovative educational programmes of high standard, regardless of the nature of the degree being pursued, as this has importance and relevance for State and National development;</li>
	<li>to provide ready access for citizens of the State in particular to higher education, regardless of social origin or income;</li>
	<li>to meet the specific manpower needs of the State;</li>
	<li>to serve as a creative custodian, promoter and propagator of the State’s social and cultural heritage and resources;</li>
	<li>to undertake undergraduate and postgraduate courses in Law, Arts and Social Sciences, Education, Science, Engineering, Technology and Environmental Design, Management Sciences and Medical Science;</li>
	<li>to enhance educational opportunities of Lagos State indigenes and;</li>
	<li>to undertake any other activities appropriate for a University of the highest standard.</li>
</ul>


<h3>e-Helpdesk Development Team</h3>
The eHelpdesk team comprises of the Department of Computer Science's team (i.e. Prof B.S. Aribisala, Dr. B.A. Akinnuwesi, 
Dr. Toyin Enikuomehin, Taiwo Basit and Olusola Olabanjo) and ICT team (i.e. Mr Samuel Fadipe and Mr Oluwatobi Owoeye)


	</div>

    
    
    
    
	
		
		
	

    
    
    
    <div id="search">
	</div>

    
    
    
  </body>
</html>

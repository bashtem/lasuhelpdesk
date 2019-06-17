<?php
require_once("connect.php");

if((isset($_GET['token']) && (isset($_GET['id'])) ) ){
$time = time();
$token = $_GET['token'];
$email = base64_decode($_GET['id']);
$cat = base64_decode($_GET['cat']);
//$encodeTime = base64_decode(base64_decode('TVRVeE1ETXlNVEEyTVE9PQ=='));
$encodeTime = base64_decode(base64_decode($token));
if( ($time < $encodeTime) ){


}else{
	?>
	<script type="text/javascript">
		alert("Link Expired !")
		window.location.assign("./");
	</script>
	<?
	}
}else{
	?>
	<script type="text/javascript">
		window.location.assign("./");
	</script>
	<?
}


function  passReset($con, $table, $password,$email,$token){

	$que = "SELECT * FROM  $table  WHERE forgot_code='$token' ";
	if(mysqli_num_rows(mysqli_query($con,$que))==1){
	$sql = "UPDATE $table SET password='$password', forgot_code='' WHERE email='$email' ";
	echo $que;
	if(mysqli_query($con,$sql)){
		?>
		<script type="text/javascript">
			alert("Password Reset Successfully !");
			window.location.assign("./");
		</script>
		<?
		}
	}else{
		?>
		<script type="text/javascript">
			alert("Password Reset Failed... !");
			//window.location.assign("./");
		</script>
		<?
	}
}

if(isset($_POST['reset'])){
	$email = $_POST['email'];
	$pass = md5($_POST['pass']);
	$cat = $_POST['cat'];
	$token = $_POST['token'];


	switch($cat){
		case 0:
			$table ="user";
			break;
		case 1:
			$table = "service";
			break;
		default :
			$table = "";	
	}

passReset($con, $table, $pass,$email,$token);

}


?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/ajaxCode.js"></script>
<script type="text/javascript">
	function passmatch(){
	var pass=document.getElementById('pass').value;
	var cpass=document.getElementById('passretype').value;
	if (pass==cpass){
		document.getElementById('glypass').innerHTML="<span style='color:green; font-size:15px' class='glyphicon glyphicon-ok-circle'>Matched</span>";
		return true;
				}
	else{
		document.getElementById('glypass').innerHTML="<span style='color:red; font-size:15px' class='glyphicon glyphicon-remove-circle'>Mismatched</span>";
		return false;
		
}		}
</script>

</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">e-HelpDesk</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="./">Home</a></li>
         
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
        
      </ul>
    </div>
  </div>
</nav>
<div class="container">


<div class="col-md-3"></div>
<div class="container well col-md-6" id="window">
<div style="float:right"><img src="custom/images/logo2.gif"></div>
<div id="portal">
<h3>Password Reset ... </h3>
  <form role="form" method="post"  onsubmit="return passmatch()" id='others'>
    <div class="form-group">
	<br>
      <!-- <label for="email">E-Mail:</label> -->
      <input style="width:50%" type="password" name="pass" required class="form-control" id="pass" placeholder="New Password">
    </div>
	<div class="form-group">
      <!-- <label for="email">Password:</label> -->
      <p><span id="glypass" ></span></p>
      <input style="width:50%" type="password" name="passretype" onkeyup="passmatch()" placeholder="Re-type Password" required class="form-control" id="passretype" >
    </div>
	<div class="form-group" >
		<input hidden type="text" name="email" value="<?php echo $email ?> ">
		<input hidden type="text" name="cat" value="<?php echo $cat ?> ">
		<input hidden type="text" name="token" value="<?php echo $token ?> ">
		 <button id="sub" type="submit" name="reset"   class="btn btn-danger">Reset</button>

    </div>

 <!-- <a href="forgot.php" style="float:right" class="btn btn-danger"> &raquo; Forgot Password?</a> -->

  </form>
<div class="col-md-3"></div>
</div>
</div>
</div>


<script type="text/javascript" src="js/bootstrap.min.js"></script>
<nav class="navbar navbar-inverse navbar-fixed-bottom" style="height:20px">
  <div class="container-fluid">
    <div style="text-align:center;color:white" ><br>
	Designed by e-Helpdesk Team &copy; <?php echo date("Y")?>
   </div>
</nav>
</body>
</html>
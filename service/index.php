<?php session_start();
include("../connect.php");
$login="nap";

if(isset($_SESSION['email'])){
	//header("Location:../");
	?>
	<script type="text/javascript">
		window.location.assign("../");
	</script>
	<?
}

if (isset($_SESSION['emailse'])){
	?>
	<script type="text/javascript">
		window.location.assign("service_panel.php");
	</script>
	<?
}
//echo $_SESSION['timestamp'];

if (isset($_POST['login'])){
		$email=$_POST['emailse'];
		$pass= md5($_POST['pass']);
		$sql="select * from service where password='$pass' AND email='$email'";
		$query = mysqli_query($con,$sql);
			$result=mysqli_num_rows($query);
				if ($result==1){
					$_SESSION['emailse'] = $email;
					$_SESSION['timestamp'] = time();				
					
		?>
					<script>
					window.alert("You are about to login! Please ensure you log out when you are done!");
					window.location.assign("service_panel.php");
					</script>
		<?php

		}else{
			$login ="no";
		}

 }else if(isset($_SESSION['emailse'])){
	header("Location: service_panel.php");
}



if(isset($_POST['forgot'])){
	$email = $_POST['email'];
	$query = "SELECT * FROM service WHERE email='$email'";
	$check = mysqli_num_rows(mysqli_query($con,$query));
	if ($check==1){

		$time = time()+86400;
		$encodeEmail = base64_encode($email);
		$encodeTime = base64_encode(base64_encode($time));
		$query = "UPDATE service SET forgot_code='$encodeTime', password='' WHERE email='$email' "; 
		mysqli_query($con,$query);
		$cat = base64_encode("1");
		$url = "recovery.php?id=".$encodeEmail."&token=".$encodeTime."&cat=".$cat;

		//echo $url;
		//exit;

		// SEND MAIL FOR RECOVERY
				   $to=$email;
                   $subject="LASU e-HelpDesk Password Reset Link";
                   $body="Please follow this link <a href='".$domain.$url."'>".$domain.$url." </a> to reset your Password. This link will expire in 24 hours. ";
                   include("../sendmail.php");
                   sendMail($to,$subject,$body);

?>
<script type="text/javascript">
	alert("Please Check your Mail for Recovery!");
	window.location.assign("./");

</script>
<?
	}else{
?>
<script type="text/javascript">
	alert("Invalid E-Mail Address !");
	window.location.assign("./");

</script>
<?
	}
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/ajaxCode.js"></script>

<script>

function passcheck(){

document.getElementById("incorrect").innerHTML="<span ><i><strong>incorrect login details?</strong></i></span>";
}


function regservice(mail){
//alert(mail);
xmlHttp = new XMLHttpRequest();

	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return false;
	}
	
	var url="new_service.php?mail="+mail;
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("portal").innerHTML="";
			var res =xmlHttp.responseText;
			
			jNode = $(res);
		jNode.hide();
		$('#portal').append(jNode);
		jNode.fadeIn(2000);
			
			
		}else if(xmlHttp.readyState==3){
			document.getElementById("portal").innerHTML="Loading...";
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}

</script>


</head>
<body>
<div id="windows">
<nav class="navbar navbar-inverse navbar-fixed-top" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../#">e-HelpDesk</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="../">Home</a></li>
         
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../#"></a></li>
		<li><a href="../#" class="dropdown-toggle" data-toggle="dropdown"></a></li>
        
      </ul>
    </div>
  </div>
</nav><br><br><br><br>
<div class="container">


<div class="col-md-3"></div>
<div class="container well col-md-6" id="window">
<div style="float:right"><img src="../custom/images/logo2.gif"></div>

				<div class="col-md-10  " id="portal">
				<h3 style='color:#006633'>Schedule Officer's Login ...</h3>
				  <form role="form" method="post"   id='others'>
				    <div class="form-group">
					<br>
				      <!-- <label for="email">E-Mail:</label> -->
				      <input style="width:50%" type="email" name="emailse" required class="form-control" id="servmail" placeholder="E-mail">
					  <p id="incorrect" style="color:red; "></p>
				    </div>
					
					<div class="form-group">
					<br>
				      <!-- <label for="email">Password:</label> -->
				      <input style="width:50%" type="password" name="pass" placeholder="********************" required class="form-control" id="pass" >
				    </div>
					<div class="form-group" >
						 <button id="sub" type="submit" name="login"   class="btn btn-success">Submit</button>
						<!-- <button id="register"  name="register"  onclick="regservice();" class="btn btn-primary">Register</button> -->
								
					
				    </div>
									
				 
				  </form>
				 </div>
		  <button id="sub" type="button" name="forget" onclick="forget()" style="float:right" class="btn btn-danger">&raquo; Forgot Password?</button>

				
</div>
<div class="col-md-3"></div>
</div>


<nav class="navbar navbar-inverse navbar-fixed-bottom" style="height:20px">
  <div class="container-fluid">
    <div style="text-align:center;color:white" ><br>
	Designed by e-Helpdesk Team &copy; &nbsp;<?php echo date('Y') ?>
   </div>
  </div>
</nav>

</div>
</body>
<script>

function passmatch(){
	var pass=document.getElementById('spass').value;
	var cpass=document.getElementById('scpass').value;
	if (pass==cpass){
		document.getElementById('glypass').innerHTML="<span style='color:green; font-size:15px' class='glyphicon glyphicon-ok-circle'>Matched</span>";
				}
	else{
		document.getElementById('glypass').innerHTML="<span style='color:red; font-size:15px' class='glyphicon glyphicon-remove-circle'>Mismatched</span>";
		
}		}	



function val(){
	if(reg.spass.value!=reg.scpass.value){
		alert("Password Confirmation Does not Match");
		return false;			
	}}
	



function login(){

xmlHttp = new XMLHttpRequest();

	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return false;
	}
	
	var url="../service/index.php";
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("windows").innerHTML="";
			var res =xmlHttp.responseText;
			
			jNode = $(res);
		jNode.hide();
		$('#windows').append(jNode);
		jNode.fadeIn(2000);
			
			
		}else if(xmlHttp.readyState==3){
			document.getElementById("portal").innerHTML="Loading...";
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);

}


var mail = document.getElementById("servmail");
mail.onfocus=function(){
	document.getElementById("incorrect").innerHTML="";
}

</script>
</html>



<?php

if(isset($_GET['profile'])){
	$mail= base64_decode($_GET['encmail']);
	$enctime= base64_decode($_GET['profile']);
	//$mail= $_GET['encmail'];
	if(!(time()>$enctime)){
?>
<script type="text/javascript">	

	regservice('<?php echo $mail; ?>');
</script>
<?php
}else{

	echo "<script>alert('Link Expired !');
			window.location.assign('./');
		</script>";
}

	}


if($login=="no"){
			echo'
		<script>
				//alert("Error Login!");
				passcheck();
		</script>';

		}


?>


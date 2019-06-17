<?php session_start();
//session_destroy();
require_once("connect.php");
//require_once("session.php");

if(isset($_SESSION['email'])){
//echo "Logout first";
?>

<script>
var panel="panel.php";
alert("Please Logout Current User...");
window.location.assign(panel);
</script>

<?php
	//header("Location: panel.php");	
}

if(isset($_POST['subnew'])){

$surname=$_POST['surname'];
$firstname=$_POST['firstname'];
$email=$_POST['email'];
$phoneno=$_POST['phoneno'];
$title=$_POST['title'];

$pass =base64_encode(md5($_POST['pass']));
$forgotCode = base64_encode(time()+86400);

$sql="INSERT INTO user(sname,onames,email,phone,title, forgot_code) values('$surname','$firstname','$email','$phoneno','$title','$forgotCode')";
$sql2= "select * from user where email='$email'";
$query1=mysqli_query($con,$sql2);
while ($row=mysqli_fetch_array($query1)){
if ($email==$row['email']){
		?>
		<script>
		
		alert("The email already Exist");
		var destination="signup.php";
		window.location.assign(destination);
		
		</script>
		
	<?php	
	exit;
}
	}

if($query=mysqli_query($con,$sql)){

			$url = "activate.php?in=$pass&token=$forgotCode";
			/// Mail for New User !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

			$to=$email;
	 		$subject=" Account Created on LASU e-HelpDesk";
	 		$body=" This is to confirm that an account has been created for you on LASU e-HelpDesk platform. Please follow this link <a href='".$domain.$url."'>".$domain.$url." </a>  to activate and login to your account. Thanks. ";
	 		$headers="From: LASU e-HELPDESK <support@lasucomputerscience.com>";
// echo $domain.$url;
// exit;

		sendMail($to,$subject,$body,$title,$surname);

		/*	$_SESSION['email'] = $email;
        $_SESSION['timestamp'] = time();*/
	?>
<script>
window.alert("Please Check your Mail for Account Activation !!!.");
var loc="login.php";
window.location.assign(loc);

</script>
<?php
}else {
	?>
<script>
window.alert("An error Occurred Please refill the form.");
var loc="signup.php";
windows.location.assign(loc);

</script>
<?php
}}



function sendMail($to,$subject,$body,$title,$surname){
    $headers  = 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

     

    // Create email headers
$emailweb = "support@lasucomputerscience.com";
$emailweb2 = "support@lasucomputerscience.com";

    $headers .= 'From: LASU e-Helpdesk <'.$emailweb.">"."\r\n".

        'Reply-To: '.$emailweb2."\r\n" .

        'X-Mailer: PHP/' . phpversion();

     $time = date('d-M-Y h:i:s a', time());
    // Compose a simple HTML email message
  $message = "<HTML><BODY>
<div style='font-family:arial; border:2px solid #c0c0c0; padding:15px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px;'>
<div style='font-size:20px; color:darkblue; font-weight:bold;'>e-Helpdesk REGISTRATION</div>
    <br /> 

Dear ".$title." ".$surname.", <br/><br/>
 <center>$body</center><br/><br/>Thank you.<br/><br/>
e-Helpdesk Services,<br /> support@lasucomputerscience.com.
</div></BODY></HTML>";


    // Sending email

    if(mail($to, $subject, $message, $headers)){

        //echo '';

    } else{

        //echo '';

    }

}
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="js/ajaxCode.js"></script>
<script>
function passmatch(){
	var pass=document.getElementById('pass').value;
	var cpass=document.getElementById('cpass').value;
	if (pass==cpass){
		document.getElementById('glypass').innerHTML="<span style='color:green; font-size:20px' class='glyphicon glyphicon-ok-circle'>Matched</span>";
				}
	else{
		document.getElementById('glypass').innerHTML="<span style='color:red; font-size:20px' class='glyphicon glyphicon-remove-circle'>Mismatched</span>";
}		}	

	function val(){
	if(reg.pass.value!=reg.cpass.value){
		alert("Password Confirmation Does not Match");
		return false;			
	}}
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
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		<li><a href="login.php" class="dropdown-toggle" ><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">


<div class="col-md-1"></div>
<div class="container well col-md-9">
<h3>Register a <span style="color:red">New</span> Account </h3><br/>
  <form role="form" method="post"   onsubmit='return val()' id='others' name='reg'>
    <?php
	echo "<center><table style='width:90%' class=\"table table-striped table-bordered table-hover\">
	<tr>
	<th style='width:30%'>Title:</th>
	<td><select class=\"form-control\" required name=\"title\">
	<option  value=\"\">Select your title </option>
	<option value='Mr'>Mr.</option>
	<option value=\"Mrs\">Mrs.</option>
	<option value=\"Chief\">Chief</option>
	<option value=\"Dr\">Dr.</option>
	<option value=\"Engr\">Engr.</option>
	<option value=\"Prof\">Prof.</option>
	
	</select></td>
	</tr>
	<tr>
	<th>Firstname:</th>
	<td><input required class=\"form-control\" type=\"text\" name=\"firstname\"></td>
	</tr>
	<tr>
	<th>Surname:</th>
	<td><input required class=\"form-control\" type=\"text\" name=\"surname\"></td>
	</tr>
	<tr>
	<th>Phone Number:</th>
	<td><input required class=\"form-control\" type=\"number\" placeholder='' name=\"phoneno\"></td>
	</tr>
	<tr>
	<th>E-mail:</th>
	<td><input class=\"form-control\" type=\"email\" placeholder='Please enter a valid e-Mail address' name=\"email\"></td>
	</tr>
	<tr>
	<th>Password:</th>
	<td><input id=\"pass\" required class=\"form-control\" minlength=\"6\" type=\"password\" name=\"pass\"></td>
	</tr>
	<tr>
	<th>Confirm Password: <span id=\"glypass\" ></span></th>
	<td><input required id=\"cpass\" class=\"form-control\" type=\"password\" name=\"cpass\"  onkeyup=\"passmatch()\"></td>
	</tr>
	<tr>
	<th></th>
	<td><input  class=\"btn btn-primary\"  type=\"submit\"  id='submit'  name=\"subnew\"  value=\"Submit\"/></td>
	</tr>
	</table>
	
	
	</center>";
	?>
 
  </form>

</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<nav class="navbar navbar-inverse navbar-fixed-bottom" style="height:20px">
  <div class="container-fluid">
    <div style="text-align:center;color:white" ><br>
	Designed by e-Helpdesk Team &copy; <?php echo date('Y')?> 
   </div>
</nav>
</body>
</html>
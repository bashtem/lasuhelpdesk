<?php session_start();
require_once("connect.php");

if(isset($_SESSION['emailse'])){
  //header("Location:./");
  ?>
  <script type="text/javascript">
    window.location.assign("./");
  </script>
  <?
}


if (isset($_POST['login'])){
      $email=$_POST['email'];
      $pass= md5($_POST['pass']);
      $sql="select * from user where password='$pass' and email='$email'";
      $query=mysqli_query($con,$sql);
      if (mysqli_num_rows($query)==1){
      	$_SESSION['email'] = $email;
        $_SESSION['timestamp'] = time();

      	?>
      <script>
      window.alert("You are about to login! Please ensure you log out when you are done!");
      var loc="panel.php";
      window.location.assign(loc);
      </script>
      <?php
      }else{
      	?>
      <script>
      window.alert("Invalid email/password combination!");
      var loc="login.php";
      window.location.assign(loc);
      </script>
      <?php
      }
}else if(isset($_SESSION['email'])){
  header("Location: panel.php");
}


if(isset($_POST['forgot'])){
  $email = trim($_POST['email']);
  $query = "SELECT * FROM user WHERE email='$email'";
  $check = mysqli_num_rows(mysqli_query($con,$query));
  if ($check==1){

    $time = time()+86400;
    $encodeEmail = base64_encode($email);
    $encodeTime = base64_encode(base64_encode($time));
    $query = "UPDATE user SET forgot_code='$encodeTime', password='' WHERE email='$email' "; 
    mysqli_query($con,$query);
    $cat = base64_encode("0");
    $url = "recovery.php?id=".$encodeEmail."&token=".$encodeTime."&cat=".$cat;

    //echo $url;
    //exit;

    // SEND MAIL FOR RECOVERY
                   $to=$email;
                   $subject="LASU e-HelpDesk Password Reset Link";
                   $body="Please follow this link <a href='".$domain.$url."'>".$domain.$url." </a> to reset your Password. This link will expire in 24 hours. ";
      include("sendmail.php");
      sendMail($to,$subject,$body);

?>
<script type="text/javascript">
  alert("Please Check your Mail for Recovery!");
  window.location.assign("./login.php");

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


/*if (isset($_POST['submit'])){

$dbname="lasu_helpdesk";
$con=mysqli_connect("localhost","root","",$dbname);
$sql="select distinct(email) from datas order by email asc";
if(($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)>=1)){
while($row=mysqli_fetch_array($query)){

}}}
*/

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="js/ajaxCode.js"></script>
<script type="text/javascript">


  $(document).ready(function(){

    $("#forgot").click(function(){
      $.get("forgot.php",function(data,status){
        //alert("Data: " + data + "\nStatus: " + status);
        $("#portal").hide();
        $("#portal").html(data);
        $("#portal").fadeIn(3000);
      });
    });

  })
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
<h3>User Login ... </h3>
  <form role="form" method="post" action=""  id='others'>
    <div class="form-group">
	<br>
      <!-- <label for="email">E-Mail:</label> -->
      <input style="width:50%" type="email" name="email" required class="form-control" id="email" placeholder="E-Mail">
    </div>
	<div class="form-group">
	<br>
      <!-- <label for="email">Password:</label> -->
      <input style="width:50%" type="password" name="pass" placeholder="*********************" required class="form-control" id="pass" >
    </div>
	<div class="form-group" >
		 <button id="sub" type="submit" name="login" onclick=""  class="btn btn-success">Submit</button>

    </div>
 <button id="forgot" type="button" name="forget"  style="float:right" class="btn btn-danger">&raquo; Forgot Password?</button>

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
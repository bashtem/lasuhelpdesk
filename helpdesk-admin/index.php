<?php session_start();
require_once("../connect.php");
//require_once("session.php");

if (isset($_POST['login'])){

    $user=$_POST['username'];
    $pass= md5($_POST['pass']);
    $sql="select * from admin where password='$pass' and username='$user'";
    $query=mysqli_query($con,$sql);
    if (!mysqli_num_rows($query)==1){
    	$_SESSION['user'] = $user;
      $_SESSION['timestamp'] = time();

    	?>
              <script>
              window.alert("logging... in! Please ensure to log out when you are done!");
              var loc="admin_panel.php";
              window.location.assign(loc);
              </script>
    <?php
    }else{
    	?>
              <script>
              window.alert("Invalid user/password combination!");
              var loc="./";
              window.location.assign(loc);
              </script>
    <?php
    }
}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="../js/ajaxCode.js"></script>


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
      <a class="navbar-brand" href="../#">e-HelpDesk</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Admin</a></li>
         
      </ul>
    
  </div>
</nav>
<div class="container">


<div class="col-md-2"></div>
<div class="container well col-md-8">
    <div class="col-md-4"></div>
          <div class="col-md-4">

                <div class="text-center">
                        
                        <img style="width: 80px; height: 80px" src="../custom/images/logo2.gif">
                        <h3 style="color:#36A166" >Admin Login </h3>
                </div>
                          <form role="form" method="post"   id='others'>
                                <div class="form-group">
                            	<br>
                                 <!--  <label for="email">Username:</label> -->
                                  <input type="text" name="username" required class="form-control" id="user" placeholder="Username">
                                </div>
                            	<div class="form-group">
                            	<br>
                                  <!-- <label for="email">Password:</label> -->
                                  <input type="password" name="pass" required class="form-control" placeholder="**************" id="pass" >
                                </div>
                            	<div class="form-group text-center" >
                            		 <button id="sub" type="submit" name="login" onclick=""  class="btn btn-success">Submit</button>

                                </div>
                             
                          </form>
          </div>
    <div class="col-md-4"></div>
</div>
<div class="col-md-2"></div>
</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<nav class="navbar navbar-inverse navbar-fixed-bottom" style="height:20px">
  <div class="container-fluid">
    <div style="text-align:center;color:white" ><br>
	       Designed by e-Helpdesk Team &copy; <?php echo date('Y')?>
   </div>
   </div>
</nav>
</body>
</html>
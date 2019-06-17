<?php session_start();
	include("session.php");
	include("connect.php");
	
		
					
if(isset($_POST['update'])){

	$surname=$_POST['surname'];
	$firstname=$_POST['firstname'];
	$email=$_POST['email'];
	$phoneno=$_POST['phoneno'];
	$pass =md5($_POST['pass']);
	$sqlupdate="UPDATE user SET sname='$surname', onames='$firstname', email='$email', phone='$phoneno', password='$pass'";
	if($qupdate=mysqli_query($con,$sqlupdate)){
	?>
	<script>
	alert("Profile Updated");
	document.getElementById('output').innerHTML="<span style='color:green; font-size:20px' >Profile Updated</span>";
	</script>
	<?php

	}
}
	
?>



<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/timed.js"></script> 


<style>
/* The Modal (background) */
.modali {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
     overflow: auto;/* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: center;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 1s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    
    float: right;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    background-color: #006699;
    color: black;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 2px 16px;
    
    color: white;
}
</style>

<script>
function newmatch(){
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
	
	function pval(){
	var pass=document.getElementById('pass').value;
	var cpass=document.getElementById('cpass').value;
	if(pass!=cpass){
		document.getElementById('output').innerHTML="<span style='color:red; font-size:20px' >Profile Update Failed</span>";
		return false;
}
	}
	function len(){
	var x;
	x = document.getElementById('txtlength').value;
	var check = x.length;
	if(check >=200)
	alert("Maximum of 200 Characters");
	
		}
function show(){
var text = document.getElementById('dis').value;
alert(text);
}
	
</script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid ">
    <div class="navbar-header ">
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
         <li class="active"><a onclick="reqnew()" href="#">Make Request<span></span></a></li>
		 <li class="active"><a  onclick="requests()" href="#">My Requests<span></span></a>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" style="color: white" ><?php echo "<style=color:red>$name</style>"; ?>  <span class="glyphicon glyphicon-user"></span> </a></li>
		<li><a href="logout.php"  class="btn btn-danger" style="color: white; font-weight: bold">Logout</a></li>        
      </ul>
    </div>
  </div>
</nav><br><br><br><br>


<div id="popup"  class="modali">
  <!-- Modal content -->
  <div class="modal-content">
  <form method="POST">
    <div class="modal-header">
      <span id="exit" class=" btn btn-danger" style="float:right" ><a href="#" style="text-decoration:none; ">Close</a></span>
      <h2> </h2>
    </div>
    <div class="modal-body">
	
	<textarea align="center" id="textarea"  readonly name="report" required  class="form-control" rows="10"></textarea>  
	 
    </div>
	
	<input id="reqno" type="text" name="reqno" value="" hidden >
	<input id="mail" type="text" name="mail" value="" hidden >
	<input id="repreqfile" type="text" name="file" value="" hidden >
	
    <div class="modal-footer">
      <!--<input type="submit" id="submit" name="subreport" class="form-control btn-success" value="Submit">-->
    </div>
	</form>
	<div id="reqfooter">
		
	</div>
  </div>
</div>


<div class="container">

	<div class="container well col-md-2">

	<p align="center"><img src="custom/images/logo2.gif"></p><hr/>
	<a href="#"class="btn btn-primary form-control" onclick="reqnew()" >Make Request <span class="glyphicon glyphicon-pencil"></span></a>
	<hr/>
	<a href="#"class="btn btn-primary form-control" onclick="requests()" >My Requests <span class="glyphicon glyphicon-list-alt	"></span></a>
	<hr/>
	<a href="#" class="btn btn-primary form-control" onclick="view_profile()"> My Profile <span class="glyphicon glyphicon-user"></span></a>
	<hr/>

	</div>


	<div class="col-md-1"></div>

	<div class="container well col-md-9" id="change">

		<img style="padding-left:45%" src="custom/images/logo2.gif">
		<h2 align="center" > WELCOME <?php echo $name; ?></h2>

	</div>

</div><br><br><br><br>



<nav class="navbar navbar-inverse navbar-fixed-bottom" >
  <div class="container-fluid">
    <div style="text-align:center;color:white" ><br>
	Designed by e-Helpdesk Team &copy; <?php echo date('Y') ?>
   </div>
</nav>

<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/ajaxCode.js"></script>
<script>

// Get the modal
var modal = document.getElementById("popup");

// Get the button that opens the modal
//var bttn = document.getElementById("treat");

// Get the <span> element that closes the modal
var span = document.getElementById("exit");

// When the user clicks the button, open the modal 

 function request(data,file, basename) {
	 var req= document.getElementById(data).value;
	 	 //alert(req);
	 document.getElementById("textarea").value=req;
	 document.getElementsByTagName("h2")[0].innerHTML="Request";
    modal.style.display = "block";


    document.getElementById("reqfooter").innerHTML="";
	if((file!="")&&(basename!="")){
		document.getElementById("reqfooter").innerHTML="<span style='padding-left:20px' > Attachment :<a class='btn btn-success' target='_blank' href="+file+">"+ basename+" <span class='glyphicon glyphicon-paperclip'><span></a></span>";
	}

}


function report(data) {
	document.getElementById("reqfooter").innerHTML="";
	 var rep= document.getElementById(data).alt;
	 	 //alert(req);
	 document.getElementById("textarea").value=rep;
	 document.getElementsByTagName("h2")[0].innerHTML="Report";
    modal.style.display = "block";
}


// When the user clicks on <span> (x), close the modal
span.onclick=function() {
	
    modal.style.display = "none";

}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
       modal.style.display = "none";
    }
}

function servicefind(serv){
	
	xmlHttp=getXMLHttpRequest();
	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return;
	}
	var sub_id= document.getElementById(serv).value;	
	var url="servicefind.php?sub_id="+sub_id;
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("servicefind").innerHTML=xmlHttp.responseText;
		}else if(xmlHttp.readyState==3){
			document.getElementById("servicefind").innerHTML="Loading...";
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);
	}
	

function repcon(){
	
	var con=confirm("Are you sure you want to Submit?");
	if(con==true){

		return true;
	}
	else
		return false;
	
}

</script>


</body>
</html>

<?php  
if(isset($_GET['temp'])){ 
?>
<script>
<?php echo $_GET['temp']; ?>();
</script>
<?php

 }

 ?>

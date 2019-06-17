<?php session_start();
include("../connect.php");


?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/ajaxCode.js"></script>
<script type="text/javascript">
	
function reg_hou(mail){
	xmlHttp = new XMLHttpRequest();

	if(xmlHttp==null){
		alert("Your browser does not support Ajax");
		return false;
	}	
	var url="hou/new_hou.php?mail="+mail;
	xmlHttp.onreadystatechange=function(){ 
		if (xmlHttp.readyState==4){ 
			document.getElementById("head_portal").innerHTML="";
			var res =xmlHttp.responseText;
			$("#head_portal").html(res);
		}else{
			document.getElementById("head_portal").innerHTML='<center><img  src="../fonts/loading.gif"></center>';
		}
	}
	xmlHttp.open("GET",url,true);	
	xmlHttp.send(null);
}

</script>
<style type="text/css">
	#login_notify{
		display: none;
		background-color: white;
		font-style: italic;
		font-size: 13px;
		border: 1px solid white;
		border-radius: 9px;
	}
</style>
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
        <li><a href="./">Login <span class="glyphicon glyphicon-log-in"></span></a></li>
		<li><a href="./" class="dropdown-toggle" data-toggle="dropdown"></a></li>
        
      </ul>
    </div>
  </div>
</nav><br><br><br><br>
<div class="container">

	<div class="col-md-2"></div>
	<div class="container well col-md-8">
	    <div class="col-md-4" id="left_head_panel"></div>
	          <div class="col-md-4" id="head_portal">

	                <div class="text-center">
	                        
	                        <img style="width: 80px; height: 80px" src="../custom/images/logo2.gif"><br><br>
	                        <h4 style="color:#191970" >VC / HEAD OF UNIT  </h4>
	                </div>

	                <p id="login_notify" class="text-center"> yep</p>
	                          <form role="form" method="post"   id='others'>

	                          		<div class="form-group">
	                            		<select required name="acc_type" id="acc_type" class="form-control">
	                            			<option value="" >Select Account Type</option>
	                            			<option value="hou" >Head Of Unit</option>
	                            			<option value="vc">Vice Chancellor</option>
	                            			
	                            		</select>
	                                </div>

	                                <div class="form-group" style='display:none' id="email_user">
	                            
	                                
	                                </div>
	                            	<div class="form-group">
	                            	                
	                                  <input type="password" name="pass" required class="form-control" placeholder="**************" id="pass" >
	                                </div>
	                                

	                           <div class="form-group text-center" >
	                             <button id="sub_hou_vc" type="button" name="login"  class="btn btn-primary">Login</button>
	                            		 <!-- <a href="#" id="sub_hou_vc" class="btn btn-primary">Login</a> -->

	                            </div>
	                             
	                          </form>
	          </div>
	    <div class="col-md-4"></div>
	</div>
	<div class="col-md-2"></div>
</div>
<br><br><br><br>
<nav class="navbar navbar-inverse navbar-fixed-bottom" ">
  <div class="container-fluid">
    <div style="text-align:center;color:white" ><br>
		Designed by e-Helpdesk Team &copy; &nbsp;<?php echo date('Y') ?>
   </div>
   </div>
</nav>
</div>
</body>
<script>

$(document).ready(function(){

	$("#sub_hou_vc").click(function(){


		//alert("Naso oo ");
		var acc_type = $("#acc_type").val();
		var pass = $("#pass").val();
		var email=$("#email").val();
		var user=$("#username").val();

	

if(acc_type=='hou'){

	if((pass=='') || (email=='') ){
		$("#login_notify").attr("style", "color:#C96464");
					$("#login_notify").html("Supply Proper Credential");
					$("#login_notify").slideDown('slow');
					setTimeout( function(){
					$("#login_notify").slideUp('slow')
					$("#login_notify").html("");} , 2000);

	}else{

		var index = email.indexOf('@');
		if(index==-1){
					$("#login_notify").attr("style", "color:#C96464");
					$("#login_notify").html("Enter Valid e-Mail");
					$("#login_notify").slideDown('slow');
					setTimeout( function(){
					$("#login_notify").slideUp('slow')
					$("#login_notify").html("");} , 2000);

		}else{

			$.ajax({

				url : "operations.php",
				method : "POST",
				data :{
					action: "login",
					acc_type: acc_type,
					password: pass,
					email : email
					
				},

				cache: false,
				beforeSend : function(){
					$('#sub_hou_vc').html("Login <i class='fa fa-spinner fa-spin'></i>")
				},

				success : function(data){

					//alert(data);
					if(data){
						var result = JSON.parse(data);
						if(result.response==true){

							//alert(result.acc_type);
							$("#login_notify").attr("style", "color:#389738");
							$("#login_notify").html(result.reason);
							$("#login_notify").slideDown('slow');
							setTimeout( function(){
							$("#login_notify").slideUp('slow')
							$("#login_notify").html("");
							$('#sub_hou_vc').html("Login");
							window.location.assign('hou/')}
							, 2000);
							
							
						}else{

							$("#login_notify").attr("style", "color:#C96464");
							$("#login_notify").html(result.reason);
							$("#login_notify").slideDown('slow');
							setTimeout( function(){
							$('#sub_hou_vc').html("Login");
							$("#login_notify").slideUp('slow');
							$("#login_notify").html("");} , 2000);
							
							
						}
					}
				}

			})




		}
	

	}

}else if(acc_type=='vc'){
	if((pass=='') || (user=='') ){
		$("#login_notify").attr("style", "color:#C96464");
					$("#login_notify").html("Supply Proper Credential");
					$("#login_notify").slideDown('slow');
					setTimeout( function(){
					$("#login_notify").slideUp('slow')
					$("#login_notify").html("");} , 2000);

	}else{
				$.ajax({

				url : "operations.php",
				method : "POST",
				data :{
					action: "login",
					acc_type: acc_type,
					password: pass,					
					username:user
				},

				cache: false,
				beforeSend : function(){
					$('#sub_hou_vc').html("Login <i class='fa fa-spinner fa-spin'></i>")
				},

				success : function(data){

					if(data){
						var result = JSON.parse(data);
						if(result.response==true){

							$("#login_notify").attr("style", "color:#389738");
							$("#login_notify").html(result.reason);
							$("#login_notify").slideDown('slow');
							setTimeout( function(){
							$("#login_notify").slideUp('slow');
							$("#login_notify").html("");
							$('#sub_hou_vc').html("Login"); 
							window.location.assign('vc/') }, 2000);
						}else{

							$("#login_notify").attr("style", "color:#C96464");
							$("#login_notify").html(result.reason);
							$("#login_notify").slideDown('slow');
							setTimeout( function(){
							$('#sub_hou_vc').html("Login");
							$("#login_notify").slideUp('slow');
							$("#login_notify").html("");} , 2000);
						}
					}
				}

			})


	}

}else{

	$("#login_notify").attr("style", "color:#C96464");
					$("#login_notify").html("Select Account Type");
					$("#login_notify").slideDown('slow');
					setTimeout( function(){
					$("#login_notify").slideUp('slow')
					$("#login_notify").html("");} , 2000);
}

		

	})

})







$("#acc_type").on("change", function(){ 	
	if(this.value=="vc"){
		$("#email_user").html("<input type='text' class='form-control'  required placeholder='Username' id='username' name='username'>");
		$("#email_user").slideDown("slow");
	}else if(this.value=="hou"){
			$("#email_user").html("<input type='email' name='email'  required class='form-control' id='email' placeholder='E-Mail'>");
			$("#email_user").slideDown("slow");
	}else{
			$("#email_user").html("");
			$("#email_user").slideUp("");
	}
	

 });

function passmatch(){
	var pass=document.getElementById('spass').value;
	var cpass=document.getElementById('scpass').value;
	if (pass==cpass){
		document.getElementById('glypass').innerHTML="<span style='color:green; font-size:15px' class='glyphicon glyphicon-ok-circle'>Matched</span>";
				}
	else{
		document.getElementById('glypass').innerHTML="<span style='color:red; font-size:15px' class='glyphicon glyphicon-remove-circle'>Mismatched</span>";
		
}		
	}	


function val(){
	if(reg_hou.spass.value!=reg_hou.scpass.value){
		alert("Password Mismatched !");
		return false;			
	}}



</script>
</html>



<?php

if(isset($_GET['profile'])){
	$mail= base64_decode($_GET['encmail']);
	$enctime= base64_decode($_GET['profile']);
	
	if(!(time()>$enctime)){
?>
<script type="text/javascript">		
	reg_hou('<?php echo $mail; ?>');
</script>
<?php
}else{
?>

<script>

 alert('Link Expired !');
 window.location.assign('./');


</script>

<?php
}

	}



?>


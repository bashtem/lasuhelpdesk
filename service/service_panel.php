<?php session_start();
include("service_session.php");
//header("Refresh: 30, url=index.php");


// SUBJECTS OF A UNIT IS ADDED HERE !!!!!!!!!!!!!!!!!!!!

$cnt=0;
foreach($data as $badge){
$sqlnotificate="select * from $unit_table where subject_id='$badge' AND checked='0' ";
$msgNotificate="SELECT * from query_msg where unit_id='$unit_id' AND recipient_view='1' ";
$result=mysqli_query($con,$sqlnotificate);
$msgResult=mysqli_query($con,$msgNotificate);
$countMsg=mysqli_num_rows($msgResult);
$ans[$cnt]=mysqli_num_rows($result);

if($countMsg>=1){
	$msgNotificate = "<span style='color:red'class='badge'> $countMsg </span>";
}else{
	$msgNotificate="";
}


if($ans[$cnt]>=1)
$notify[$cnt]="<span style='color:red'class='badge'> $ans[$cnt]</span>";
else
	$notify[$cnt]="";
$cnt++;
}



function query_msg($con){

if( isset($_POST['subquery']) ){
$recipient_time = time();	
$recipient_msg = $_POST['query_msg'];
$req_id = $_POST['req_id_query'];

$sqlSend = "UPDATE query_msg  SET  recipient_msg='$recipient_msg', recipient_time='$recipient_time',recipient_view='0', sender_view='1' WHERE req_id='$req_id' ";

if( mysqli_query($con,$sqlSend) ){
?>
		<script>
				alert("Query Sent.");
				window.location.assign("./");

		</script>
<?php
			}else{
				?>
				<script>
				 	alert("Query Not Sent.");
				 	window.location.assign("./");
				</script>
				<?php
			}
		}
	}

query_msg($con);

?>




<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/modal.css">
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/ajaxCode.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/timed.js"></script> 


<script>

	function newmatch(){
	var pass=document.getElementById('pass').value;
	var cpass=document.getElementById('cpass').value;
	if (pass==cpass){
		document.getElementById('glypass').innerHTML="<span style='color:green; font-size:20px' class='glyphicon glyphicon-ok-circle'>Matched</span>";
	
	}
	else{
		document.getElementById('glypass').innerHTML="<span style='color:red; font-size:20px' class='glyphicon glyphicon-remove-circle'>Mismatched</span>";
}		
	}	


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
		
function show(data){
	
	var xmlHTTP= new XMLHttpRequest();
	
	var sub_id = document.getElementById(data).innerHTML;
	var text = document.getElementById(data).rel;
	var url = "req_link.php?select="+text+"&sub_id="+sub_id;
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){
			
			document.getElementById('service').innerHTML="";
			var fade=xmlHTTP.responseText;
			jNode = $(fade);
			jNode.hide();
			$('#service').append(jNode);
			jNode.fadeIn(2000);
			
		}else{
			document.getElementById('service').innerHTML="<center><img  src='../fonts/loading.gif'></center>";
			
		}
		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();

}


function query_msg(data){
	
	var xmlHTTP= new XMLHttpRequest();
	
	/*var sub_id = document.getElementById(data).innerHTML;
	var text = document.getElementById(data).rel;*/
	//var url = "req_link.php?select="+text+"&sub_id="+sub_id;
	var url = "query_msg.php";
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){
			
			document.getElementById('service').innerHTML="";
			var fade=xmlHTTP.responseText;
			jNode = $(fade);
			jNode.hide();
			$('#service').append(jNode);
			jNode.fadeIn(2000);
			
		}else{
			document.getElementById('service').innerHTML="<center><img  src='../fonts/loading.gif'></center>";
			
		}
		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();

}

function pages(url,data,sub_id){
	
	var xmlHTTP= new XMLHttpRequest();	
	if(sub_id=="")
	var url = url+"?page="+data;
		else
	var url = url+"?sub_id="+sub_id+"&page="+data;
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){
			
			document.getElementById('service').innerHTML="";
			var fade=xmlHTTP.responseText;
			jNode = $(fade);
			jNode.hide();
			$('#service').append(jNode);
			jNode.fadeIn(2000);
			
		}else{
			document.getElementById('service').innerHTML="<center><img  src='../fonts/loading.gif'></center>";			
		}		
	}	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();
}





function pagesearch(data, mail){
	
	var xmlHTTP= new XMLHttpRequest();	
	var url = "search.php?page="+data+"&email="+mail;
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){
			
			document.getElementById('service').innerHTML="";
			var fade=xmlHTTP.responseText;
			jNode = $(fade);
			jNode.hide();
			$('#service').append(jNode);
			jNode.fadeIn(2000);
			
		}else{
			document.getElementById('service').innerHTML="<center><img  src='../fonts/loading.gif'></center>";
			
		}
		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();

}


function getsearch(){
	
	
	var emailbox=document.getElementById("searchmail");
	emailbox.onkeyup= function(){
		document.getElementById("emailerror").innerHTML="";
	}
	var email=document.getElementById("searchmail").value;
	//alert(email);
	if(email.length>5){
	var xmlHTTP= new XMLHttpRequest();
	var url = "search.php?email="+email;
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){
			
			document.getElementById('service').innerHTML="";
			var fade=xmlHTTP.responseText;
			jNode = $(fade);
			jNode.hide();
			$('#service').append(jNode);
			jNode.fadeIn(2000);
			
		}else{
			document.getElementById('service').innerHTML="<center><img  src='../fonts/loading.gif'></center>";
			
		}
		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();
	}
	else {
		document.getElementById("emailerror").innerHTML="<span style='color:red'><i>input a valid e-mail</i></span>"
		//alert("Input a valid e-mail");
		
	}
	
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
        <li class="active"><a href="../">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" style="color: white"><?php echo "<style=color:red>$name</style>"; ?> <span class="glyphicon glyphicon-user"></span> </a></li>
		<li><a href="logout.php"  class="btn btn-danger" style="color: white; font-weight: bold" >Logout</a></li>
        
      </ul>
    </div>
  </div>
</nav><br><br><br><br>


<div id="popup"  class="modali">

  <!-- Modal content -->
  <div class="modal-content">
  <form method="POST" id="tre" onsubmit="return trecon();">
    <div class="modal-header">
      <span id="exit" class=" btn btn-danger" style="float:right" ><a href="#" style="text-decoration:none; ">Close</a></span>
      <h2>Treat Request </h2>
    </div>
    <div class="modal-body">	
	<textarea align="center" id="textarea"  name="report" required  class="form-control" rows="10"></textarea>	 
    </div>
	
	<input id="req_id" type="text" name="req_id" value="" hidden >
	<input id="mail" type="text" name="mail" value="" hidden >
	<input id="subject" type="text" name="subject" value="" hidden >
	
    <div id="modalfooter" class="modal-footer">
      <input type="submit" id="submit" name="subreport"  class="form-control btn-success" value="Submit">
    </div>
	
	</form>
  </div>

</div>


<div id="repreq"  class="modali">

  <!-- Modal content -->
  <div class="modal-content">
  <form method="POST" id="repreqform" >
    <div class="modal-header">
      <span id="exitrepreq" class=" btn btn-danger" style="float:right" ><a href="#" style="text-decoration:none; ">Close</a></span>
      <h2>  </h2>
    </div>
    <div class="modal-body">
	
	<textarea align="center" id="textrepreq"  readonly name="report" required  class="form-control" rows="10"></textarea>  
	 
    </div>
	
	<input id="repreqno" type="text" name="reqno" value="" hidden >
	<input id="repreqmail" type="text" name="mail" value="" hidden >
	<input id="repreqfile" type="text" name="file" value="" hidden >
	
   <!-- <div id="modalfooter" class="modal-footer">
      <input type="submit" id="submit" name="subreport"  class="form-control btn-success" value="Submit">
    </div>-->
	
	</form>
	<div id="reqfooter">
		
	</div>
  </div>

</div>


<div id="query_msg_modal"  class="modali">

  <!-- Modal content -->
  <div class="modal-content">
  <form method="POST" id="tre" onsubmit="return trecon();">
    <div class="modal-header">
      <span id="exit_query_msg" class=" btn btn-danger" style="float:right" ><a href="#" style="text-decoration:none; ">Close</a></span>
      <h3>Query Message </h3>
    </div>
    <h4 style="padding: 2px 16px"><span class="glyphicon glyphicon-comment"></span> Message :</h4><hr>
    <div id="msgBody" style="padding: 2px 16px">


    </div><hr>
    
    <div class="modal-body">	
		<textarea align="center" id="textarea_query_msg" placeholder="Type your comments here..."  name="query_msg" required  class="form-control" rows="4"></textarea>	   

    </div><br>	
	 <input id="req_id_query" type="text" name="req_id_query" value="" hidden >
	<!-- <input id="mail" type="text" name="mail" value="" hidden > -->
	<!-- <input id="subject" type="text" name="subject" value="" hidden > -->

    <div id="modalfooterQuery" class="modal-footer">
      <!-- <input type="submit" id="submit" name="subreport"  class="form-control btn-success" value="Submit"> -->
      <button type="submit" name="subquery" class="form-control btn-success"> Reply Query <span class="glyphicon glyphicon-send"></span></button>
    </div>
	
	</form>
  </div>

</div>


<div class="container-fluid">


	<div class="container well col-md-3">
		<p class="text-center"><img src="../custom/images/logo2.gif"></p><hr/>

	<div>
		<ul class="nav nav-pills">
			<li class="active" ><a  href="#menu" data-toggle="tab" style="font-size: 13px">Category</a></li>
			<li ><a  href="#noti" id="msgNot" data-toggle="tab" style="font-size: 13px">Notifications <?php echo $msgNotificate ?> </a></li>
			<li><a href="#search" data-toggle="tab" style="font-size: 13px">  Search</a></li>
			<!-- <li><a href="#stat" data-toggle="tab">  Stats.</a></li> -->
		</ul><hr>

	<div class="tab-content">

		<div class="tab-pane fade in active" id="menu">
			<?php

				$i=0;
				foreach($data as $value){					
					// SUBJECT IS PICKED HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!
							
				echo "
				<a href=\"#\" class=\"btn btn-primary form-control\" style=\"font-size: 13px\" onclick=\"show('url"; echo "$i')\" >$subject[$i] <span id='$value'>$notify[$i]</span></a><hr/>
				<a href=\"#\" hidden id=\"url$i\"  rel='$unit'  >$data[$i]</a>";        //HERE!!!!!!!!!!!!!!!!
				$i++;
				}
			?>

		</div>

		<div class="tab-pane fade " id="search">
			<form method="POST"  >				
				<input class="form-control" type="email" name="search" id="searchmail" required placeholder="Enter a valid e-Mail">
				<p style="float:right" id="emailerror"></p><hr>
				<a class="form-control btn btn-primary " href='#' onclick="getsearch()"  >Search</a>
			</form>
		</div>

		<div class="tab-pane fade " id="noti">
			<a href="#" class="btn btn-primary  form-control" id="msgQuery" onclick="query_msg()" >Query Messages <?php echo $msgNotificate ?></a>
		</div>
				
		<div class="tab-pane fade" id="stat">
				
		</div>
				
				
	</div>

	</div>
	</div>





<div class="col-md-1"></div>


<div class="container col-md-8" id="service">
	<img style="padding-left:45%" width='490' src="../custom/images/logo2.gif">
	<h2 align="center" > WELCOME <?php echo $name; ?></h2>
	<p style="color:red; text-align:center; font-size:25px"><b><?php echo"LAGOS STATE UNIVERSITY, SCHEDULE OFFICER ". strtoupper($unit) ." UNIT"?></b></p>
</div><br><br><br><br>



<nav class="navbar navbar-inverse navbar-fixed-bottom" style="height:20px">
  <div class="container-fluid">
    <div style="text-align:center;color:white" ><br>
	Designed by e-Helpdesk Team &copy; <?php echo date("Y"); ?>
   </div>
</nav>



<script>

// Get the modal
var modal = document.getElementById("popup");
var modalrepreq = document.getElementById("repreq");
var modalQuery = document.getElementById("query_msg_modal");

// Get the <span> element that closes the modal
var span = document.getElementById("exit");
var spanrepreq = document.getElementById("exitrepreq");
var spanQuery = document.getElementById("exit_query_msg");

spanQuery.onclick=function() {
	var con=confirm("Are you sure you want to close the window?");
	if(con==true){	
	document.getElementById("modalfooterQuery").innerHTML='<button type="submit" name="subquery" class="form-control btn-success"> Submit Query <span class="glyphicon glyphicon-send"></span></button>';
    modalQuery.style.display = "none";
}else
	modalQuery.style.display = "block";
	
}


// When the user clicks the button, open the modal 

function recipient(response,req_id,senderMsg,recipientTime) {	 
	document.getElementById("textarea_query_msg").value=response;	
	document.getElementById("req_id_query").value=req_id;	
	document.getElementById("msgBody").innerHTML=senderMsg;
if(recipientTime!=""){
		document.getElementById("modalfooterQuery").innerHTML="";
}

    modalQuery.style.display = "block";
}
 

function treat(mail) {
	 
	 var req_id= document.getElementById(mail).alt;
	 var subject= document.getElementById(mail).title;
	 //alert(reqno);
	 var mail= document.getElementById(mail).value; 
	 document.getElementById("req_id").value=req_id;
	 document.getElementById("mail").value=mail;
	 document.getElementById("subject").value=subject;
	 //alert(test);
	 document.getElementsByTagName("h2")[0].innerHTML="Treat Request";
	 document.getElementById("textarea").value="";
	 
	 document.getElementById("submit").value="Submit";
    modal.style.display = "block";
}

function report(data) {
	 document.getElementById("reqfooter").innerHTML="";
	 var rep= document.getElementById(data).alt;
	 	 //alert(req);
	 document.getElementById("textrepreq").value=rep;
	 document.getElementsByTagName("h2")[1].innerHTML="Report";
	// var parent =document.getElementById("modalfooter");
	// var child = document.getElementById("submit");
	 //parent.removeChild(child);
    modalrepreq.style.display = "block";
}

// When the user clicks on <span> (x), close the modal

span.onclick=function() {
	var con=confirm("Are you sure you want to close the window?");
	if(con==true)
	
    modal.style.display = "none";
else
	modal.style.display = "block";
	
}

spanrepreq.onclick=function() {
	modalrepreq.style.display = "none";	
	
	
}

// When the user clicks anywhere outside of the modal, close it
//window.onclick = function(event) {
  //  if (event.target == modal) {
   //     modal.style.display = "none";
   // }
//}



function trecon(){
	
	var con=confirm("Are you sure you want to Submit?");
	if(con==true){
		return true;
	}
	else
		return false;
	
}

// Refresh badge Notification
var refreshbadge = setInterval(badgenotify, 10000);

function badgenotify(){ 
	 var xmlHTTP= new XMLHttpRequest();
	var url = "badge_update.php";
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){			
			var output = JSON.parse(xmlHTTP.responseText);
			document.getElementById("menu").innerHTML= output.notificate;				
			document.getElementById("msgNot").innerHTML="Notifications"+ output.msgnotificate;				
			document.getElementById("msgQuery").innerHTML= "Query Messages"+output.msgnotificate;				
		}		
	}	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();
}



function servicereq(data,notify,subject_id,element,file, basename) {
		
	 
	 var xmlHTTP= new XMLHttpRequest();
	 var url = "badge.php?notify="+notify+"&subject_id="+subject_id;
	 xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){			
			document.getElementById(subject_id).innerHTML=xmlHTTP.responseText;					
		}else{
			document.getElementById(subject_id).innerHTML="";			
		}		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();
		
	document.getElementById("reqfooter").innerHTML="";

	if((file!="")&&(basename!="")){
		document.getElementById("reqfooter").innerHTML="<span style='padding-left:20px' > Attachment :<a class='btn btn-success' target='_blank' href=../"+file+">"+ basename+" <span class='glyphicon glyphicon-paperclip'><span></a></span>";
	}

	var rowstate = document.getElementById(element).title; //="";
	if(rowstate=="locked"){
		document.getElementById(element).style.backgroundColor="#DBAAAA";
	}else{
		document.getElementById(element).style.backgroundColor="";
	}
	
	 var req= document.getElementById(data).value;
	 document.getElementById("textrepreq").value=req;	 
	 document.getElementsByTagName("h2")[1].innerHTML="Request";
	 document.getElementById("submit").value="";
    modalrepreq.style.display = "block";
	
	
}

</script>

</body>
</html>
<?php

// THIS SECTION TREAT THE USER REQUEST!!!!!!!!!!!!!!!!!!!!!!!!!!!!
if(isset($_POST['subreport'])){
		
	$report=$_POST['report'];
	$req_id=$_POST['req_id'];
	$mail=$_POST['mail'];
	$subject=$_POST['subject'];
	$treated_date=date("d-M-Y")." ".date("h:i:s");
	$hou_checked = 1;
	$vc_checked = 1;
	
	
	//echo $mail;
	$sqlreport="UPDATE $unit_table SET report='$report', request_status='1', treated_date='$treated_date', hou_checked ='$hou_checked', vc_checked='$vc_checked' WHERE req_id='$req_id' AND email='$mail'";
	
	if($sqlreport=mysqli_query($con,$sqlreport)){	
?>

			<script>
				alert("Request Treated");
				window.location.assign("./");
			</script>

<?php
// THIS SECTION SEND AN E-MAIL TO THE USER ONCE THE MESSAGE HAS BEEN TREATED!!!!!!!!!!!!!!!!!

	include("../sendmail.php");

	 $to=$mail;
	 $subject="LASU e-HelpDesk: ".$subject." Request Treated";
	 $body="Your Request Number: ".$req_id." has been treated. Please follow this link <a href='".$domain."'>".$domain." </a> to check your report/response.";
	 $headers="From: LASU E-HELPDESK: <support@lasucomputerscience.com>";

	 sendMail($to,$subject,$body);
	 
	}else
		exit;
	
}



?>


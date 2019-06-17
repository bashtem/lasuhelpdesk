<?php session_start();
include("head_session.php");
include("../processQuery.php");

query_msg($con,$unit_id);
replyVc($con);

// SUBJECTS OF A UNIT IS ADDED HERE !!!!!!!!!!!!!!!!!!!!

$cnt=0;
foreach($data as $badge){
$sqlnotificate="select * from $unit_table where subject_id='$badge' AND hou_checked='0' ";
$result=mysqli_query($con,$sqlnotificate);
$ans[$cnt]=mysqli_num_rows($result);

if($ans[$cnt]>=1)
$notify[$cnt]="<span style='color:red'class='badge'> $ans[$cnt]</span>";
else
	$notify[$cnt]="";
$cnt++;
}

$msgNotificate="SELECT * from query_msg where unit_id='$unit_id' AND sender_view='1' ";
$msgResult=mysqli_query($con,$msgNotificate);
$countMsg=mysqli_num_rows($msgResult);
if($countMsg>=1){
	$msgNotificate = "<span style='color:red'class='badge'> $countMsg </span>";
}else{
	$msgNotificate="";
}

$vcNotificate="SELECT * from query_msg where unit_id='$unit_id' AND senderVc_view='1' ";
$vcResult=mysqli_query($con,$vcNotificate);
$countMsgVc=mysqli_num_rows($vcResult);
if($countMsgVc>=1){
	$vcNotificate = "<span style='color:red'class='badge'> $countMsgVc </span>";
}else{
	$vcNotificate="";
}

$time=time();
$sqlDelayed="SELECT * FROM $unit_table where request_status=0 AND req_time < '$time' " ;
$msgDelayed=mysqli_query($con,$sqlDelayed);
$countDelayed=mysqli_num_rows($msgDelayed);
if($countDelayed>=1){
	$msgDelayed = "<span style='color:red'class='badge'> $countDelayed </span>";
}else{
	$msgDelayed="";
}


$totalNotification = $countMsg + $countDelayed + $countMsgVc;
if($totalNotification>=1)
$totalNotification = "<span style='color:red'class='badge'> $totalNotification </span>";
else 
$totalNotification="";

?>

<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../css/modal.css">
<script type="text/javascript" src="../../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../../js/ajaxCode.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../js/timed.js"></script> 

<script>	

$(document).ready(function(){

	$("#view_delayed").click(function(){
		//alert("confirm");
		$.get("view_delayed.php",function(data,statusTxt,xhr){
			//alert(xhr.readyState);

			if(xhr.readyState==4){
			jNode = $(data);
			jNode.hide();
			$('#service').html(jNode);
			jNode.fadeIn(2000);
}else{

	$('#service').html("<center><img  src='../../fonts/loading.gif'></center>");

}
		})
	})
})

		
function show(data){
	
	var xmlHTTP= new XMLHttpRequest();
	
	var sub_id = document.getElementById(data).innerHTML;
	var text = document.getElementById(data).rel;
	var url = "view.php?select="+text+"&sub_id="+sub_id;
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){
			
			document.getElementById('service').innerHTML="";
			var fade=xmlHTTP.responseText;
			jNode = $(fade);
			jNode.hide();
			$('#service').append(jNode);
			jNode.fadeIn(2000);
			
		}else{
			document.getElementById('service').innerHTML="<center><img  src='../../fonts/loading.gif'></center>";
			
		}
		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();

}


function pages(data,sub_id,view_link){
	
	var xmlHTTP= new XMLHttpRequest();
	
	//var text = document.getElementById(data).innerHTML;
	//var unit = document.getElementById(data).rel;
	if(view_link=='view_delayed'){

		var url ="view_delayed.php?page="+data;
	}else if(view_link=="messages"){

		var url ="messages.php?page="+data;
	}else if(view_link=="message_fromVc"){

		var url ="message_fromVc.php?page="+data;
	}else{
		var url = "view.php?sub_id="+sub_id+"&page="+data;
	}
	
	xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){
			
			document.getElementById('service').innerHTML="";
			var fade=xmlHTTP.responseText;
			jNode = $(fade);
			jNode.hide();
			$('#service').append(jNode);
			jNode.fadeIn(2000);
			
		}else{
			document.getElementById('service').innerHTML="<center><img  src='../../fonts/loading.gif'></center>";
			
		}
		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();

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
        <li class="active"><a href="../../">Home</a></li>
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


    <div class="modal-body">	
		<textarea align="center" id="textarea_query_msg" placeholder="Type your comments here..."  name="query_msg" required  class="form-control" rows="4"></textarea>	 
    </div><hr>

    <h4 style="padding: 2px 25px"><span class="glyphicon glyphicon-comment"></span><span id="resHead"> Response :</span></h4>
    <div id="responseBody" style="padding: 2px 25px">
    	


    </div><br><br>	
	 <input id="req_id_query" type="text" name="req_id_query" value="" hidden >
	<!-- <input id="mail" type="text" name="mail" value="" hidden > -->
	<!-- <input id="subject" type="text" name="subject" value="" hidden > -->

    <div id="modalfooterQuery" class="modal-footer">
      <!-- <input type="submit" id="submit" name="subreport"  class="form-control btn-success" value="Submit"> -->
      <button type="submit" name="subquery" class="form-control btn-success"> Submit Query <span class="glyphicon glyphicon-send"></span></button>
    </div>
	
	</form>
  </div>

</div>


<div class="container-fluid">


	<div class="container well col-md-3">
		<p align="center"><img src="../../custom/images/logo2.gif"></p><hr/>

	<div>
		<ul class="nav nav-pills">
			<li class="active" ><a  href="#menu" data-toggle="tab" style="font-size: 13px">Category</a></li>			
			<li><a href="#delayed" id="totalN" data-toggle="tab" style="font-size: 13px" >  Notifications <?php echo $totalNotification ?></a></li>
			<!-- <li><a href="#search" data-toggle="tab">  Search </a></li> -->
			<!-- <li><a href="#stat" data-toggle="tab">  Stats.</a></li> -->
		</ul><hr>

	<div class="tab-content">

		<div class="tab-pane fade in active" id="menu">
			<?php

				$i=0;
				foreach($data as $value){
					
					// SUBJECT IS PICKED HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!
							
				echo "
				<a href=\"#\" class=\"btn btn-primary form-control\" style=\"font-size: 13px\" onclick=\"show('url"; echo "$i')\" > $subject[$i] <span id='$value'>$notify[$i]</span> </a><hr/>
				<a href=\"#\" hidden id=\"url$i\"  rel='$unit'  >$data[$i]</a>";        //HERE!!!!!!!!!!!!!!!!
				$i++;
				}
			?>

		</div>
		<div class="tab-pane fade" id="delayed">

		<a href="#"  class="btn btn-danger form-control" id="view_delayed" >Delayed Req.  <span class="glyphicon glyphicon-eye-open"> </span> <?php echo $msgDelayed ?></a><hr>

		<a href="#"  class="btn btn-primary form-control" id="vcMsg" onclick="pages('1','','message_fromVc')" >VC Messages <span class="glyphicon glyphicon-comment"> </span> <?php echo $vcNotificate ?></a><hr>

		<a href="#"  class="btn btn-primary form-control" id="queryMsg" onclick="pages('1','','messages')" >Query Messages <span class="glyphicon glyphicon-comment"> </span> <?php echo $msgNotificate ?></a>
		
		</div>

		<div class="tab-pane fade " id="search">
			<form method="POST"  >
				<p style="color:green; font-weight:bold">Search Request:</p>
				<input class="form-control" type="email" name="search" id="searchmail" required placeholder="Enter a valid e-Mail">
				<p style="float:right" id="emailerror"></p><hr>
				<a class="form-control btn btn-primary " href='#' onclick="getsearch()"  >Search</a>
			</form>
		</div>
				
		<div class="tab-pane fade" id="stat">
				
		</div>
				
				
	</div>

	</div>
	</div>





<div class="col-md-1"></div>


<div class="container col-md-8" id="service">
	<img style="padding-left:45%" width='490' src="../../custom/images/logo2.gif">
	<h2 align="center" > WELCOME <?php echo $name; ?></h2>
	<p style="color:#B22222; text-align:center; font-size:25px"><b><?php echo"LAGOS STATE UNIVERSITY, HEAD OF ". strtoupper($unit) ." UNIT"?></b></p>
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

// When the user clicks the button, open the modal 

 

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


function query_msg(response,reqId,senderMsg, senderTime) {	
	
	//alert(resetNotification);
	if(senderTime!=""){
		document.getElementById("modalfooterQuery").innerHTML="";
	}
	document.getElementById("textarea_query_msg").value=senderMsg;	
	document.getElementById("req_id_query").value=reqId;	
	document.getElementById("responseBody").innerHTML=response;
	
    modalQuery.style.display = "block";
    if(senderTime!=""){

    	 var xmlHTTP= new XMLHttpRequest();
		 var url = "../processQuery.php?responsetime="+senderTime;
	     xmlHTTP.onreadystatechange = function(){
		if (xmlHTTP.readyState==4){		

		}		
	}
	
xmlHTTP.open("GET",url,true);
xmlHTTP.send();

    }
}


function replyVc(vcMsg,req_id,senderVc_msg,senderVc_time){

	if(senderVc_time!=""){
		document.getElementById("modalfooterQuery").innerHTML="";
	}else{
		document.getElementById("modalfooterQuery").innerHTML='<button type="submit" name="replyVc" class="form-control btn-success"> Reply Query <span class="glyphicon glyphicon-send"></span></button>';
	}
	document.getElementById("resHead").innerHTML=" Query from the Vice Chancellor :";
	document.getElementById("textarea_query_msg").value=senderVc_msg;	
	document.getElementById("req_id_query").value=req_id;	
	document.getElementById("responseBody").innerHTML=vcMsg;
	
    modalQuery.style.display = "block";

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


spanQuery.onclick=function() {
	var con=confirm("Are you sure you want to close the window?");
	if(con==true){	
	document.getElementById("modalfooterQuery").innerHTML='<button type="submit" name="subquery" class="form-control btn-success"> Submit Query <span class="glyphicon glyphicon-send"></span></button>';	
	document.getElementById("resHead").innerHTML=" Response :";
    modalQuery.style.display = "none";
}else
	modalQuery.style.display = "block";
	
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
			document.getElementById("totalN").innerHTML="Notifications "+ output.totalNotification;				
			document.getElementById("view_delayed").innerHTML= "Delayed Req. "+output.msgdelayed;		
			document.getElementById("queryMsg").innerHTML= "Query Messages "+output.msgnotificate;			
			document.getElementById("vcMsg").innerHTML= "VC Messages "+output.vcNotificate;			
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
		document.getElementById("reqfooter").innerHTML="<span style='padding-left:20px' > Attachment :<a class='btn btn-success' target='_blank' href=../../"+file+">"+ basename+" <span class='glyphicon glyphicon-paperclip'><span></a></span>";
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
	//$sqldate="SELECT * FROM $unitreal ";
	
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

	 $to=$mail;
	 $subject="Lasu e-Helpdesk: ".$subject." Request Treated";
	 $body="Your Request Number: ".$req_id." has been treated. Please follow this link <a href='".$domain."'>".$domain." </a> to check your report/response.";
	 $headers="From: LASU E-HELPDESK: <support@lasucomputerscience.com>";

	 sendMail($to,$subject,$body);
	 
	}else
		exit;
?>
	<script>
				window.location.assign("./");
			</script>

<?php
	
}


function sendMail($to,$subject,$body){
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

Hi, <br/>  $body <br/><br/>Thank you.<br/><br/>
e-Helpdesk Services,<br /> support@lasucomputerscience.com.
</div></BODY></HTML>";


    // Sending email

    if(mail($to, $subject, $message, $headers)){

        //echo '';

    } else{

        //echo '';

    }

}


//query_msg();

?>
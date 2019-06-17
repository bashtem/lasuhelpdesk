<?php session_start();
include("head_session.php");

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

$i=0;	
$notification="";
foreach($data as $value){		
// SUBJECT IS PICKED HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!
							
$notification.= "<a href='#' class='btn btn-primary form-control' style=\"font-size: 13px\" onclick=\"show('url$i')\"> $subject[$i] <span id='$value'>$notify[$i]</span> </a><hr/>
<a href='#' hidden id='url$i'  rel='$unit' >$data[$i]</a>";        //HERE!!!!!!!!!!!!!!!!

$i++;

}

$msgNotificate="SELECT * from query_msg where unit_id='$unit_id' AND sender_view='1' ";
$msgResult=mysqli_query($con,$msgNotificate);
$countMsg=mysqli_num_rows($msgResult);
if($countMsg>=1){
	$msgNotificate = "<span class='glyphicon glyphicon-comment'></span> <span style='color:red'class='badge'> $countMsg </span>";
}else{
	$msgNotificate="<span class='glyphicon glyphicon-comment'></span>";
}

$time=time();
$sqlDelayed="SELECT * FROM $unit_table where request_status=0 AND req_time < '$time' " ;//AND NOT hou_time < '$time' ";
$msgDelayed=mysqli_query($con,$sqlDelayed);
$countDelayed=mysqli_num_rows($msgDelayed);
if($countDelayed>=1){
	$msgDelayed = "<span class='glyphicon glyphicon-eye-open'></span> <span style='color:red'class='badge'> $countDelayed </span>";
}else{
	$msgDelayed="<span class='glyphicon glyphicon-eye-open'>";
}

$vcNotificate="SELECT * from query_msg where unit_id='$unit_id' AND senderVc_view='1' ";
$vcResult=mysqli_query($con,$vcNotificate);
$countMsgVc=mysqli_num_rows($vcResult);
if($countMsgVc>=1){
	$vcNotificate = "<span class='glyphicon glyphicon-comment'></span> <span style='color:red'class='badge'> $countMsgVc </span>";
}else{
	$vcNotificate="<span class='glyphicon glyphicon-comment'></span>";
}

$totalNotification = $countMsg + $countDelayed + $countMsgVc;
if($totalNotification>=1)
$totalNotification = "<span style='color:red'class='badge'> $totalNotification </span>";
else 
$totalNotification="";


echo json_encode(array(

	"notificate"=>$notification,
	 "msgnotificate"=>$msgNotificate,
	  "msgdelayed"=>$msgDelayed, 
	  "vcNotificate"=>$vcNotificate,
	  "totalNotification"=>$totalNotification

));


?>
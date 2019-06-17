<?php session_start();
include("vc_session.php");

/*$cnt=0;
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

}*/

$msgNotificate="SELECT * FROM query_msg WHERE vc_view='1' ";
$msgResult=mysqli_query($con,$msgNotificate);
$countMsg=mysqli_num_rows($msgResult);
if($countMsg>=1){
$msgNotificate = "<span class='glyphicon glyphicon-comment'></span> <span style='color:red'class='badge'> $countMsg </span>";
}else{
	$msgNotificate="<span class='glyphicon glyphicon-comment'></span>";
}

$time=time();
$sql_unit = "SELECT * FROM units_table";
$query_unit=mysqli_query($con, $sql_unit);
$sqlDelayed = "SELECT * FROM ";
$i = 1;
while($row = mysqli_fetch_array($query_unit)){

    if($i!=mysqli_num_rows($query_unit)){
     $sqlDelayed.=$row['table_name']." WHERE request_status= 0 AND hou_time < $time UNION ALL SELECT * FROM ";
    }else{
      $sqlDelayed.=$row['table_name']." WHERE request_status= 0 AND hou_time < $time ";
    }
$i++;
}
//$sqlDelayed="SELECT * FROM $unit_table where request_status=0 AND req_time < '$time' AND NOT hou_time < '$time' ";

$msgDelayed=mysqli_query($con,$sqlDelayed);
$countDelayed=mysqli_num_rows($msgDelayed);
if($countDelayed>=1){
	$msgDelayed = "<span class='glyphicon glyphicon-eye-open'></span> <span style='color:red'class='badge'> $countDelayed </span>";
}else{
	$msgDelayed="<span class='glyphicon glyphicon-eye-open'>";
}


$totalNotification = $countMsg + $countDelayed;
if($totalNotification>=1)
$totalNotification = "<span style='color:red'class='badge'> $totalNotification </span>";
else 
$totalNotification="";


echo json_encode(array(


	 "msgnotificate"=>$msgNotificate,
	  "msgdelayed"=>$msgDelayed, 
	  "totalNotification"=>$totalNotification

));


?>
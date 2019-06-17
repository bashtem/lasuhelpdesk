<?php session_start();
include("service_session.php");

//include("subject.php");
$cnt=0;
foreach($data as $badge){
$sqlnotificate="select * from $unit_table where subject_id='$badge' AND checked='0' ";
$result=mysqli_query($con,$sqlnotificate);
$ans[$cnt]=mysqli_num_rows($result);

if($ans[$cnt]>=1)
$notify[$cnt]="<span style='color:red'class='badge'> $ans[$cnt]</span>";
else
	$notify[$cnt]="";
$cnt++;
}
$i=0;


// UPDATE QUERY MESAGES

$msgNotificate="SELECT * from query_msg where unit_id='$unit_id' AND recipient_view='1' ";
$msgResult=mysqli_query($con,$msgNotificate);
$countMsg=mysqli_num_rows($msgResult);
if($countMsg>=1){
	$msgNotificate = "<span style='color:red'class='badge'> $countMsg </span>";
}else{
	$msgNotificate="";
}




$notification ="";
	foreach($data as $value){					

// SUBJECT IS PICKED HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!
							
$notification.= "<a href='#' class='btn btn-primary form-control' style=\"font-size: 13px\" onclick=\"show('url$i')\"> $subject[$i] <span id='$value'>$notify[$i]</span></a><hr/>
<a href='#' hidden id='url$i'  rel='$unit' >$data[$i]</a>";        //HERE!!!!!!!!!!!!!!!!

$i++;

}

echo json_encode(array(

	"notificate"=>"$notification", "msgnotificate"=>"$msgNotificate"

));

?>
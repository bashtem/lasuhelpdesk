<?php session_start();
include("head_session.php");
?>
<style>
th{
	text-align:center;	
	color:#FFFFFF;
	font-size: 12px;
}
td{
	text-align:center;	
	font-size: 13px;
}
</style>


<div>


<table class="table table-striped table-hover">

<tr style='background-color:#333333'>
<th style="color:red">Req No.</th>
<th>Title</th>
<th >Date Submitted</th>
<th>Request Status</th>
<th>Original Request</th>
<th>Operation</th>
<th >Report / Response</th>
<th style="color:red">Query <span></span></th>

</tr>

<?php

// SERVICE UNIT AND TITLE TO ADD !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

//$sub_id = $_GET['sub_id'];

$per_page=20;
$sql_count="SELECT * FROM query_msg WHERE unit_id='$unit_id' AND senderVc_view='1' OR senderVc_time!='' ";
$result = mysqli_query($con,$sql_count);
$pages= ceil(mysqli_num_rows($result)/$per_page);
$page_no= isset($_GET['page'])? (int)$_GET['page']:1;
$start = ($page_no-1)*$per_page;
//$sql="select * from query_msg  where subject_id='$sub_id' order by req_time desc LIMIT $start,$per_page ";
$sql=$sql_count."ORDER BY vc_time DESC LIMIT $start,$per_page ";

if(($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)>=1)){
	
	$tag=0;
	$an=1;
	
while($row=mysqli_fetch_array($query)){	

	$reqId = $row['req_id'];
	$senderVc_view = $row['senderVc_view'];
	$vcMsg = $row['vc_msg'];
	$vcTime = $row['vc_time'];
	$senderVc_time = $row['senderVc_time'];
	$senderVc_msg = $row['senderVc_msg'];
	if($senderVc_time==""){
		$senderVc_msg = "";
	}else{
		$senderVc_msg .='\r\r'.date("h:i:s A",$senderVc_time).'\r'.date("d/m/y",$senderVc_time); 
	}

	if($vcTime=="")
	$vcMsg = "";
	else
	$vcMsg .='<br><br>'.date("h:i:s A",$vcTime).'<br>'.date("d/m/y",$vcTime); 


$queryMsg = "SELECT * FROM $unit_table WHERE req_id='$reqId' ";
if( ($queryResult=mysqli_query($con,$queryMsg)) && (mysqli_num_rows($queryResult)>=1) ){

	$row = mysqli_fetch_array($queryResult);
$description[$tag]=$row['description'];
$request_status=$row['request_status'];
$report[$tag]=$row['report'];
$checked=$row['checked'];
$file=$row['file'];
$timestamp=$row['req_time'];
$sub_id=$row['subject_id'];
$basename=basename($row['file']);

$sql="SELECT * FROM unit_subjects WHERE sub_id='$sub_id'";
$rowsub = mysqli_fetch_array(mysqli_query($con,$sql));
$subject = $rowsub['subject'];

$req_id=$row['req_id'];
$email=$row['email'];
$notify = $row['req_time'];

}else{

$description[$tag]="";
$request_status="";
$report[$tag]="";
$checked="";
$file="";
$timestamp="";
$basename="";
$subject = '';
$req_id="";
$email="";
$notify = "";

}

if( ($request_status==0) ){	

	$treatcode = "treat('dis$an')";
	$rowstate="";
	$req_status="<i style='color:red'>Delayed Not Yet Treated</i>";
	$btn="btn disabled";
	$btnrep="btn enabled";

}else{
	$treatcode="";
	$rowstate="";
	
	$req_status="<i style='color:green'  >Treated <span style=\"float:right\" class=\"glyphicon glyphicon-ok\"></span></i>";
	$btn="btn enabled";
	$btnrep="btn disabled";
}

if(($senderVc_view==1) || ($request_status==0))
	$rowcolor="	#DBAAAA";
else
	$rowcolor="";

// if($treatcode ==""){
// 	$rowcolor="	#DBAAAA";
	
// }else if($checked!=1){
	
// 	$rowcolor="#A9A9A9";	
// }else{
// 	$rowcolor="";
// }



 /*if($treatcode ==""){
		$req_status="<i style='color:red'>Not Yet Treated</i>";
		$btn="btn enabled";
		$btnrep="btn enabled";

}else if ($request_status==0){
	$req_status="<i style='color:red'>Not Yet Treated</i>";
	$btn="btn disabled";
	$btnrep="btn enabled";
}else {

	$req_status="<i style='color:green'  >Treated <span style=\"float:right\" class=\"glyphicon glyphicon-ok\"></span></i>";
	$btn="btn enabled";
	$btnrep="btn disabled";
}*/

//$reqno=$row['req_no'];

echo "<tr id='color$tag' style='background-color:$rowcolor; border:none' title='$rowstate'>";	
echo "<td>".$row['req_id']."</td>";
echo "<td style=\"color:#0000CC\">".$subject."</td>";
echo "<td >".$row['sent_date']."</td>";															
echo "<td>".$req_status." </td>";
echo "<td ><a href='#' style='text-decoration:none; font-size:13px'  class='btn' onclick=\"servicereq('vie$tag','$notify','$sub_id','color$tag','$file','$basename')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#' id=\"treat\" style='text-decoration:none; font-size:13px'  class='$btnrep' onclick=\"$treatcode\">Treat <span style=\"float:right\" class=\"glyphicon glyphicon-pencil\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px' class='$btn' onclick=\"report('vie$tag')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px'  onclick=\"replyVc('$vcMsg','$req_id','$senderVc_msg','$senderVc_time')\" >Comments <span  class=\"glyphicon glyphicon-comment\"></span></a></td>";
echo "</tr>";

echo "<input type='text' hidden  alt=\"$report[$tag]\"  id=\"vie$tag\" value='$description[$tag]'>";
echo "<input type='text'  hidden alt=\"$req_id\" title=\"$subject\" id=\"dis$an\" value=\"$email\">";

	$tag++;
	$an+=1;

	/// END of While LOOP	
}


}?>

</table>


<center>
<ul  class="pagination pagination-sm">
        
        <?php
		if($page_no>1){
			
		echo	"
        <li><a href=\"#\"  onclick=\"pages($page_no-1,'','message_fromVc');\">Previous</a></li>";		
		}
		for($x=1;$x<=$pages;$x++){
		echo ($page_no==$x)? "<li style='color:green'><a   href='#' onclick=\"pages('$x','','message_fromVc');\" ><b style=\"color:red\">$x</b></a></li>" : "<li><a href='#' onclick=\"pages('$x','','message_fromVc');\" >$x</a></li>";
		}
		if($page_no<$pages){
		echo "<li><a href=\"#\"  onclick=\"pages($page_no+1,'','message_fromVc');\"  >Next</a></li>";
		}
		
		
		?>
       
      </ul>
</center>

</div>



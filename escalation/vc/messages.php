<?php session_start();
include("vc_session.php");

?>
<style>
th{
	text-align:center;	
	color:#FFFFFF;
	font-size: 12px;
}td{
	text-align:center;	
	font-size: 13px;
}
</style>


<div>


<table class="table table-striped table-hover ">

<tr style='background-color:#333333'>
<th style="color:red">Req No.</th>
<th>Unit</th>
<th>Head of Unit</th>
<th>Request Title</th>
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
$sql_count="SELECT * FROM query_msg WHERE vc_time!='NULL' ";
$result = mysqli_query($con,$sql_count);
$pages= ceil(mysqli_num_rows($result)/$per_page);
$page_no= isset($_GET['page'])? (int)$_GET['page']:1;
$start = ($page_no-1)*$per_page;
//$sql="select * from query_msg  where subject_id='$sub_id' order by req_time desc LIMIT $start,$per_page ";
$sql=$sql_count."ORDER BY vc_time DESC LIMIT $start,$per_page ";

if(($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)>=1)) {
	
	$tag=0;
	$an=1;
	
while($rowVc=mysqli_fetch_array($query)){	

	$unit_id = $rowVc['unit_id'];
	$reqId = $rowVc['req_id'];
	$vcView = $rowVc['vc_view'];
	$sender_msg = $rowVc['senderVc_msg'];
	$senderTime = $rowVc['senderVc_time'];
	$vcTime = $rowVc['vc_time'];
	$vcMsg = $rowVc['vc_msg'];
	$dateTime = date("h:i:s A",$vcTime);
	$dateYr = date("d/m/y",$vcTime);
	if($vcTime==""){
		$dateTime="";
		$dateYr="";
	}
	$vcMsg .='\r\r'.$dateTime.'\r'.$dateYr; 

	if($senderTime=="")
	$sender_msg = "";
	else
	$sender_msg .='<br><br>'.date("h:i:s A",$senderTime).'<br>'.date("d/m/y",$senderTime); 

	// echo $unit_id;
	$sqlsub= "SELECT * FROM units_table WHERE id='$unit_id' ";
	$rowsub = mysqli_fetch_array(mysqli_query($con,$sqlsub));
	$unit_table = $rowsub['table_name'];
	$unit_name = $rowsub['name'];


		// FETCHES THE NAME OF THE UNIT HEAD				
			$sqlname = "SELECT * FROM unit_head WHERE unit_id ='$unit_id' ";	
			$rowname = mysqli_fetch_array(mysqli_query($con,$sqlname));
			$head_name = $rowname['title']." ".$rowname['lname']." ".$rowname['fname'];	


	/*echo $unit_table." ";
	echo $reqId;*/

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

$sqlSub="SELECT * FROM unit_subjects WHERE sub_id='$sub_id'";
$rowsub = mysqli_fetch_array(mysqli_query($con,$sqlSub));
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
	$req_status="<i style='color:green'  > Delayed But Treated <span style=\"float:right\" class=\"glyphicon glyphicon-ok\"></span></i>";
	$btn="btn enabled";
	$btnrep="btn disabled";
}

if(($vcView==1) || ($request_status==0))
	$rowcolor="	#DBAAAA";
else
	$rowcolor="";


echo "<tr id='color$tag' style='background-color:$rowcolor; border:none' title='$rowstate'>";	
echo "<td>".$row['req_id']."</td>";
echo "<td>".$unit_name."</td>";
echo "<td>".$head_name."</td>";
echo "<td style=\"color:#0000CC\">".$subject."</td>";
echo "<td >".$row['sent_date']."</td>";															
echo "<td>".$req_status." </td>";
echo "<td ><a href='#' style='text-decoration:none; font-size:13px'  class='btn' onclick=\"servicereq('vie$tag','$notify','$sub_id','color$tag','$file','$basename')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#' id=\"treat\" style='text-decoration:none; font-size:13px'  class='$btnrep' onclick=\"$treatcode\">Treat <span style=\"float:right\" class=\"glyphicon glyphicon-pencil\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px' class='$btn' onclick=\"report('vie$tag')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px'  onclick=\"query_msg('$sender_msg','color$tag','$vcMsg','$vcTime','$unit_id')\" >Comments <span  class=\"glyphicon glyphicon-comment\"></span></a></td>";
echo "</tr>";

echo "<input type='text' hidden  alt=\"$report[$tag]\"  id=\"vie$tag\" value='$description[$tag]'>";
echo "<input type='text'  hidden alt=\"$req_id\" title=\"$subject\" id=\"dis$an\" value=\"$email\">";

	$tag++;
	$an+=1;

	/// END of While LOOP	

}


} ?>

</table>


<center>
<ul  class="pagination pagination-sm">
        
        <?php
		if($page_no>1){
			
		echo	"
        <li><a href=\"#\"  onclick=\"pages($page_no-1,'','messages');\">Previous</a></li>";		
		}
		for($x=1;$x<=$pages;$x++){
		echo ($page_no==$x)? "<li style='color:green'><a   href='#' onclick=\"pages('$x','','messages');\" ><b style=\"color:red\">$x</b></a></li>" : "<li><a href='#' onclick=\"pages('$x','','messages');\" >$x</a></li>";
		}
		if($page_no<$pages){
		echo "<li><a href=\"#\"  onclick=\"pages($page_no+1,'','messages');\"  >Next</a></li>";
		}
		
		
		?>
       
      </ul>
</center>

</div>



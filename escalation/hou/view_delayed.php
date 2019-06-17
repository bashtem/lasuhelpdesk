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


<table class="table table-striped  table-hover ">

<tr style='background-color:#333333'>
	<th style="color:red">Req No.</th>
	<th>Title</th>
	<th >Date Submitted</th>
	<th>Request Status</th>
	<th>Original Request</th>
	<th>Operation</th>
	<th >Report / Response</th>
	<th style="color:red">Query</th>
</tr>

<?php

// SERVICE UNIT AND TITLE TO ADD !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

															


$per_page=20;
$time = time();
$sql_count="SELECT * FROM $unit_table where request_status=0 AND req_time < '$time' " ;    //VIEW BLOCKED HERE
$result = mysqli_query($con,$sql_count);
$pages= ceil(mysqli_num_rows($result)/$per_page);
$page_no= isset($_GET['page'])? (int)$_GET['page']:1;
$start = ($page_no-1)*$per_page;
 
$sql=$sql_count." ORDER BY req_time desc LIMIT $start,$per_page ";

if(($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)>=1)){
	
	$tag=0;
	$an=1;
	
while($row=mysqli_fetch_array($query)){	

$description[$tag]=$row['description'];
$request_status=$row['request_status'];
$report[$tag]=$row['report'];
$checked=$row['hou_checked'];
$file=$row['file'];
$timestamp=$row['hou_time'];
$basename=basename($row['file']);
$sub_id=$row['subject_id'];

$sql="SELECT * FROM unit_subjects WHERE sub_id='$sub_id'";
$rowsub = mysqli_fetch_array(mysqli_query($con,$sql));
$subject = $rowsub['subject'];



$treatcode = "treat('dis$an')";
 if ($request_status==0){
	$req_status="<i style='color:red'>Delayed Not Yet Treated</i>";
	$btn="btn disabled";
	$btnrep="btn enabled";
	$rowcolor="#DBAAAA";
}else {
	$req_status="<i style='color:green'  >Treated <span style=\"float:right\" class=\"glyphicon glyphicon-ok\"></span></i>";
	$btn="btn enabled";
	$btnrep="btn disabled";
	$rowcolor="";
}

$req_id=$row['req_id'];
$email=$row['email'];
$notify = $row['req_time'];
//echo $email;


//// RESPONSE MESSAGE FOR A QUERY

$sql_query = "SELECT * FROM query_msg WHERE req_id = '$req_id'";
$query_comment = mysqli_query($con,$sql_query);
if(mysqli_num_rows($query_comment)>=1){

	$rowQuery = mysqli_fetch_array($query_comment);
	$response = $rowQuery['recipient_msg'];
	$responseTime = $rowQuery['recipient_time'];
	$senderTime = $rowQuery['sender_time'];
	$senderMsg = $rowQuery['sender_msg'];
	if($senderTime==""){
		$senderMsg = "";
	}else{
		$senderMsg .='\r\r'.date("h:i:s A",$senderTime).'\r'.date("d/m/y",$senderTime); 
	}

	if($responseTime=="")
	$response = "";
	else	
	$response .='<br><br>'.date("h:i:s A",$responseTime).'<br>'.date("d/m/y",$responseTime);

}else{

	$response ='';
	$senderMsg ='';
	$senderTime='';
}


echo "<tr id='color$tag' style='background:$rowcolor; border:none'>";	
echo "<td>".$req_id."</td>";
echo "<td style=\"color:#0000CC\">".$subject."</td>";
echo "<td >".$row['sent_date']."</td>";															
echo "<td>".$req_status." </td>";
echo "<td ><a href='#' style='text-decoration:none; font-size:13px'  class='btn' onclick=\"servicereq('vie$tag','$notify','$sub_id','color$tag','$file','$basename')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#' id=\"treat\" style='text-decoration:none; font-size:13px'  class='$btnrep' onclick=\"$treatcode\">Treat<span style=\"float:right\" class=\"glyphicon glyphicon-pencil\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px' class='$btn' onclick=\"report('vie$tag')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px'  onclick=\"query_msg('$response','$req_id','$senderMsg','$senderTime')\" >Message <span  class=\"glyphicon glyphicon-envelope\"></span></a></td>";
echo "</tr>";

echo "<input type='text' hidden  alt=\"$report[$tag]\"  id=\"vie$tag\" value='$description[$tag]'>";
echo "<input type='text' hidden  alt=\"$req_id\" title=\"$subject\" id=\"dis$an\" value=\"$email\">";

	$tag++;
	$an+=1;
}
//echo $descrip[1];
}

?>

</table>

<center>
<ul  class="pagination pagination-sm">
        
        <?php
		if($page_no>1){
			
		echo	"
        <li><a href=\"#\"  onclick=\"pages($page_no-1,'$sub_id','view_delayed');\">Previous</a></li>";		
		}
		for($x=1;$x<=$pages;$x++){
		echo ($page_no==$x)? "<li style='color:green'><a   href='#' onclick=\"pages('$x','$sub_id','view_delayed');\" ><b style=\"color:red\">$x</b></a></li>" : "<li><a href='#' onclick=\"pages('$x','$sub_id','view_delayed');\" >$x</a></li>";
		}
		if($page_no<$pages){
		echo "<li><a href=\"#\"  onclick=\"pages($page_no+1,'$sub_id','view_delayed');\"  >Next</a></li>";
		}
		
		
		?>
       
      </ul>
</center>
</div>



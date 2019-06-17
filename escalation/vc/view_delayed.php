<?php session_start();
include("vc_session.php");

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
<th>Unit</th>
<th>Head of Unit</th>
<th>Request Title</th>
<th >Date Submitted</th>
<th>Request Status</th>
<th>Original Request</th>
<th>Operation</th>
<th >Report / Response</th>
<th style="color:red">Query</th>

</tr>

<?php

$time = time();
$sql_unit = "SELECT * FROM units_table";
$query_unit=mysqli_query($con, $sql_unit);
$sql_count = "SELECT * FROM ";
$i = 1;
while($row = mysqli_fetch_array($query_unit)){

    if($i!=mysqli_num_rows($query_unit)){
     $sql_count.=$row['table_name']." WHERE request_status= 0 AND hou_time < $time UNION ALL SELECT * FROM ";
    }else{
      $sql_count.=$row['table_name']." WHERE request_status= 0 AND hou_time < $time ";
    }
$i++;
}  															



$per_page=20;
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



$sqlsub= "SELECT * FROM unit_subjects WHERE sub_id='$sub_id' ";
$rowsub = mysqli_fetch_array(mysqli_query($con,$sqlsub));
$subject = $rowsub['subject'];
$unit_id=$rowsub['units_table_id'];

//echo $subject;

$sqltable ="SELECT * FROM units_table WHERE id IN ( SELECT units_table_id FROM unit_subjects WHERE sub_id='$sub_id' )";
$rowtable = mysqli_fetch_array( mysqli_query($con,$sqltable));
$unit_table = $rowtable['table_name'];		
$unit_name = $rowtable['name'];		
	
	// FETCHES THE NAME OF THE UNIT HEAD				
$sqlname = "SELECT * FROM unit_head WHERE unit_id ='$unit_id' ";	
$rowname = mysqli_fetch_array(mysqli_query($con,$sqlname));
$head_name = $rowname['title']." ".$rowname['lname']." ".$rowname['fname'];			

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
	$senderMsg = $rowQuery['senderVc_msg'];
	$senderTime = $rowQuery['senderVc_time'];
	$vcTime = $rowQuery['vc_time'];	
	$vcMsg = $rowQuery['vc_msg'];
	$dateTime = date("h:i:s A",$vcTime);
	$dateYr = date("d/m/y",$vcTime);
	if($vcTime==""){
		$dateTime="";
		$dateYr="";
	}
	$vcMsg .='\r\r'.$dateTime.'\r'.$dateYr; 
	// $vcMsg .='\r\r'.date("h:i:s A",$vcTime).'\r'.date("d/m/y",$vcTime); 
	if($senderTime=="")
	$senderMsg = '';
	else	
	$senderMsg .='<br><br>'.date("h:i:s A",$senderTime).'<br>'.date("d/m/y",$senderTime);

}else{

	$senderMsg ='';
	$vcMsg ='';
	$vcTime='';
}




echo "<tr id='color$tag' style='background:$rowcolor; border:none'>";	
echo "<td>".$req_id."</td>";
echo "<td>".$unit_name."</td>";
echo "<td>".$head_name."</td>";
echo "<td style=\"color:#0000CC\">".$subject."</td>";
echo "<td >".$row['sent_date']."</td>";															
echo "<td>".$req_status." </td>";
echo "<td ><a href='#' style='text-decoration:none; font-size:13px'  class='btn' onclick=\"servicereq('vie$tag','$notify','$unit_table','color$tag','$file','$basename')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#' id=\"treat\" style='text-decoration:none'  class='$btnrep' onclick=\"treat('dis$an','$unit_table')\">Treat<span style=\"float:right\" class=\"glyphicon glyphicon-pencil\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px' class='$btn' onclick=\"report('vie$tag')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px'  onclick=\"query_msg('$senderMsg','$req_id','$vcMsg','$vcTime','$unit_id')\" >Message <span  class=\"glyphicon glyphicon-envelope\"></span></a></td>";
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
        <li><a href=\"#\"  onclick=\"pages($page_no-1,'$unit_table','view_delayed');\">Previous</a></li>";		
		}
		for($x=1;$x<=$pages;$x++){
		echo ($page_no==$x)? "<li style='color:green'><a   href='#' onclick=\"pages('$x','$unit_table','view_delayed');\" ><b style=\"color:red\">$x</b></a></li>" : "<li><a href='#' onclick=\"pages('$x','$unit_table','view_delayed');\" >$x</a></li>";
		}
		if($page_no<$pages){
		echo "<li><a href=\"#\"  onclick=\"pages($page_no+1,'$unit_table','view_delayed');\"  >Next</a></li>";
		}
		
		
		?>
       
      </ul>
</center>
</div>



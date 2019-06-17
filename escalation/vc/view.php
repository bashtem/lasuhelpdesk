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
<th>Title</th>
<th >Date Submitted</th>
<th>Request Status</th>
<th>Original Request</th>
<th>Operation</th>
<th >Report / Response</th>

</tr>

<?php

// SERVICE UNIT AND TITLE TO ADD !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

$unit_table = $_GET['unit'];

$per_page=20;
$sql_count="select * from $unit_table ";
$result = mysqli_query($con,$sql_count);
$pages= ceil(mysqli_num_rows($result)/$per_page);
$page_no= isset($_GET['page'])? (int)$_GET['page']:1;
$start = ($page_no-1)*$per_page;
 
$sql="select * from $unit_table order by req_time desc LIMIT $start,$per_page ";
if(($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)>=1)){
	
	$tag=0;
	$an=1;
	
while($row=mysqli_fetch_array($query)){	

$description[$tag]=$row['description'];
$request_status=$row['request_status'];
$report[$tag]=$row['report'];
$checked=$row['vc_checked'];
$file=$row['file'];
$sub_id=$row['subject_id'];
$basename=basename($row['file']);

$sql="SELECT * FROM unit_subjects WHERE sub_id='$sub_id'";
$rowsub = mysqli_fetch_array(mysqli_query($con,$sql));
$subject = $rowsub['subject'];

$sqltable ="SELECT * FROM units_table WHERE id IN (SELECT units_table_id FROM unit_subjects WHERE sub_id='$sub_id')";
$rowtable = mysqli_fetch_array( mysqli_query($con,$sqltable));
$unit_table = $rowtable['table_name'];


$treatcode = "treat('dis$an')";

if($treatcode ==""){	
	$rowcolor="	#DBAAAA";	

}else if($checked!=1){
	
	$rowcolor="#A9A9A9";	
}else{
	$rowcolor="";
}


if($treatcode ==""){
		$req_status="<i style='color:red'>Not Yet Treated</i>";
		$btn="btn disabled";
		$btnrep="btn disabled";

}else if ($request_status==0){
	$req_status="<i style='color:red'>Not Yet Treated</i>";
	$btn="btn disabled";
	$btnrep="btn enabled";
}else {
	$req_status="<i style='color:green'  >Treated <span style=\"float:right\" class=\"glyphicon glyphicon-ok\"></span></i>";
	$btn="btn enabled";
	$btnrep="btn disabled";
}

$req_id=$row['req_id'];
$email=$row['email'];
$notify = $row['req_time'];
//echo $email;


echo "<tr id='color$tag' style='background-color:$rowcolor; border:none' title=''>";	
echo "<td>".$req_id."</td>";
echo "<td style=\"color:#0000CC\">".$subject."</td>";
echo "<td >".$row['sent_date']."</td>";															
echo "<td>".$req_status." </td>";
echo "<td ><a href='#' style='text-decoration:none; font-size:13px'  class='btn' onclick=\"servicereq('vie$tag','$notify','$unit_table','color$tag','$file','$basename')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#' id=\"treat\" style='text-decoration:none'  class='$btnrep' onclick=\"treat('dis$an','$unit_table')\">Treat<span style=\"float:right\" class=\"glyphicon glyphicon-pencil\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px' class='$btn' onclick=\"report('vie$tag')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "</tr>";

echo "<input type='text' hidden  alt=\"$report[$tag]\"  id=\"vie$tag\" value='$description[$tag]'>";
echo "<input type='text' hidden  alt=\"$req_id\" title=\"$subject\" id=\"dis$an\" value=\"$email\">";

	$tag++;
	$an+=1;
}
//echo $descrip[1];
}?>

</table>

<center>
<ul  class="pagination pagination-sm">
        
        <?php
		if($page_no>1){
			
		echo	"
        <li><a href=\"#\"  onclick=\"pages($page_no-1,'$unit_table');\">Previous</a></li>";		
		}
		for($x=1;$x<=$pages;$x++){
		echo ($page_no==$x)? "<li style='color:green'><a   href='#' onclick=\"pages('$x','$unit_table');\" ><b style=\"color:red\">$x</b></a></li>" : "<li><a href='#' onclick=\"pages('$x','$unit_table');\" >$x</a></li>";
		}
		if($page_no<$pages){
		echo "<li><a href=\"#\"  onclick=\"pages($page_no+1,'$unit_table');\"  >Next</a></li>";
		}
		
		
		?>
       
      </ul>
</center>
</div>



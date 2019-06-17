<?php session_start();
include("session.php");
?>

<style>

th{
	text-align:center;	
	font-size: 12px;
}

td{
	text-align:center;	
	font-size: 13px;
}

</style>
<div>
<h4>My Requests</h4>
<a style="float:right; text-decoration:none" href="#" ><span class="glyphicon glyphicon-plus"></span> <input onclick="reqnew()" type="button" value="Add Request"></a>
<hr/>
<table class="table table-striped  table-hover ">

<tr style="background-color: #333333; color: white">
<th style="color:red">Req Id.</th>
<th>Title</th>
<th>Date Submitted</th>
<th>Request Status</th>
<th >Original Request</th>
<th colspan="2" >Report / Response</th>
</tr>


<?php
//echo date("d-M-Y")." ".date("h:m:s");
$sql_unit = "SELECT * FROM units_table";
$query_unit=mysqli_query($con, $sql_unit);
$sql_count = "SELECT * FROM ";
$i = 1;
while($row = mysqli_fetch_array($query_unit)){

    if($i!=mysqli_num_rows($query_unit)){
     $sql_count.=$row['table_name']." WHERE email='$email' UNION ALL SELECT * FROM ";
    }else{
      $sql_count.=$row['table_name']." WHERE email='$email'";
    }
$i++;
}

$per_page=20;


$result = mysqli_query($con,$sql_count);
$pages= ceil(mysqli_num_rows($result)/$per_page);
$page_no= isset($_GET['page'])? (int)$_GET['page']:1;
$start = ($page_no-1)*$per_page;
$sql= $sql_count."order by req_time desc LIMIT $start,$per_page";  // FETCT REQUESTSSSSSSSSSSSSS!!!!!!!!!!!

if(($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)>=1)){
	$i=0;
while($row=mysqli_fetch_array($query)){	
$descrip[$i]=$row['description'];
$request_status=$row['request_status'];
$subject_id=$row['subject_id'];
$time[$i]=$row['req_time'];
$req_id=$row['req_id'];
$basename=basename($row['file']);
$file=$row['file'];

$subsql ="SELECT * FROM unit_subjects WHERE sub_id='$subject_id'";
$rowsub = mysqli_fetch_array(mysqli_query($con,$subsql));
$subject = $rowsub['subject'];


if ($request_status==0){
	$req_status="<i style='color:red'>Not Yet Treated</i>";
	$btn="btn disabled";
	$report[$i]="";
	
}else {
	$req_status="<i style='color:green'>Treated <span style=\"float:right\" class=\"glyphicon glyphicon-ok\"></span></i>";
	$btn="btn enabled";
	$report[$i]=$row['report'];
}

echo "<tr>";	
echo "<td>".$req_id."</td>";
echo "<td style=\"color:#5E5E9B\">".$subject."</td>";
echo "<td>".$row['sent_date']."</td>";
echo "<td>".$req_status."</td>";
echo "<td><a href='#' style='text-decoration:none' class='btn' onclick=\"request('dis$i','$file','$basename')\">View <span class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#' style='text-decoration:none' class='$btn' onclick=\"report('dis$i')\">View <span class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
// echo "<td><a href='pdf.php?subject=$subject&time=$time[$i]&check=0&sub_id=$subject_id' target='new' style='text-decoration:none' class='$btn' onclick=\"\" >Download <span class=\"glyphicon glyphicon-floppy-disk\"></span></a></td>";
echo "</tr>";
echo "<input type='text' hidden  alt='$report[$i]' id='dis$i' value='$descrip[$i]'>";

$i++;
}

 echo"</table>"; 
 }else {
	echo "<span style=\"text-align:center; color:red; font-weight:bold \"><p>Request is Empty...</p></span>";
 }
?>
<center>
<ul  class="pagination pagination-sm">
        
        <?php
		if($page_no>1){
		echo "<li><a href=\"#\"  onclick=\"pages($page_no-1);\"  >Previous</a></li>";
		}
		
		for($x=1;$x<=$pages;$x++){
		echo ($page_no==$x)? "<li><a href='#' onclick=\"pages('$x');\" ><b style=\"color:red\">$x</b></a></li>" : "<li><a href='#' onclick=\"pages('$x');\" >$x</a></li>";
		}
		
		if($page_no<$pages){
		echo "<li><a href=\"#\"  onclick=\"pages($page_no+1);\"  >Next</a></li>";
		}
		
		?>
     
      </ul>
</center>
</div>


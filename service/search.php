<?php session_start();
include("service_session.php");
$email=$_GET['email'];
?>

<style>
th{
	text-align:center;	
	color:#FFFFFF;
}
td{
	text-align:center;	
}
</style>


<div>
<h4>Search Result for : <span style="color:red"><i><?php echo $email ?></i></span></h4>

<hr/>

<table class="table table-striped table-bordered table-hover ">

<tr style='background-color:#000000'>
<th style="color:red">Req No.</th>
<th>Title</th>
<th >Date Submitted</th>
<th>Request Status</th>
<th>Original Request</th>
<th>Operation</th>
<th >Report / Response</th>

</tr>

<?php



$per_page=20;
$sql_count="select email from $unitreal where email='$email'";
$result = mysqli_query($con,$sql_count);
$pages= ceil(mysqli_num_rows($result)/$per_page);
$page_no= isset($_GET['page'])? (int)$_GET['page']:1;
$start = ($page_no-1)*$per_page;
 
$sql="select * from $unitreal  where email='$email' order by req_time desc LIMIT $start,$per_page ";

if(($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)>=1)){
	
	$tag=0;
	$an=1;
while($row=mysqli_fetch_array($query)){	

$description[$tag]=$row['description'];
$request_status=$row['request_status'];
$report[$tag]=$row['report'];
$subject=$row['subject'];
$checked=$row['checked'];

if($checked!=1){
	
	$rowcolor="#A9A9A9";
}else{
	$rowcolor="";
	
}

if ($request_status==0){
	$req_status="<i style='color:red'>Not Yet Treated</i>";
	$btn="btn disabled";
	$btnrep="btn enabled";
}
else {
	$req_status="<i style='color:green'  >Treated <span style=\"float:right\" class=\"glyphicon glyphicon-ok\"></span></i>";
	$btn="btn enabled";
	$btnrep="btn disabled";
}
$reqno=$row['req_no'];
$email=$row['email'];
$notify = $row['req_time'];
//echo $email;


echo "<tr id='color$tag' style='background:$rowcolor; border:none'>";	
echo "<td>"."LASU/".$row['date']."/".$row['req_no']."</td>";
echo "<td style=\"color:#0000CC\">".$row['subject']."</td>";
echo "<td >".$row['sent_date']."</td>";															
echo "<td>".$req_status." </td>";
echo "<td><a href='#' style='text-decoration:none; font-size:13px'  class='btn' onclick=\"servicereq('vie$tag','$notify','$subject','color$tag')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "<td><a href='#' id=\"treat\" style='text-decoration:none'  class='$btnrep' onclick=\"treat('dis"; echo "$an');\">Treat <span style=\"float:right\" class=\"glyphicon glyphicon-pencil\"></span></a></td>";
echo "<td><a href='#'  style='text-decoration:none; font-size: 13px' class='$btn' onclick=\"report('vie$tag')\" >View <span  class=\"glyphicon glyphicon-eye-open\"></span></a></td>";
echo "</tr>";

echo "<input type='text' hidden  alt=\"$report[$tag]\"  id=\"vie$tag\" value='$description[$tag]'>";
echo "<input type='text' hidden  alt=\"$reqno\"  id=\"dis$an\" value=\"$email\">";

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
        <li><a href=\"#\"  onclick=\"pagesearch($page_no-1,'$email');\">Previous</a></li>";		
		}
		for($x=1;$x<=$pages;$x++){
		echo ($page_no==$x)? "<li><a href='#' onclick=\"pagesearch('$x','$email');\" ><b style=\"color:red\">$x</b></a></li>" : "<li><a href='#' onclick=\"pagesearch('$x','$email');\" >$x</a></li>";
		}
		if($page_no<$pages){
		echo "<li><a href=\"#\"  onclick=\"pagesearch($page_no+1,'$email');\"  >Next</a></li>";
		}
		
		
		?>
       
      </ul>
</center>
</div>

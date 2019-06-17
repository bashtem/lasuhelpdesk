<?php session_start();
include("head_session.php");

$subject_id=$_GET['subject_id'];
$notify=$_GET['notify'];

$sqll="select hou_checked from $unit_table where req_time='$notify'";
$querry= mysqli_query($con,$sqll);
$row=mysqli_fetch_array($querry);

if( $row['hou_checked']!=1){

	$sql1="UPDATE $unit_table SET hou_checked='1' where req_time='$notify'";
	if($query1=mysqli_query($con,$sql1)&& mysqli_affected_rows($con)>=1){
		
	$sqlnotificate="select * from $unit_table where subject_id='$subject_id' AND hou_checked='0' ";
	$result=mysqli_query($con,$sqlnotificate);
	$ans=mysqli_num_rows($result);

	if($ans==0){
		echo "";
	}else{

	echo "<span style='color:red'class='badge'> $ans</span>";
	}
	
	}
}



?>
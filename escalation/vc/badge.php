<?php session_start();
include("vc_session.php");

//$subject_id=$_GET['subject_id'];
$notify=$_GET['notify'];
$unit_table=$_GET['unit_table'];

$sqll="select vc_checked from $unit_table where req_time='$notify'";
$querry= mysqli_query($con,$sqll);
$row=mysqli_fetch_array($querry);

if( $row['vc_checked']!=1){

	$sql1="UPDATE $unit_table SET vc_checked='1' where req_time='$notify'";
	if($query1=mysqli_query($con,$sql1)&& mysqli_affected_rows($con)>=1){
		
	echo "";

	}
}



?>
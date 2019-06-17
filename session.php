<?php 

include("connect.php");
include("timed.php");

if( !isset($_SESSION['email']) || $out ){
?>
<script>
    window.location.assign("login.php");
</script>
<? exit();
}else{
	$email = $_SESSION['email'];
	$sql = "select * from user where email='$email'";
	if(($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query) >= 1)){
		while($row = mysqli_fetch_array($query)){
			$sname = $row['sname'];
			$onames = $row['onames'];
			$email = $row['email'];
			$phone = $row['phone'];
			$title = $row['title'];
			$name = strtoupper($sname." ".$onames);
		}
	}
}
?>
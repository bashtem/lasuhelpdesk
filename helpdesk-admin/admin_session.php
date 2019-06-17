<?php 

include_once("../connect.php");
include("../timed.php");

if(!isset($_SESSION['user']) || $out){
?>
<script>
    window.location.assign("index.php");
</script>
<?php
exit();
}

// else{
// 	$email = $_SESSION['user'];
// 	$sql = "select * from user where email='$email'";
// 	if(($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query) >= 1)){
// 		while($row = mysqli_fetch_array($query)){
// 			$sname = $row['sname'];
// 			$onames = $row['onames'];
// 			$email = $row['email'];
// 			$phone = $row['phone'];
// 			$title = $row['title'];
// 			$name = strtoupper($sname." ".$onames);
// 		}
?>
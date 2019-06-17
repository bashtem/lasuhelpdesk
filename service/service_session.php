<?php 

include_once("../connect.php");
include("../timed.php");

if( (!isset($_SESSION['emailse'])) || $out ){	
	session_destroy();
	session_unset();
	// header("Location:./");
	// header("Refresh:0, url=./");
	?>
	<script type="text/javascript">
		window.location.assign("./");
	</script>
	<?
	?>
	<!-- <script type="text/javascript">
		window.location.assign('./');
	</script> -->
	<?php
	
}else{
	
	
	$email = $_SESSION['emailse'];
	$sql = "select * from service where email='$email'";
	if(($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query) >= 1)){
		while($row = mysqli_fetch_array($query)){
			$lname = $row['lname'];
			$fname = $row['fname'];
			$email = $row['email'];
			$phone = $row['phoneno'];
			$title = $row['title'];
			$name = strtoupper($title." ".$lname);
			$unit_id = $row['unit_id']; //////// NOTE ................
		}

		$i = 0;
		$sqlunit = "SELECT * FROM units_table WHERE id='$unit_id'";
		$rowunit = mysqli_fetch_array(mysqli_query($con,$sqlunit));
		$sqlsub = "SELECT * FROM unit_subjects WHERE units_table_id='$unit_id'";
		$querysub = mysqli_query($con,$sqlsub);
		if(mysqli_num_rows($querysub)>=1){
		while($rowsub = mysqli_fetch_array($querysub)){
				$data[$i]=$rowsub['sub_id'];
				$subject[$i]=$rowsub['subject'];
				$i++;
		}
	}else{
		$data = array();
		$data[] = "";
	}
		$unit = $rowunit['name'];
		$unit_table = $rowunit['table_name'];

	}
	
	




}




?>
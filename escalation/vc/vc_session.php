<?php

include_once("../../connect.php");
include("../../timed.php");

if( (!isset($_SESSION['vc'])) || $out ){	
?>
<script>
    window.location.assign("../");
</script>
<?php
exit();

}else{

	$cnt = 0;
	$username = $_SESSION['vc'];
	$sql = "SELECT * FROM units_table";
	if(($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query) >= 1)){
		while($row = mysqli_fetch_array($query)){
			$unit_name[$cnt] = $row['name'];
			$table_name[$cnt] = $row['table_name'];

			$cnt++;
		}
	}

}
?>
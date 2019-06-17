<?php session_start();
include("session.php");
// THIS MODULE MATCHES THE SUBJECT WITH THE SERVICE UNIT!!!!!!!!!!!!!!!!!!!!!!!!!!!!


$sub_id= $_GET['sub_id'];

//$sub_id = 15;

$sql ="SELECT * FROM units_table WHERE id IN (SELECT units_table_id FROM unit_subjects WHERE sub_id='$sub_id')";
if($query = mysqli_query($con,$sql)){
			$row = mysqli_fetch_array($query);
			echo $row['name'];		
					
	}
				
				
			

?>
<?php session_start();
include("admin_session.php");

 //echo time();
 // $sent_time = time()+60;
 // echo $sent_time;

$list_type = $_GET['list'];
$type = explode("$", $list_type);
?>





<div>
			<h4 class="text-center"><?php echo $type['1']; ?></h4><hr>
	
	<div class="table-responsive">
		<table class='table table-striped table-bordered'>
			<thead>
				<tr class="text-center">
					<td>SN</td>
					<td>NAME</td>
					<td>EMAIL</td>
					<td>UNITS</td>
					<td>PF NUMBER</td>
					<td>JOB</td>
				</tr>
			</thead>
			<tbody>
				



<?php
$sql = "SELECT * from ".$type['0'] ;
if (($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query)>0)) {$c=0;
	while ($row = mysqli_fetch_array($query)) {$c++;
		?>
<tr>

<?php
$unit_id=$row['unit_id'];
$sqlunit ="SELECT * FROM units_table WHERE id='$unit_id' "; // IN (SELECT units_table_id FROM unit_subjects WHERE units_table_id='$unit_id')";
		$rowunit =mysqli_fetch_array(mysqli_query($con,$sqlunit));
		$unit = $rowunit['name'];
				

?>
	<td><?php echo $c;?></td>
	<td><?php echo $row['fname'];?> <?php echo $row['lname'];?></td>
	<td><?php echo $row['email'];?></td>	
	<td><?php echo $unit;?></td>
	<td><?php echo $row['pfnumber'];?></td>
	<td><?php echo $row['job'];?></td>
</tr>
		<?php
	}
}
				?>





			</tbody>
		</table>
	</div>
</div>
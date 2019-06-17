<?php session_start();
include("admin_session.php");
?>


<div>
			<h4 class="text-center"><span style="color: #B96666; font-style: italic;">inactive</span> Accounts</h4><hr>
	
	<div class="table-responsive">
		<table class='table table-striped table-bordered'>
			<thead>
				<tr class="text-center">
					<td>SN</td>					
					<td>EMAIL</td>
					<td>UNITS</td>
					<td>ACC. TYPE</td>
					<td>TOKEN</td>
					<td>DATE / TIME</td>
					<td>ACTION</td>
				</tr>
			</thead>
			<tbody>
				



<?php
$sql = "SELECT * from inactive_unit_rep ORDER BY expire_time  DESC";
if (($query = mysqli_query($con, $sql)) && (mysqli_num_rows($query)>0)) {$c=0;


	while ($row = mysqli_fetch_array($query)) { $c++;
		$token =base64_decode($row['token']);
		$acc_type = $row['account_type'];

		if($acc_type==0){
				$account_type = "<span style='color:#198D19'>Unit Rep.</span>";
		}else{
				$account_type = "<span style='color:#A23333'>Head of Unit</span>";
		}

		if(time()> $token){

			$expire = "<span style='color:#A23333; font-style: italics; font-size: 13px'>Expired</span>";
		}else{
			$expire= "";
		} 

	$unit_id=$row['unit_id'];
	$sqlunit ="SELECT * FROM units_table WHERE id ='$unit_id' ";
	// $sqlunit ="SELECT * FROM units_table WHERE id IN (SELECT units_table_id FROM unit_subjects WHERE units_table_id='$unit_id')";
		$rowunit =mysqli_fetch_array(mysqli_query($con,$sqlunit));
		$unit = $rowunit['name'];

?>
<tr>
	<td><?php echo $c;?></td>
	<td><?php echo $row['email'];?> </td>
	<td><?php echo $unit;?></td>
	<td><?php echo $account_type;?></td>
	<td><?php echo $row['token']."    ".$expire;?></td>
	<td><?php echo $row['date'];?></td>
	<td><a title="Delete"  onclick="add_renew('<?php echo $row['email'];?>','trash')" id="trash" href="#"><span class="glyphicon glyphicon-trash"></span></a> | <a title="Renew" onclick="add_renew('<?php echo $row['email'];?>','renew')" href="#" id="renew"><span class="glyphicon glyphicon-refresh"></span></a></td>
</tr>
		<?php
	}
}
				?>


			</tbody>
		</table>
	</div>
</div>


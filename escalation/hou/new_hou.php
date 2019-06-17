<?php
include("../../connect.php");
$mail = $_GET['mail'];
if(!isset($mail)){
	//header("Location:index.php");
		?>
	<script>
		window.location.assign('../');
	</script>
<?
}else{
	$sql = "SELECT * FROM inactive_unit_rep WHERE email='$mail' ";
	$query = mysqli_query($con,$sql);

	if(!(mysqli_num_rows($query)==1)){
			?>
	<script>
		window.location.assign('../');
	</script>
<?
	}else{
		$row = mysqli_fetch_array($query);

		if($row['account_type']==0){

			?>
	<script>
		window.location.assign('../');
	</script>
<?
		}
	}
}


?>

<div>
	
<h4 style="text-align:center"><span style="color:#A23333">Head of Schedule Officer's</span> Profile </h4><hr>

  <form role="form" method="POST" name='reg_hou' action="hou/add_hou_operation.php"  onsubmit='return val()'  >

	<div class="form-group">
		<select class="form-control" required name="title">
		<option  value="">Select your Title </option>
		<option value='Mr'>Mr.</option>
		<option value="Mrs">Mrs.</option>
		<option value="Dr">Dr.</option>
		<option value="Engr">Engr.</option>
		<option value="Prof">Prof.</option>			
	</select>
	</div>
	

	<div class="form-group">
		<input required placeholder="Firstname" class="form-control" type="text" name="firstname">
	</div>

	<div class="form-group">
		<input required placeholder="Lastname" class="form-control" type="text" name="lastname">
	</div>	
	
	<div class="form-group">	
		<input required placeholder="Job Position" class="form-control" type="text"   name="job">
	</div>

	<div class="form-group">		
		<input required placeholder="PF Number" class="form-control" type="number"   name="pfnumber">
	</div>

	<div class="form-group">
		<input placeholder="Phone Number" required class="form-control" type="number"  name="phoneno">
	</div>

	<div class="form-group">	
		<input class="form-control"  required type="email" name="emailse" readonly value=<?php echo $row['email']; ?> >
	</div>

	<div class="form-group">
		<input id="spass" placeholder="************" required class="form-control"  type="password" name="spass">
	</div>

	<div class="form-group">
		 <p><span id="glypass" ></span></p>
		<input placeholder="Confirm Password" required id="scpass" class="form-control" type="password" name="scpass" onkeyup="passmatch()">
	</div>
	
	<div class="form-group text-center">
		<input  class="btn btn-primary"  type="submit"  id='sub_hou'  name="sub_hou"  value="Submit"/>
	</div>
	
	
</form>

</div>

<script type="text/javascript">
	$("#left_head_panel").append('<img style="width: 80px; height: 80px; " src="../custom/images/logo2.gif"><hr>');

</script>
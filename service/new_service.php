<?php
include("../connect.php");
$mail = $_GET['mail'];
if(!isset($mail)){
	header("Location:index.php");
}else{
	$sql = "SELECT * FROM inactive_unit_rep WHERE email='$mail' ";
	$query = mysqli_query($con,$sql);

	if(!(mysqli_num_rows($query)==1)){
	?>
			<script type="text/javascript">
				window.location.assign("./");
			</script>
	<?php
	}else{
		$row = mysqli_fetch_array($query);

		if($row['account_type']==1){

	?>
			<script type="text/javascript">
				window.location.assign("./");
			</script>

	<?php
		}
	}
}


?>
<input type="button" class="btn btn-primary" onclick="login();" value="Login">
	
<h4  class="text-center"><span style="color:#B96666">Schedule</span>  Officer's Profile </h4><hr>

  <form role="form" method="POST" action="add_service_operation.php"  onsubmit='return val()'  name='reg'>
     <center>

     <table style='width:90%' class="table table-striped  table-hover">
	<tr>
	<th style='width:30%'>Title:</th>
	<td><select class="form-control" required name="title">
	<option  value="">Select your Title </option>
	<option value='Mr'>Mr.</option>
	<option value="Mrs">Mrs.</option>
	<option value="Dr">Dr.</option>
	<option value="Engr">Engr.</option>
	<option value="Prof">Prof.</option>
	
	</select></td>
	</tr>
	<tr>
	<th>Firstname:</th>
	<td><input required class="form-control" type="text" name="firstname"></td>
	</tr>
	<tr>
	<th>Lastname:</th>
	<td><input required class="form-control" type="text" name="lastname"></td>
	</tr>
	<tr>
	<th>Job Position:</th>
	<td><input required  class="form-control" type="text"   name="job"></td>
	</tr>
	<tr>
	<th>PF Number:</th>
	<td><input required  class="form-control" type="number"   name="pfnumber"></td>
	</tr>
	<tr>
	<th>Phone Number:</th>
	<td><input required class="form-control" type="number"  placeholder='Numeric Character Only' name="phoneno"></td>
	</tr>
	<tr>
	<th>E-mail:</th>
	<td><input class="form-control" required type="email" name="emailse" readonly value=<?php echo $row['email']; ?> ></td>
	</tr>
	<tr>
	<th>Password:</th>
	<td><input id="spass" required class="form-control"  type="password" name="spass"></td>
	</tr>
	<tr>
	<th>Confirm Password: <span id="glypass" ></span></th>
	<td><input required id="scpass" class="form-control" type="password" name="scpass"  onkeyup="passmatch()"></td>
	</tr>
	<tr>
	<th></th>
	<td><input  class="btn btn-primary"  type="submit"  id='submit'  name="subserv"  value="Submit"/></td>
	</tr>
	</table>
	
	
	</center>
	
 
  </form>


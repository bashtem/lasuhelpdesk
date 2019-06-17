<?php
include("../connect.php");

	$title=$_POST['title'];
	$fname=strip_tags($_POST['firstname']);
	$lname=strip_tags($_POST['lastname']);	
	$pfno=strip_tags($_POST['pfnumber']);
	$pnum=strip_tags($_POST['phoneno']);
	$email=strip_tags(trim($_POST['emailse']));
	$job=strip_tags($_POST['job']);
	$pass=strip_tags(md5($_POST['spass']));
	
	$sql="SELECT * FROM service where email='$email' OR pfnumber='$pfno' ";	
	$sqlunit="SELECT * FROM inactive_unit_rep where email='$email' ";
	$query = mysqli_query($con,$sql);

	if (mysqli_num_rows($query)==1) {

			echo '
				<script>
					window.alert("Account Already Exists !");
					window.location.assign("./");
				</script>';

	}else{

		if( ($queryunit = mysqli_query($con,$sqlunit)) ){

			if(mysqli_num_rows($queryunit)==1){	
				$row_inactive_unit = mysqli_fetch_array($queryunit);

				if($row_inactive_unit['account_type']==0){
				$unit_id = $row_inactive_unit['unit_id']; 

			$sqlinsert ="INSERT INTO service SET title='$title',fname='$fname',lname='$lname',pfnumber='$pfno',phoneno='$pnum',password='$pass',job='$job', email='$email', unit_id='$unit_id'";
					
						if($queryinert = mysqli_query($con,$sqlinsert)){

								// remove account from Inactive UNIT TABlE
								$delsql = "DELETE FROM inactive_unit_rep WHERE email ='$email'";
								 mysqli_query($con,$delsql);
								 
									echo'
									<script>
											window.alert("Profile Successfully Completed, You can Login!");
											window.location.assign("./");
									</script>';
																

							}		
				}else{

						echo'
					<script>
					window.alert("Account Creation Failed !");
					window.location.assign("./");
					</script>';

				}				

			}else{
					echo'
					<script>
					window.alert("Account Creation Failed !");
					window.location.assign("./");
					</script>';

			}


	}else{
			echo'
					<script>
					window.alert("Database Connection Failed !");
					window.location.assign("./");
					</script>';

		}	
	
		
	
}

				
		



?>

<?php

if( isset($_GET['responsetime']) ){
	include("../connect.php");
	if(isset($_GET['vc'])){
			$vcTime = $_GET['responsetime'];
			$sql = "UPDATE query_msg SET  vc_view='0' WHERE vc_time='$vcTime' ";
			$query = mysqli_query($con,$sql);

	}else{
	$responseTime = $_GET['responsetime'];
	resetNotification($con,$responseTime);
}
}



function query_msg($con,$unit_id){


if( isset($_POST['subquery']) ){

	$sender_time = time();	
	$sender_msg = $_POST['query_msg'];
	$req_id = $_POST['req_id_query'];

	$sqlcheck="SELECT * FROM query_msg WHERE req_id='$req_id'";
	$querycheck = mysqli_query($con,$sqlcheck);
	if(mysqli_num_rows($querycheck)>=1){

			$sqlSend = "UPDATE  query_msg SET sender_msg='$sender_msg',sender_time='$sender_time',sender_view='0',recipient_view='1',unit_id='$unit_id' WHERE req_id='$req_id' ";
			if( mysqli_query($con,$sqlSend) ){

		?>
						<script>
								alert("Query Sent.");
								window.location.assign("./");
						</script>
		<?php
					}else{
						?>
						<script>
						 	alert("Query Not Sent.");
						 	window.location.assign("./");
						</script>
						<?php
					}




	}else{
			$sqlSend = "INSERT INTO query_msg(req_id,sender_msg,sender_time,recipient_view,unit_id) VALUES('$req_id','$sender_msg','$sender_time','1',$unit_id)";
			if( mysqli_query($con,$sqlSend) ){

		?>
				<script>
						alert("Query Sent.");
						window.location.assign("./");

				</script>
		<?php
					}else{
						?>
						<script>
						 	alert("Query Not Sent.");
						 	window.location.assign("./");
						</script>
						<?php
					}

		}

	
		
	}
}




function vc_query_msg($con){


if( isset($_POST['subquery']) ){

	$vc_time = time();	
	$unit_id = $_POST['unit_id'];
	$vc_msg = $_POST['query_msg'];
	$req_id = $_POST['req_id_query'];

	$sqlcheck="SELECT * FROM query_msg WHERE req_id='$req_id'";
	$querycheck = mysqli_query($con,$sqlcheck);
	if(mysqli_num_rows($querycheck)>=1){

			$sqlSend = "UPDATE  query_msg SET vc_msg='$vc_msg', vc_time='$vc_time', senderVc_view='1',unit_id='$unit_id' WHERE req_id='$req_id' ";
			if( mysqli_query($con,$sqlSend) ){

		?>
						<script>
								alert("Query Sent.");
								window.location.assign("./");
						</script>
		<?php
					}else{
						?>
						<script>
						 	alert("Query Not Sent.");
						 	window.location.assign("./");
						</script>
						<?php
					}




	}else{
	$sqlSend = "INSERT INTO query_msg(req_id,vc_msg,vc_time,senderVc_view,unit_id) VALUES('$req_id','$vc_msg','$vc_time', '1','$unit_id' )";
			if( mysqli_query($con,$sqlSend) ){

		?>
				<script>
						alert("Query Sent.");
						window.location.assign("./");

				</script>
		<?php
					}else{
						?>
						<script>
						 	alert("Query Not Sent.");
						 	window.location.assign("./");
						</script>
						<?php
					}

		}

	
		
	}
}


function replyVc($con){

	if( isset($_POST['replyVc']) ){

	$senderVc_time = time();	
	$senderVc_msg = $_POST['query_msg'];
	$req_id = $_POST['req_id_query'];

	$sqVclSend = "UPDATE  query_msg SET senderVc_msg='$senderVc_msg',senderVc_time='$senderVc_time',vc_view='1', senderVc_view='0'  WHERE req_id='$req_id' ";
			if( mysqli_query($con,$sqVclSend) ){

		?>
						<script>
								alert("Query Sent.");
								window.location.assign("./");
						</script>
		<?php
					}else{
						?>
						<script>
						 	alert("Query Not Sent.");
						 	window.location.assign("./");
						</script>
						<?php
					}	
	}
}



function resetNotification($con,$responseTime){
	$sql = "UPDATE query_msg SET  sender_view='0' WHERE recipient_time='$responseTime' ";
	$query = mysqli_query($con,$sql);
}

	
?>
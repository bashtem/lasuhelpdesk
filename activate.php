<?php
require_once("connect.php");

$password = base64_decode($_GET['in']);
$forgotCode = $_GET['token'];

if(isset($password) && isset($forgotCode)){
$sql2= "select * from user where forgot_code='$forgotCode'";

if(mysqli_num_rows(mysqli_query($con,$sql2)) ==1 ){
	$sql = "UPDATE user SET password = '$password', forgot_code ='' WHERE forgot_code ='$forgotCode' ";
	if(mysqli_query($con,$sql)) {
		?>
		<script type="text/javascript">
			alert("Account Activated !!!");
			window.location.assign('login.php');
		</script>
		<?

	}else{

		?>
		<script type="text/javascript">
			alert("Account Activation Failed !!!");
			//window.location.assign('login.php');
		</script>
		<?
	}
}else{

	?>
	<script type="text/javascript">
		alert("Link Expired !!!");
		window.location.assign('./')
	</script>
	<?

}	
	}else{

		?>
	<script type="text/javascript">
		//alert("Link Expired !!!");
		window.location.assign('./')
	</script>
	<?

	}
?>
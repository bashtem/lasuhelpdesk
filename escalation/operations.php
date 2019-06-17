<?php session_start();
include("../connect.php");


$acc_type = isset($_POST['acc_type'])?  $_POST['acc_type']:false;

switch($acc_type){

	case 'hou':

				$email=trim($_POST['email']);				
				$acc_type=$_POST['acc_type'];		
				$pass= trim(md5($_POST['password']));
				$sql = "SELECT * FROM unit_head where email='$email' AND password='$pass'";
				if( ($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)==1) ){

						$_SESSION['hou']=$email;
						$_SESSION['timestamp']=time();

						echo json_encode(array("response"=>true, "reason"=>" Welcome Head of Unit !", "acc_type"=>"hou"));
				}else{
						echo json_encode(array("response"=>false, "reason"=>"Authentication Failed !"));
				}

				


	break;	
	case 'vc':
				
				$username=trim($_POST['username']);
				$acc_type=$_POST['acc_type'];		
				$pass= trim(md5($_POST['password']));
				$sql = "SELECT * FROM admin where username='$username' AND password='$pass'";
				if( ($query=mysqli_query($con,$sql)) && (mysqli_num_rows($query)==1) ){

						$_SESSION['vc']=$username."_vc";
						$_SESSION['timestamp']=time();

						echo json_encode(array("response"=>true, "reason"=>"Welcome V.C", "acc_type"=>"vc"));
				}else{
						echo json_encode(array("response"=>false, "reason"=>"Authentication Failed !"));
				}

	break;


	default:
		echo json_encode(array("response"=>false, "reason"=>"No Operation !"));
	break;


}



?>
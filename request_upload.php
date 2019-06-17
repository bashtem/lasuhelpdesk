<?php session_start();
include("session.php");

		
if(($_FILES['doc']['name'])){

			$ename  = explode("@",$email);
			$edomain = explode(".",$ename[1]);
			$email_name = $ename[0]."_".$edomain[0];
			$target_dir = "files/".$email_name."/";
			if( is_dir($target_dir) === false )
				{
				    mkdir($target_dir);
				}
			$target_file = explode(" ",$target_dir ."time".date("h_i")."_". basename($_FILES["doc"]["name"]) );			
			$target_file = implode("_",$target_file);
			$type = pathinfo($target_file, PATHINFO_EXTENSION);
			$file = $_FILES["doc"]["tmp_name"];			
			$size = $_FILES["doc"]["size"];

	 if($type == 'jpeg' || $type=='jpg' || $type=='tiff' || $type=='pdf' || $type=='docx' || $type=='txt' || $type=='doc' || $type=='png' || $type=='gif' ){
					if($size > 1000000){

							$upload = "bad";
							$reason = "File Too Large !";
							echo "<script>alert('File Too Large Max 1MB !')</script>";
							

						}else{

							move_uploaded_file($file, $target_file);
							$upload = "good";
							$doc =$target_file;
						}

					}else{
						$upload = "bad";
						$reason = "File Format Unsupported !";
						echo "<script>alert('File Format Unsupported !')</script>";

					}

		}else{

			$upload = "good";
			
		}	



if($upload=="good"){
			
					 
		$req_id = "LASU/".substr(time(), 0);
		$description = strip_tags($_POST['description']); 
		$sub_id = strip_tags(strtoupper($_POST['subject']));
		$category = "REQUESTOR"; //strip_tags(strtoupper($_POST['category']));
		$sent_date=date("d-M-Y")." ".date("h:i:s");
		$forty_eight_hours = 60*60*24*2;
		


		$two = 2; //		$two = 2;
		$three = 3; //		$two = 2;
		$one_point_five = 1.5;//		$three = 3;
		$two_point_five = 2.5;//		$three = 3;
		$three_point_five = 3.5;//		$three = 3;

		///$stop_clock_friday_4pm = 24+24+16;  // 

		// Get Day of Request
		switch(date("D",time())){
			case 'Fri':	$schedule_officer_time=time()+($forty_eight_hours*$two_point_five);
						$hou_time = time()+($forty_eight_hours*$three_point_five);
			break;
			case 'Sat' : $schedule_officer_time=time()+($forty_eight_hours*$two);
						$hou_time = time()+($forty_eight_hours*$three);
			break;
			case 'Sun':
						$schedule_officer_time=time()+($forty_eight_hours*$one_point_five);
						$hou_time = time()+($forty_eight_hours*$two_point_five);
			break;
			default : $schedule_officer_time=time()+($forty_eight_hours);
						$hou_time = time()+($forty_eight_hours*$two);
			break;

		}



						/// This is used for testing the escalation
						$test_schedule_time =60*2;
						$test_hou_time = 60*10;

						// $schedule_officer_time=time()+$test_schedule_time;
						// $hou_time = time()+$test_hou_time;
		
		
		$sql ="SELECT * FROM units_table WHERE id IN (SELECT units_table_id FROM unit_subjects WHERE sub_id='$sub_id')";
		$query=mysqli_query($con,$sql);
		$row = mysqli_fetch_array($query);
		$table_name=$row['table_name']; 



		$sql = "INSERT INTO $table_name(category,description,email,sent_date,req_id,subject_id,req_time,hou_time,file) VALUES(\"$category\",\"$description\",\"$email\",\"$sent_date\",'$req_id','$sub_id','$schedule_officer_time','$hou_time','$doc')";
		if($query = mysqli_query($con, $sql)){

		 ?>
<script>
window.alert("Message Sent. Please Check your Mail for Notification!");
window.top.window.location.assign("panel.php?temp=reqnew");

</script>
<?php
		}

	}
		

?>

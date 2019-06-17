<?php session_start();
include("admin_session.php");



$action = isset($_REQUEST['action'])? $_REQUEST['action']: false;


switch($action){

	case 'trash' :
			$email = $_REQUEST['email'];
			$sql = "DELETE FROM inactive_unit_rep WHERE email='$email'";
			if($query=mysqli_query($con,$sql)){
					echo "Deleted Successfully !";

			}else{
					echo "Database Error !";
			}
			

	break;
	case 'renew' :
			$email = $_REQUEST['email'];
			$hours = 86400; // 24 hours in seconds
          $token = base64_encode(time()+$hours); 
          $encmail = base64_encode($email);  
          $date = date("d/m/y")." ".date("h:i");
          $time = time();    
           $sql = "UPDATE inactive_unit_rep SET token='$token', date='$date', expire_time='$time' WHERE email = '$email' "; 

           $sqlmail = "SELECT * FROM inactive_unit_rep WHERE email='$email'";
           $rowmail = mysqli_fetch_array(mysqli_query($con,$sqlmail));
           $acc_type =$rowmail['account_type'];
           if($acc_type==0){
                  $url = "service/?profile=$token&encmail=$encmail";
          }else{
                  $url = "escalation/?profile=$token&encmail=$encmail";
          }    

          // echo $url;
          // exit;
          
        
             if($update =mysqli_query($con,$sql)) {                      
     			// THIS SECTION SEND AN E-MAIL TO AN HELPDESK REPRESENTATIVE ONCE AN ACCOUNT HAS BEEN CREATED !!!!!!!!!!!!!!!!
                   $to=$email;
                   $subject="LASU e-HelpDesk Renewed Link for Account activation";
                   $body="Link Renewed, Please follow this link <a href=".$domain.$url.">".$domain.$url." </a> to set your Password and Update your profile. This link will expire in 24 hours Thanks. ";
                   $headers="From: LASU E-HELPDESK Activate : <support@lasucomputerscience.com>";

                   include("../sendmail.php");
                   sendMail($to,$subject,$body);
                   //mail($to,$subject,$body,$headers); 
					echo "Link Renewed";
					//echo "$url";
		}
	break;
	case 'create_unit':

			$utitle = strtoupper($_REQUEST['utitle']);
			$utable = $_REQUEST['utitle']."_unit";
			//$utable = $_REQUEST['utable']."_unit";
			$utableexplode = explode(" ", $utable);
			$utable = strtolower( implode("_", $utableexplode)); 
			$sql = "INSERT INTO units_table(name,table_name) VALUES('$utitle','$utable')";
			$sqlcreate = "CREATE  TABLE $utable ( 

 `req_id` varchar( 25  )  NOT  NULL ,

 `description` text NOT  NULL ,

 `email` varchar( 255  )  NOT  NULL ,

 `category` varchar( 255  )  NOT  NULL ,

 `request_status` int( 1  )  NOT  NULL DEFAULT  '0',

 `sent_date` varchar( 100  )  NOT  NULL ,

 `report` text,

 `subject_id` int(11) NOT  NULL ,

 `req_time` int( 255  )  NOT  NULL ,

 `hou_time` int( 255  )  NOT  NULL ,

 `treated_date` varchar( 255  )  DEFAULT NULL ,

 `checked` int( 1  )  NOT  NULL DEFAULT  '0',

 `hou_checked` int( 1  )  NOT  NULL DEFAULT  '0',

 `vc_checked` int( 1  )  NOT  NULL DEFAULT  '0',

 `file` text,

 `treated_by` varchar( 25  )  DEFAULT NULL  ) ENGINE  = InnoDB  DEFAULT CHARSET  = latin1; ";

			if(   ($querycreate = mysqli_query($con,$sqlcreate)) ){
					$query=mysqli_query($con,$sql);
					echo "Unit Created Successfully !";	

			}else{
					echo "Unit Creation Failed !";
			}

//echo $sqlcreate;
	break;

	case 'add_subject' :
			$id = $_REQUEST['id'];
			$subject = strtoupper($_REQUEST['subject']);
			$sql="INSERT INTO unit_subjects(units_table_id, subject) VALUES ('$id','$subject')";
			if($query=mysqli_query($con,$sql)){
					echo "Subject Added Successfully !";

			}else{
					echo "Database Error !";
			}
	break;

	case 'del_subject':
			$id = $_REQUEST['id'];
			$sql ="DELETE FROM `unit_subjects` WHERE sub_id='$id'";		
			if($query=mysqli_query($con,$sql)){
					echo "Subject deleted Successfully !";

			}else{
					echo "Database Error !";
			}
	break;

	default:
			echo "invalid Input";
	break;



}


?>

<?php session_start();
include("admin_session.php");

$exists="nop";
//echo base64_encode("tunrayo2006@yahoo.com");

if(isset($_POST['add_agent'])){

  $unit_id = $_POST['unit'];
  $email = $_POST['email'];
  $acc_type = $_POST['acc_type'];

if( (isset($unit_id)) && (isset($email)) && ($acc_type) ){

    if($acc_type=="unit_rep"){
        $acc_type = 0;
    }elseif ($acc_type=="hou") {

        $acc_type = 1;
    }

  $sql = "SELECT * FROM service WHERE email = '$email' ";
  $sqlhead = "SELECT * FROM unit_head WHERE email = '$email' ";
  $sqlinactive = "SELECT * FROM inactive_unit_rep WHERE email = '$email' ";
  if( ($query = mysqli_query($con, $sql )) && ($queryinactive = mysqli_query($con, $sqlinactive )) && ($queryhead=mysqli_query($con, $sqlhead)) ){
  
  if( (mysqli_num_rows($query)==1) || (mysqli_num_rows($queryinactive)==1) || (mysqli_num_rows($queryhead)==1) ) {
          $exists = "yep"; 

          echo "<script>
          alert('Profile already exist!');                         
          </script>";
         

  }else{
          $hours = 86400; // 24 hours in seconds
          $token = base64_encode(time()+$hours); 
          $encmail = base64_encode($email);  
          $date = date("d/m/y")." ".date("h:i");
          $time = time();    
          $sql = "INSERT INTO inactive_unit_rep(unit_id,email,account_type,token,date,expire_time) values('$unit_id','$email','$acc_type','$token','$date','$time')";     
          if($acc_type==0){
                  $url = "service/?profile=$token&encmail=$encmail";
          }else{
                  $url = "escalation/?profile=$token&encmail=$encmail";
          }
          
        
                if($insert =mysqli_query($con,$sql)) {
                      echo "<script> alert('Profile Created and Link Sent !') </script>"; 

     // THIS SECTION SEND AN E-MAIL TO AN HELPDESK REPRESENTATIVE ONCE AN ACCOUNT HAS BEEN CREATED !!!!!!!!!!!!!!!!

                   $to=$email;
                   $subject="Lasu e-Helpdesk Account activation link";
                   $body="Please follow this link <a href='".$domain.$url."'>".$domain.$url." </a> to set your Password and Update your profile. This link will expire in 24 hours. ";

                   //$headers="From: LASU E-HELPDESK:  <support@lasucomputerscience.com>";

                   echo sendMail($to,$subject,$body);                       

                  }else{
                      echo "<script>alert('Profile Creation Failed!')</script>"; 

                  }

              }
                   }else{
                    echo "<script>alert('DB connection Failed!')</script>"; 
              }

}else{

      echo "<script>alert('Profile Creation Failed!')</script>";
}
    }




function sendMail($to,$subject,$body){
    $headers  = 'MIME-Version: 1.0' . "\r\n";

    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

     

    // Create email headers
$emailweb = "support@lasucomputerscience.com";
$emailweb2 = "support@lasucomputerscience.com";

    $headers .= 'From: LASU e-Helpdesk <'.$emailweb.">"."\r\n".

        'Reply-To: '.$emailweb2."\r\n" .

        'X-Mailer: PHP/' . phpversion();

     $time = date('d-M-Y h:i:s a', time());
    // Compose a simple HTML email message
  $message = "<HTML><BODY>
<div style='font-family:arial; border:2px solid #c0c0c0; padding:15px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px;'>
<div style='font-size:20px; color:darkblue; font-weight:bold;'>e-Helpdesk REGISTRATION</div>
    <br /> 

Hi, <br/><br/>
This is to notify you that you have been pre-registered for LASU e-HelpDesk <br/> <br/> <center>$body</center><br/><br/>Thank you.<br/><br/>
e-Helpdesk Services,<br /> support@lasucomputerscience.com.
</div></BODY></HTML>";


    // Sending email

    if(mail($to, $subject, $message, $headers)){

        //echo '';

    } else{

        //echo '';

    }

}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/timed.js"></script>
<style type="text/css">
  .notify{
    display:none;
    font-size: 12px;
    font-style: italic;
    background-color: white;
    border:1px solid white;
    border-radius: 5px;
  }
</style>

</head>
      <body>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span> 
            </button>
            <a class="navbar-brand" href="#">e-HelpDesk</a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li class="active"><a href="../">Home</a></li>
               
            </ul>
            <ul class="nav navbar-nav navbar-right">
             <li><a href="logout.php" class="dropdown-toggle" style="color: white"> Logout  <span style="color: red" class="glyphicon glyphicon-off"></span> </a></li>
              
            </ul>
          </div>
        </div>
      </nav><br><br><br><br>
      <div class="container-fluid">

      <div class="container col-md-2 text-center">

          <img style="width: 50px; height: 50px"  src="../custom/images/logo2.gif"><hr>
          <p><h4>Admin</h4></p><br>
          <a href="#" onclick="view('add_agent_head')"  class="btn btn-sm btn-link ">Add Head Of Unit. <span class="glyphicon glyphicon-user"></span></a><hr/>
          <a href="#" onclick="view('add_agent')"  class="btn btn-sm btn-link ">Add Schedule Officer. <span class="glyphicon glyphicon-user"></span></a><hr/>          
          <a href="#" onclick="view('list_agent','unit_head$Head Of Unit Officers')" class="btn btn-sm btn-link ">View Head of Units <span class="glyphicon glyphicon-eye-open"></span></a><hr/>
           <a href="#" onclick="view('list_agent','service$Schedule Officers')" class="btn btn-sm btn-link ">View Schedule Officers <span class="glyphicon glyphicon-eye-open"></span></a><hr/>
          <a href="#" onclick="view('inactive_agent')" class="btn btn-sm btn-link ">inactive Accounts  <span class="glyphicon glyphicon-eye-open"></span></a><hr/>
          <a href="#" onclick="view('create_unit')" class="btn btn-sm btn-link ">Create / View Unit  <span class="glyphicon glyphicon-pencil"></span></a><hr/>
          
          
          <!-- <a href="#" class="btn btn-primary form-control">Departments</a><hr/>
          <a href="#" class="btn btn-primary form-control"> Technical</a> -->

      </div>
      <div class="col-md-1"></div>
                                    
      <div class="container col-md-9 text-center" id="admin_content">
                                    <h2 >WELCOME ADMIN !!!</h2><hr>

      </div>

      </div><br><br><br><br>

      <script type="text/javascript" src="../js/bootstrap.min.js"></script>
      <nav class="navbar navbar-inverse navbar-fixed-bottom" style="height:20px">
        <div class="container-fluid">
          <div style="text-align:center;color:white" >
      	Designed by e-Helpdesk Team &copy; <?php echo date('Y')?>
         </div>
      </nav>
      </body>
      <script type="text/javascript">
  
  function con(ask){    
    var check = confirm(ask);
    if(check==true){
      return true;
    }else{
      return false;
    }
  }


  function view(url,type='' ){  

        var xmlrobot = new XMLHttpRequest();
        var url=url+".php?list="+type;               
              if(xmlrobot==null){
                  alert("Your browser does not support Ajax");
                  return false;
                }              
                  xmlrobot.onreadystatechange = function(){
                  if(xmlrobot.readyState==4){
                    document.getElementById("admin_content").innerHTML="";
                    var fade = xmlrobot.responseText;
                    jNode = $(fade);
                    jNode.hide();
                    $('#admin_content').append(jNode);                          
                    jNode.fadeIn(2000);

                  }else{

        document.getElementById("admin_content").innerHTML='<center><img  src="../fonts/loading.gif"></center>';

    }

}
xmlrobot.open("GET",url,true);
xmlrobot.send(null);
  
}



function add_renew(email,action){
                
               var confirm = con("Do you wish to continue ?");
            if(confirm){
               var xmlrobot = new XMLHttpRequest();
               var url="operations.php?email="+email+"&action="+action;
               
               if(xmlrobot==null){
                  alert("Your browser does not support Ajax");
                  return false;
                }              
               xmlrobot.onreadystatechange = function(){
                  if(xmlrobot.readyState==4){
                    alert(xmlrobot.responseText);
                    view('inactive_agent');
                  }else{
                    document.getElementById("admin_content").innerHTML='<center><img  src="../fonts/loading.gif"></center>';
                  }
}

xmlrobot.open("GET",url,true);
xmlrobot.send(null);
  }
}

function create_unit(email){
  var unit_title = document.getElementById("utitle").value;
  //var unit_table = document.getElementById("utable").value; 
  if(unit_title == "" ){
      alert("Fill appropriate Fields")

  }else{
            var xmlrobot = new XMLHttpRequest();
               var url="operations.php?utitle="+unit_title+"&action=create_unit";
               
               if(xmlrobot==null){
                  alert("Your browser does not support Ajax");
                  return false;
                }              
               xmlrobot.onreadystatechange = function(){
                  if(xmlrobot.readyState==4){
                    alert(xmlrobot.responseText);
                    view('create_unit');
                  }else{

                    document.getElementById("admin_content").innerHTML='<center><img  src="../fonts/loading.gif"></center>';
                  }
                }

xmlrobot.open("GET",url,true);
xmlrobot.send(null);

  }     
      
}


function add_view_sub(action,id){
  //var input =input;
  //alert(id);
  switch(action){

    case 'add':
          var element = "add_span"+id;
          var style= document.getElementById(element).style.display;
          if(style=="block"){
              document.getElementById(element).style.display="none";
          }else{
              document.getElementById(element).style.display="block";
          }
         

    break;
    case 'view/hide':
          var addspan = "add_span"+id;
          var element = "view"+id;
          document.getElementById(addspan).style.display="none";
          var style = document.getElementById(element).style.display;
          if(style=='none'){
              document.getElementById(element).style.display="block";
          }else{
              document.getElementById(element).style.display="none";
          }

    break;
    case 'submit': 
          
          var subject_id ="add_sub"+id;
          subject = document.getElementById(subject_id).value;
          var xmlrobot = new XMLHttpRequest();
          var url="operations.php?id="+id+"&subject="+subject+"&action=add_subject";               
          if(xmlrobot==null){
                alert("Your browser does not support Ajax");
                return false;
            }              
          xmlrobot.onreadystatechange = function(){
          if(xmlrobot.readyState==4){
                alert(xmlrobot.responseText);
                view('create_unit');
                         
           }else{
                // document.getElementById("").innerHTML='<center><img style="height:40px; width:40px" src="../fonts/loading.gif"></center>';
                  }
                }

          xmlrobot.open("GET",url,true);
          xmlrobot.send();

    break;
    case 'del_sub':
          
          
          var confirm = con("Do you want to Delete ?");
          if(confirm){
          var xmlrobot = new XMLHttpRequest();
          var url="operations.php?id="+id+"&action=del_subject";               
          if(xmlrobot==null){
                alert("Your browser does not support Ajax");
                return false;
            }              
          xmlrobot.onreadystatechange = function(){
          if(xmlrobot.readyState==4){
                alert(xmlrobot.responseText);
                 view('create_unit');
                
           }else{
                // document.getElementById("").innerHTML='<center><img style="height:40px; width:40px" src="../fonts/loading.gif"></center>';
                  }
            }

          xmlrobot.open("GET",url,true);
          xmlrobot.send();
        }
        
    break;

    default:
    break;

  }

}

</script>
</html>



<?php
if($exists=="yep"){
?>
<script type="text/javascript">
//window.location.assign('admin_panel.php'); 
  add_agent();
</script>
<?php
}

?>
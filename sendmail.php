<?php
function sendMail($to,$subject,$body, $title='', $surname='Sir/Ma'){
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

Dear $title $surname , <br/><br/>
 <center>$body</center><br/><br/>Thank you.<br/><br/>
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
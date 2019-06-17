<?php session_start();
include("session.php");


$time=$_GET['time'];
$subject =$_GET['subject'];
$subject_id =$_GET['sub_id'];


$sqltable ="SELECT * FROM units_table WHERE id IN (SELECT units_table_id FROM unit_subjects WHERE sub_id='$subject_id')";
$rowtable = mysqli_fetch_array(mysqli_query($con,$sqltable));
$service = $rowtable['table_name'];
$sql="SELECT * FROM $service where req_time ='$time'";
$query=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($query)){
		
	 $row["description"];
	 $sent_date=$row["sent_date"];
	 $treated_date=$row["treated_date"];
	 $report=$row["report"];
	 
}

require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
	
	
	function pdf_create($html, $filename, $paper, $orientation, $stream=TRUE)
	{
		$dompdf = new DOMPDF();
		$dompdf->set_paper($paper,$orientation);
		$dompdf->load_html($html);
		$dompdf->set_option('isHtml5ParserEnabled', true);
		$dompdf->render();
		$dompdf->stream($filename);
	}
	
	$filename = 'report';
	
	$html = "<!DOCTYPE html>
<html lang=\"en\">
<head>
<title>
Lasu Help-Desk Report 
</title>

<style>
h1,h3{
	
	
}
#img{
	
	margin-left:50px
}

b{
	color:#CC0000;
}
.content{
	
	margin-left:50px ;
	margin-right:50px ;
	
}

</style>
</head>

<body>


<div id=\"contain\">
<center>

<div>
	<div id=\"img\">
		<img  src=\"custom/images/logo2.gif\"> 
	</div>
	<div >
		<h1>LAGOS STATE UNIVERSITY, OJO</h1>
		<h3>Help-Desk Report</h3>
	</div>

</div>
<center>

</div>

<hr>
<div class=\"content\">

 

<table cellspacing='10' >
<tr><td ><b>Treated Date/Time : $treated_date</b></td></tr><br>
<tr><td ><b>Sent Date/Time : $sent_date</b></td></tr>
<tr><td></td><td></td></tr>
<tr><td><strong>Subject : $subject</strong></td></tr>
<tr><td></td><td> $report</td></tr>


</table><br><br>

<p><i>WE ARE LASU...</i></p>
<p><i>WE ARE PROUD...</i></p>
</div>


</body>



</html>";
	
	pdf_create($html,$filename,'A4','landscape');
?>
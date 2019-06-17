<?php session_start();
include("session.php");
?>



<div  style="float:right "><a id="servicefind" href="#" class="btn btn-lg btn-success"></a></div>
<div><h4 style="color:#338333; align:center">Send Complaint / Request</h4><br>

<form method="POST" action="request_upload.php" onsubmit="return repcon();" enctype="multipart/form-data" target="upload_target">
<!-- <p><b><h5> Category</h5></b></p>
<div class="form-group">

<span style="float:right; padding-right:37%; color:red" class="glyphicon glyphicon-asterisk"></span>
<select style="width:60%" class="form-control" required name="category">
<option  value=""><b>Select your Category </b></option>
<option  value="employer"> Employer </option>
<option  value="investor">Investor </option>
<option  value="parent"> Parent </option>
<option  value="human_resources">Human Resources </option>
<option  value="biz_man"> Business Man </option>
<option  value="potential_student"> Potential Student </option>
<option  value="journalist">Journalist</option>
<option  value="politician"> Politician</option>
<option  value="actor_actress"> Actor/Actress</option>
<option  value="others"> Others</option>

</select>

</div> -->
<b>Subject of Complaint</b>
<div class="form-group ">

<div class="form-group">
<span style="float:right; padding-right:37%; color:red" class="glyphicon glyphicon-asterisk"></span>
<select style="width:60%" id="servicesel" class="form-control" required name="subject" onblur="servicefind('servicesel')">
<option value=''>Select your Subject</option>
<?php
	$sql = "SELECT * FROM unit_subjects ";
	if ($query=mysqli_query($con,$sql)) {		
		while($row = mysqli_fetch_array($query)){
?>
		<option value=<?php echo $row['sub_id']?> ><?php echo $row['subject']?></option>
<?php

		}
	}

?>
</select>
</div></div>
<hr/>
	<p id="service"></p>
	<b><h5><b>Description</b></h5></b><p>
	<span style="float:right; padding-right:5%; color:red" class="glyphicon glyphicon-asterisk"></span>
	<textarea  onkeyup="len();" id="txtlength" name="description" maxLength="200" required class="form-control" style="width: 93%; height: 17%; " placeholder="Type in your Request (Max. 200 Characters)" ></textarea>

	<div >
		 <span class="glyphicon glyphicon-paperclip" style="float: left; font-weight:  bold ">Attachment : </span> <input type="file" name="doc" > 

	</div><p></p>
	<h6 style="color: #ff0000">File Formats Supported are: Jpeg, Jpg,  Png, Gif, Tiff, Pdf, Docx, Doc, txt  </h6>	
	<h6 style="color: #ff0000">Max File Size Allowed : 1MB  </h6>	
	<button class="btn btn-primary" type="submit" name="subreq"  >Submit <span class="glyphicon glyphicon-send"></span></button>
	<!--  -->
	

</form>

<iframe id="upload_target" name="upload_target" src="#" style="width:0; height:0; border:0px solid #fff;"></iframe>
</div>


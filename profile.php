
<?php session_start();
include("session.php");
echo "
<form role=\"form\" method=\"post\"  onsubmit=\"return pval()\" name='profile'>
<table style='width:90%' class=\"table table-striped table-hover\">
</tr>
	<tr>
	<th style=\"width:40%\">Firstname:</th>
	<td><input required class=\"form-control\" value='$onames' type=\"text\" name=\"firstname\"></td>
	</tr>
	<tr>
	<th>Surname:</th>
	<td><input required class=\"form-control\" value='$sname' type=\"text\" name=\"surname\"></td>
	</tr>
	<tr>
	<th>Phone Number:</th>
	<td><input required class=\"form-control\"  value='$phone' type=\"text\" name=\"phoneno\"></td>
	</tr>
	<tr>
	<th>E-mail:</th>
	<td><input class=\"form-control\" readonly type=\"email\" value='$email' name=\"email\"></td>
	</tr>
	<tr>
	<th>New Password:</th>
	<td><input id=\"pass\" required class=\"form-control\" type=\"password\" name=\"pass\"></td>
	</tr>
	<tr>
	<th>Confirm Password: <span id=\"glypass\" ></span></th>
	<td><input required id=\"cpass\" class=\"form-control\" type=\"password\" name=\"cpass\"  onkeyup=\"newmatch()\"></td>
	</tr>
	<tr>
	<th></th>
	<td><input  class=\"btn btn-primary\" type=\"submit\"  name=\"update\"  value=\"Update\"/></td>
	</tr>
	</table></form>
	<div id=\"output\"></div>";
	?>
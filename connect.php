<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "lasu_helpdesk";
$domain = "https://www.lasucomputerscience.com/";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database); 
//$con = mysqli_connect("localhost","root","","lasu_helpdesk1");

if(!@$con){
//die("Error fixing the database!");
}
?>
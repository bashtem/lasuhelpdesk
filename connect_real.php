<?php
$mysql_hostname = "lasucomputerscience.com.mysql";
$mysql_user = "lasucomputerscience_com_lasu_help";
$mysql_password = "Michael1122334455";
$mysql_database = "lasucomputerscience_com_lasu_help";
$domain = "https://www.lasucomputerscience.com/help/";
$con = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database); 
//$con = mysqli_connect("localhost","root","","lasu_helpdesk1");

if(!@$con){
die("Error fixing the database!");
}
?>


<?php

if (isset($_SESSION['timestamp'])){
$min = 20; //  minutes
$timeout = 60 * $min ; // minutes in seconds
$out = false;
if((time()-$_SESSION['timestamp'])>$timeout){

	$out = true;
}else{
	$_SESSION['timestamp'] = time();
  }
}

?>
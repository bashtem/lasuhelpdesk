<?php session_start();
session_destroy();
?>

<script>
	window.alert("You are logged out! Thank you");
	var loc="../";
	window.location.assign(loc);
</script>
<?php
	$title = "Logout";
	include("inc/login/checklogin.inc.php");
	session_destroy();
	header('Location: index.php');
?>
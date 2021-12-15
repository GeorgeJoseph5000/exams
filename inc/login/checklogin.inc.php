<?php 
$u = '';
$fn = '';
$ln = '';
$em = '';
$gdr = '';
$address = '';
$user_pos = '';
$user_type = '';
$avatar = '';
$code = '';
include("inc/functions/functions.inc.php");
include("inc/functions/connect.inc.php");
include("inc/headerparts/setTitle.inc.php");
session_start ();
if (isset ( $_SESSION ['THEUSERLOGIN'] )) {
	$u = $_SESSION ['THEUSERLOGIN'];
	$getinfo = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE username='$u'")); 
	$fn = $getinfo['firstname'];
	$ln = $getinfo['lastname'];
	$em = $getinfo['email'];
	$gdr = $getinfo['gender'];
	$user_pos = $getinfo['user_pos'];
	if($user_pos == "nor"){
		$user_type = "Student";
	}
	$avatar = $getinfo['avatar'];
	$code = $getinfo['current_exam_code'];
} else {
	$u = '';
	$fn = '';
	$ln = '';
	$em = '';
	$gdr = '';
	$address = '';
	$user_pos = '';
	$avatar = '';
	$code = '';
	$_SESSION['examcode'] = '';
}
?>



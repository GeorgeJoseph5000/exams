<?php

$code = $_POST['code'];
$user = $_POST['user'];
$min = $_POST['min'];


include("../inc/check_passed_info.php");


mysql_query("UPDATE users SET current_exam_time='$min' WHERE username='$user'");

echo 'saved';
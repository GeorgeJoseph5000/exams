<?php


$code = $_POST['code'];
$user = $_POST['user'];
$time = $_POST['time'];


include("../inc/check_passed_info.php");



$getRows = mysql_num_rows(mysql_query("SELECT * FROM exam_finished WHERE user='$user' AND code='$code'"));
if ($getRows != 1) {
    mysql_query("INSERT INTO exam_finished VALUES('','$code','$user','$time','still')");
}



mysql_query("UPDATE users SET current_exam_code='none' WHERE username='$user'");
mysql_query("UPDATE users SET current_exam_time='0' WHERE username='$user'");

echo 'saved';
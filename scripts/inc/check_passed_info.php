<?php
include("connect.inc.php");

$checkExam = mysql_num_rows(mysql_query("SELECT * FROM exams WHERE code='$code'"));
$checkUser = mysql_num_rows(mysql_query("SELECT * FROM users WHERE current_exam_code='$code' AND username='$user'"));

if($checkExam != 1 && $checkUser != 1){
    exit("error");
}


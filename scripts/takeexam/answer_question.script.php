<?php



$no = $_POST['question'];
$code = $_POST['code'];
$answer = $_POST['answer'];
$user = $_POST['user'];

include("../inc/check_passed_info.php");


$getNumRow = mysql_num_rows(mysql_query("SELECT * FROM answers WHERE username='$user' AND exam_code='$code' AND no='$no'"));
if ($getNumRow != 1) {
    mysql_query("INSERT INTO answers VALUES('', '$user','$code','$no','$answer')");
}else{
    mysql_query("UPDATE answers SET answer='$answer' WHERE no='$no' AND username='$user' AND exam_code='$code'");
}


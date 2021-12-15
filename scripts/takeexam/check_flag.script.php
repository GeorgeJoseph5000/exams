<?php


$question = $_POST['question'];
$code = $_POST['code'];
$user = $_POST['user'];

include("../inc/check_passed_info.php");


$getRow = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE no_question='$question' AND code='$code' AND user='$user'"));
if($getRow == 1){
    echo 'yes';
}else{
    echo 'no';
}
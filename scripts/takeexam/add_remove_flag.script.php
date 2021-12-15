<?php



$question = $_POST['question'];
$code = $_POST['code'];
$user = $_POST['user'];

include("../inc/check_passed_info.php");




$getRow = mysql_num_rows(mysql_query("SELECT * FROM flags WHERE no_question='$question' AND code='$code' AND user='$user'"));
if($getRow == 1){
    mysql_query("DELETE FROM flags WHERE no_question='$question' AND code='$code' AND user='$user' ");
    echo 'removed';
}else{
    mysql_query("INSERT INTO flags VALUES('','$question','$code','$user')");
    echo 'added';
}
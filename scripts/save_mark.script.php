<?php

$code = $_POST['code'];
$user = $_POST['user'];
$mark = $_POST['mark'];


include("inc/check_passed_info.php");

mysql_query("UPDATE exam_finished SET mark = '$mark' WHERE user = '$user' AND code='$code';");

echo 'Saved successfully';

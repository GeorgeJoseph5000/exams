<?php
include('inc/connect.inc.php');

$user = $_POST['user'];

mysql_query("DELETE FROM users WHERE username='$user'");

echo 'User Deleted';
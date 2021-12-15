<?php
include('inc/connect.inc.php');

$user = $_POST['user'];

mysql_query("UPDATE users SET user_pos='admin' WHERE username='$user'");

echo 'User is admin';
<?php
session_start();
include_once('mysql.php');
setLastActivity();
session_destroy();
echo 'You have been logged out.';
header("Location: login.php");
exit();
?>
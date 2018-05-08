<?php
error_reporting();
session_start();
session_destroy();
header("location:login.php");   
die();
?>

<?php

session_start();
$_SESSION=array();
 setcookie("user_name",  $_SESSION['usuario'], time() - (86400 * 30), "/");
 setcookie("user_role", "", time() - (86400 * 30), "/");
session_destroy();
header("Location: ../Index.php");

?>

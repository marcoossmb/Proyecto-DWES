<?php
// Inicia la sesión actual
session_start();

// Limpia la información de la sesión actual
$_SESSION = array();

// Elimina las cookies
setcookie("user_name", $_SESSION['usuario'], time() - (86400 * 30), "/");
setcookie("user_role", "", time() - (86400 * 30), "/");

// Destruye la sesión actual
session_destroy();

// Redirecciona al usuario a la página de inicio
header("Location: ../index.php");
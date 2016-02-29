<?php
include "controlloSessione.php";
include "verificaLoggato.php";
if(!isset($_SESSION['s220113active'])){
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."index.php?non sei loggato");
	exit;
}
$_SESSION=array();
if (ini_get("session.use_cookies")) { // PHP using cookies to handle session
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 3600*24, $params["path"],
			$params["domain"], $params["secure"], $params["httponly"]);
}
session_destroy(); // destroy session
// redirect client to login page
header('HTTP/1.1 307 temporary redirect');
header('Location: index.php?message=Arrivederci');
exit; // IMPORTANT to avoid further output from the script
?>
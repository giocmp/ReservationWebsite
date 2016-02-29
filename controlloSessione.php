<?php
session_start();
$t=time(); $diff=0; $new=false;
if(isset($_SESSION['s220113active'])){
	if (isset($_SESSION['s220113time'])){
		$t0=$_SESSION['s220113time']; $diff=($t-$t0); // inactivity period
	} else {
		$new=true;
	}
	if ($new || ($diff > 120)) { // new or with inactivity period too long
		//session_unset(); // Deprecated
		$_SESSION=array();
		// If it's desired to kill the session, also delete the session cookie.
		// Note: This will destroy the session, and not just the session data!
		if (ini_get("session.use_cookies")) { // PHP using cookies to handle session
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 3600*24, $params["path"],
					$params["domain"], $params["secure"], $params["httponly"]);
		}
		session_destroy(); // destroy session
		// redirect client to login page
		header('HTTP/1.1 307 temporary redirect');
		header('Location: '."index.php?message=session time out");
		exit; // IMPORTANT to avoid further output from the script
	} else {
		$_SESSION['s220113time']=time(); /* update time */
	}
}
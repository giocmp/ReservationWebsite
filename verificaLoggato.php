<?php
if(!isset($_SESSION['s220113active'])){
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."index.php?message=Non sei loggato");
	exit;
}
?>


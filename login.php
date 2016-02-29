<?php
include "controlloSessione.php";
if(isset($_SESSION['s220113active'])){
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."index.php?message=Sei gia loggato");
	exit;
}
include "myconnect.php";

$_REQUEST['username'] = strip_tags($_REQUEST['username']);
$_REQUEST['password'] = strip_tags($_REQUEST['password']);

if(isset($_REQUEST['username']) && $_REQUEST['username']!= null && $_REQUEST['username']!= null && strlen($_REQUEST['username']) <= 20){
	if(($_REQUEST['password']) && $_REQUEST['password'] != null && $_REQUEST['username']!= null && strlen($_REQUEST['username']) <= 20){
		//controllo esistenza nome utente
		$conn = mycnct();
		if(!$conn){
			header('HTTP/1.1 307 temporary redirect');
			header('Location: '."index.php?message=Base Dati non accessibile");
			exit;
		}
		else{
			$_REQUEST['password'] = mysqli_real_escape_string($conn, $_REQUEST['password']);
			$_REQUEST['username'] = mysqli_real_escape_string($conn, $_REQUEST['username']);
			$ris = mysqli_query($conn, "select username, password, sale from utenti where username=\"$_REQUEST[username]\"");
			if(mysqli_num_rows($ris)<=0){
				mysqli_free_result($ris);
				mysqli_close($conn);
				header('HTTP/1.1 307 temporary redirect');
				header('Location: '."index.php?message=nome utente non valido");
				exit;
			}
			else{
				$risultato = mysqli_fetch_array($ris, MYSQLI_ASSOC);
				//aggiungo il sale alla passwordi inserita dall'utente
				$_REQUEST['password'] = $_REQUEST['password'].$risultato['sale'];
				//calcolo l'md5
				$_REQUEST['password'] = md5($_REQUEST['password']);
				//confronto
				if($risultato['password'] != $_REQUEST['password']){
					mysqli_free_result($ris);
					mysqli_close($conn);
					header('HTTP/1.1 307 temporary redirect');
					header('Location: '."index.php?message=dati errati");
					exit;
				}
				else{
					$_SESSION['s220113active'] = 1;
					$_SESSION['s220113time']=time();
					$_SESSION['s220113user'] = $_REQUEST['username'];
					mysqli_free_result($ris);
					mysqli_close($conn);
					header('HTTP/1.1 307 temporary redirect');
					header('Location: '."index.php?message=Benvenuto $_SESSION[s220113user]");
					exit;
				}
			}
			
		}
	}
	else{
		header('HTTP/1.1 307 temporary redirect');
		header('Location: '."index.php?message=passwordMancante");
		exit;
	}
}
else{
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."index.php?message=inserire i dati");
	exit;
}
?>

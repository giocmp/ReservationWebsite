<?php 
include "controlloSessione.php";
include "verificaLoggato.php";
include "myconnect.php";

if(isset($_REQUEST['codP']) && $_REQUEST['codP'] != ""){
	$_REQUEST['codP'] = strip_tags($_REQUEST['codP']);
	$conn = mycnct();
	if(!$conn){
		header('HTTP/1.1 307 temporary redirect');
		header('Location: '."disdici.php?message=Base Dati non accessibile");
		exit;
	}
	else{
		$_REQUEST['codP'] = mysqli_real_escape_string($conn, $_REQUEST['codP']);
		$ris = mysqli_query($conn, "select * from prenotazioni where codp = $_REQUEST[codP]");
		if(mysqli_num_rows($ris) <=0 ){
			mysqli_close($conn);
			header('HTTP/1.1 307 temporary redirect');
			header('Location: '."tueattivita.php?message=Problema riconoscimento prenotazione");
			exit;
		}
		else{//da qua in poi l'attività deve essere univoca uso il lock
			$prenotazione = mysqli_fetch_array($ris, MYSQLI_ASSOC);
			try {
				//disabilito l'autocommit
				mysqli_autocommit($conn,false);
				$posti = intval($prenotazione['nadulti']) + intval($prenotazione['nbambini']);
				$ris = mysqli_query($conn, "UPDATE attivita SET postidisp = postidisp + $posti WHERE idA = $prenotazione[codA]");
				if(!$ris){
					throw new Exception("inpossibile agiornare i posti disponibili");
				}
				$ris = mysqli_query($conn, "DELETE FROM prenotazioni WHERE codp = $prenotazione[codP]");
				if(!$ris){
					throw new Exception("inpossibile disdire");
				}
				if (!mysqli_commit($conn)) {
					// per avere il corretto messaggio di errore
					throw Exception("Commit fallita");
				}
				header('HTTP/1.1 307 temporary redirect');
				header('Location: '."tueattivita.php?message=Prenotazione disdetta");
				exit;
			}
			catch(Exception $e) {
				mysqli_rollback($conn);
				//mysqli_close($conn);///***** non faccio unlock perchè la close lo rilascia******/
				header('HTTP/1.1 307 temporary redirect');
				header('Location: '."tueattivita.php?message=".$e->getMessage());
				exit;
			}
		}
	}	
}
else{
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."tueattivita.php?message=Attivita non valida");
}
?>

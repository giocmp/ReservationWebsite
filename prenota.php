<?php 
include "controlloSessione.php";
include "verificaLoggato.php";
if(!isset($_SESSION['s220113active'])){
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."index.php");
}
include "myconnect.php";
		
$_REQUEST['idA'] = strip_tags($_REQUEST['idA']);
$_SESSION['s220113user'] = strip_tags($_SESSION['s220113user']);
$_REQUEST['adulti'] = strip_tags($_REQUEST['adulti']);
$_REQUEST['bambini'] = strip_tags($_REQUEST['bambini']);



if(isset($_REQUEST['adulti']) && $_REQUEST['adulti'] != "" && $_REQUEST['adulti'] == 1){
	if(isset($_REQUEST['bambini']) && $_REQUEST['bambini'] != "" && $_REQUEST['bambini']<=3 && $_REQUEST['bambini'] >= 0){
		$conn = mycnct();
		if(!$conn){
			header('HTTP/1.1 307 temporary redirect');
			header('Location: '."index.php?message=Base Dati non accessibile");
			exit;
		}
		else{
			$postitot = mysqli_real_escape_string($conn, $_REQUEST['adulti'])  + mysqli_real_escape_string($conn, $_REQUEST['bambini']);
			$adulti = mysqli_real_escape_string($conn, $_REQUEST['adulti']);
			$bambini= mysqli_real_escape_string($conn, $_REQUEST['bambini']);
			$codA = mysqli_real_escape_string($conn, $_REQUEST['idA']);
			
			$ris = mysqli_query($conn, "select codU from utenti where username = \"$_SESSION[s220113user]\"");
			if(mysqli_num_rows($ris) <=0 ){
				mysqli_free_result($ris);
				mysqli_close($conn);
				header('HTTP/1.1 307 temporary redirect');
				header('Location: '."index.php?message=Problema riconoscimento utente");
				exit;
			}
			else{
				$risultato = mysqli_fetch_array($ris, MYSQLI_ASSOC);
				$codU = $risultato['codU'];
				//+++++++++++++++verifico se l'utente è già iscritto+++++++++++++++++
				/* */$ris = mysqli_query($conn, "select codA from prenotazioni where codU = $codU and codA = $codA");
				/* */if(mysqli_num_rows($ris) != 0 ){
						mysqli_free_result($ris);
				/* */	mysqli_close($conn);
				/* */	header('HTTP/1.1 307 temporary redirect');
				/* */	header('Location: '."index.php?message=Prenotazione effettuata in precedenza");
				/* */	exit;
				/* */}
				//**++++++++++++++++++++++++++++++++++++++++++++++++++++**/
				else{
					//registro l'attività
					try {
						//disabilito l'autocommit
						mysqli_autocommit($conn,false);
						//verifico l'attivita
						$ris = mysqli_query($conn, "SELECT postidisp FROM attivita WHERE idA= $codA for update");
						if(mysqli_num_rows($ris)<=0){
							throw new Exception("attivita non trovata");
						}
						//verifico la sufficenza dei posti
						$risultato = mysqli_fetch_array($ris, MYSQLI_ASSOC);
						$disp = $risultato['postidisp'];
						if($disp < $postitot){
							throw new Exception("posti insufficenti");
						}
						//inserisco la prenotazione
						$ris = mysqli_query($conn, "INSERT INTO prenotazioni(codP, codA, codU, nadulti, nbambini) VALUES (0, $codA , $codU, 1, $bambini)");
						if(!$ris){
							throw new Exception("prenotazione attivita non possibile");
						}
						//aggiorno i posti disponibili
						$disp = $disp - $postitot;
						$ris = mysqli_query($conn, "UPDATE attivita SET postidisp = $disp WHERE idA = $codA");
						if(!$ris){
							throw new Exception("aggiornamento posti disp fallito");
						}	
						if (!mysqli_commit($conn)) {
							// per avere il corretto messaggio di errore
							throw Exception("Commit fallita");
						}
						//eseguo se tutto va bene
						//mysqli_close($conn);//Cancellare se uso l'autocommitt
						mysqli_free_result($ris);
						header('HTTP/1.1 307 temporary redirect');
						header('Location: '."index.php?message=Prenotazione effettuata");
						exit;
					} catch (Exception $e) {
						mysqli_free_result($ris);
						mysqli_rollback($conn);
						//mysqli_close($conn);///***** non faccio unlock perchè la close lo rilascia******/
						header('HTTP/1.1 307 temporary redirect');
						header('Location: '."index.php?message=".$e->getMessage());
						exit;
					}
				}
			}
		}
	}
	else{
		header('HTTP/1.1 307 temporary redirect');
		header('Location: '."index.php?message=Volori inseriti errati1");
		exit;
	}	
}
else{
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."index.php?message=Volori inseriti errati2");
	exit;
}
?>
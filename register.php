<?php
include "myconnect.php";

	if(isset($_REQUEST['username']) && $_REQUEST['username']!= null && strlen($_REQUEST['username']) <= 20){
		if(($_REQUEST['pass1']) && $_REQUEST['pass1'] != null && strlen($_REQUEST['pass1']) <= 20){
			if(isset($_REQUEST['pass2']) && $_REQUEST['pass2'] != null && strlen($_REQUEST['pass2']) <= 20){
				if($_REQUEST['pass2'] != $_REQUEST['pass1']){
					header('HTTP/1.1 307 temporary redirect');
					header('Location: '."signup.php?message=Valori Inseriti Errati");
					exit;	
				}
				else{
					$_REQUEST['pass1'] = strip_tags($_REQUEST['pass1']);					
					$_REQUEST['username'] = strip_tags($_REQUEST['username']);
					$_REQUEST['pass2'] = strip_tags($_REQUEST['pass2']);
					
					$conn = mycnct();
					$_REQUEST['username'] = mysqli_real_escape_string($conn, $_REQUEST['username']);
					$_REQUEST['pass1'] = mysqli_real_escape_string($conn, $_REQUEST['pass1']);
					$_REQUEST['pass2']  = mysqli_real_escape_string($conn, $_REQUEST['pass2']);
					
					if(!$conn){
						header('HTTP/1.1 307 temporary redirect');
						header('Location: '."signup.php?message=Base Dati non accessibile");
						exit;
					}
					else{
						//devo fare in modo che piu utenti non facciano la select vedendo libero un nome nello stesso momento
						mysqli_autocommit($conn,false);
						// NON DIMENTICARE DI FARE COMMIT O ROLLBACK //

						$ris = mysqli_query($conn, "select count(username) from utenti where username = \"$_REQUEST[username]\" for update");
						$risultato = mysqli_fetch_array($ris, MYSQLI_ASSOC);
						if($risultato['count(username)'] == 0){ //il nome è libero
							//genero il sale
							$sale = generateRandomString();
							$_REQUEST["pass1"] = $_REQUEST["pass1"].$sale;
							//sostituisco l'md5
							$_REQUEST["pass1"] = md5($_REQUEST["pass1"]);
							//inserisco nel db
							$ris = mysqli_query($conn, "INSERT INTO utenti(codU, username, password, sale) VALUES (0,\"$_REQUEST[username]\",\"$_REQUEST[pass1]\", \"$sale\")");
							if($ris == true){
								//mysqli_close($conn);
								mysqli_free_result($ris);
								if (!mysqli_commit($conn)) {
									mysqli_rollback($conn);
									header('HTTP/1.1 307 temporary redirect');
									header('Location: '."index.php?message=Registrazione fallita");
									exit;
								}
								header('HTTP/1.1 307 temporary redirect');
								header('Location: '."index.php?message=Ora puoi accedere");
								exit;
							}
							else{
								mysqli_free_result($ris);
								mysqli_rollback($conn);
								header('HTTP/1.1 307 temporary redirect');
								header('Location: '."signup.php?message=problema al db");
								exit;
							}
						}
						else{
							mysqli_free_result($ris);
							mysqli_rollback($conn);
							header('HTTP/1.1 307 temporary redirect');
							header('Location: '."signup.php?message=Nome utente gia esistente".$ciao);
							exit;
						}
					}
				}
			}
			else{
				header('HTTP/1.1 307 temporary redirect');
				header('Location: '."signup.php?message=Valori Inseriti Errati");
				exit;
			}
		}
		else{
			header('HTTP/1.1 307 temporary redirect');
			header('Location: '."signup.php?message=Valori Inseriti Errati");
			exit;
		}
	}
	else{
		header('HTTP/1.1 307 temporary redirect');
		header('Location: '."signup.php?message=Valori Inseriti Errati");
		exit;
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
?>

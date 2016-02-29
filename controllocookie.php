<?php
function cntck1($returnpath){
	if(!isset($_SESSION['s220113cookieson'])){
		$_SESSION['s220113cookieson'] = 1;
		header('HTTP/1.1 307 temporary redirect');
		header('Location: '."checkcookies.php?returnpath=$returnpath");
		exit;
	}
}

function cntck2($returnpath, $message){
	if(!isset($_SESSION['s220113cookieson'])){
		$_SESSION['s220113cookieson'] = 1;
		//se è settato un messaggio per index.html
		//lo mando in avanti in modo che poi nella 
		//checkcookie lo rimando alla pagina che lo 
		//visualizzera
		header('HTTP/1.1 307 temporary redirect');
		header('Location: '."checkcookies.php?returnpath=$returnpath"."?message=".strip_tags($_REQUEST['message']));
		exit;
		
	}
}
?>
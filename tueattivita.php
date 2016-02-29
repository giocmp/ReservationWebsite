<?php 
include "switchhttps.php";
include "controlloSessione.php";
include "verificaLoggato.php";
if(!isset($_SESSION['s220113active'])){
	header('HTTP/1.1 307 temporary redirect');
	header('Location: '."index.php?message=Non sei loggato");
	exit;
}
include "controllocookie.php";
if(isset($_REQUEST['message'])){
	cntck2("tueattivita.php", $_REQUEST['message']);
}
else{
	cntck1("tueattivita.php");
}
include "myconnect.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta Content-type="text/html" charset="UTF-8" />
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
	<!-- quando carico nel server cambiare /s220blabla con /.. SI DEVONO UNSARE PERCORSI RELATIVI -->
<title>s220113</title>
</head>
	<body>

	    <div class="jumbotron">
	    	<div class="container">
	    		<h1> <div class="textwhite">Scegli la tua attivit&agrave</div></h1>
	    	</div>
		</div>
		
		
	
	    <div class="container">
			<div class="row">
			
				<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
					<?php 
						if(isset($_REQUEST['message'])){
							$_REQUEST['message'] = strip_tags($_REQUEST['message']);
							echo	"<div class=\"sidebar-module sidebar-module-inset\">
							<h4 class=\"margin20\">$_REQUEST[message]</h4>
							<hr>
							</div><!-- sidebar-module -->";
						}
						
						echo	"<div class=\"sidebar-module sidebar-module-inset\">
					            	<h4 class=\"margin20\">Torna alla home</h4>
									<dd><button id =\"tohome\" class=\"float-left\">Home</button></dd>
				            		<hr>
								</div><!-- sidebar-module -->
								
								<div class=\"sidebar-module sidebar-module-inset\">
								<button id=\"logout\" class=\"float-left\" >Logout</button>
								</div><!-- sidebar-module -->";
					?>
				</div><!-- /.blog-sidebar -->
							
		        <div class="col-sm-8 blog-main">
		        	<noscript>
					    <h1>ABILITARE JAVASCRIPT. IL SITO POTREBBE NON FUNIONARE CORRETTAMENTE</h1>
					</noscript>
			        <?php
			        	$conn = mycnct();
			        	if(!$conn){
			        		echo "<div class=\"blog-post\">";
			        		echo "<h2 class=\"blog-post-title\">No connessione al db. Ricontattaci più tardi</h2>";
			        		echo "</div><!-- /.blog-post -->";
			        	}
			        	else{
			        		$ris = mysqli_query($conn, "SELECT codU FROM utenti WHERE username = \"$_SESSION[s220113user]\"");
			        		if(mysqli_num_rows($ris)<=0){
			        			echo "<div class=\"blog-post\">";
			        			echo "<h2 class=\"blog-post-title\">Username non trovato</h2>";
			        			echo "</div><!-- /.blog-post -->";
			        			mysqli_close($conn);
			        		}
			        		else{
			        			$riga = mysqli_fetch_array($ris, MYSQLI_ASSOC);
			        			$codU = $riga['codU'];
			        			$ris = mysqli_query($conn, "SELECT * FROM attivita a, prenotazioni p WHERE p.codA = a.idA and p.codU = $codU");
			        			if(mysqli_num_rows($ris)<=0){
			        				echo "<div class=\"blog-post\">";
			        				echo "<h2 class=\"blog-post-title\">Nessuna attivit&agrave trovata</h2>";
			        				echo "</div><!-- /.blog-post -->";
			        				mysqli_close($conn);
			        			}
			        			else{
			        				echo	"<div class=\"blog-post\">
						        				<h2 class=\"blog-post-title\">Le tue attivit&agrave</h2>
												<hr>
						        			</div><!-- /.blog-post -->";
			        				for($i = 0; $i < mysqli_num_rows($ris); $i++ ){
			        					$riga = mysqli_fetch_array($ris, MYSQLI_ASSOC);
			        					echo	"<div class=\"blog-post\">
			        								<h3 class=\"blog-post-title\">$riga[nomeA]</h3>
					        						<button id=\"mostradescrizione\" class=\"float-left\" onclick=\"mostradescrizione($i)\" >Descrizione</button>
													Posti prenotati: Adulti= $riga[nadulti], Bambini= $riga[nbambini]
			        									<form id=\"submit\" action=\"disdici.php\" method=\"POST\">
					        								<input name=\"codP\" type=\"text\" value = $riga[codP] style=\"display: none;\">
										            		<dd><input id =\"bottone\" type=\"submit\" value=\"Disdici\">
										            	</form>
											            
			        								<div id = \"$i\" style=\"display: none;\">
				        								<p><div class=\"giustificato\">$riga[descrizione]</div><p>
				        							</div>
			        									        								
			        								<hr>
			        							</div><!-- /.blog-post -->";
			        				}
			        				mysqli_free_result($ris);
			        				mysqli_close($conn);
			        			}
			        		}
			        	} 
			        	
			        ?>			      	
		        </div><!-- /.blog-main -->
			</div><!-- /.row -->
			
		</div><!-- /.container -->

	  </body>
</html>



<script type="text/javascript">
document.getElementById("tohome").onclick = function () {
	location.href = "index.php";
};
</script>

<script type="text/javascript">
   function  mostradescrizione(idd){
	   //alert("ciao");
	   var x = document.getElementById(idd);
	   if(x.style.display == "block"){
		   x.style.display="none";
	   }
	   else{
		   x.style.display="block";
	   }
    };
</script>

<script type="text/javascript">
    document.getElementById("logout").onclick = function () {
        location.href = "logout.php";
    };
</script>
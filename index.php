<?php 
include "switchhttps.php";
include "controlloSessione.php";
include "controllocookie.php";
if(isset($_REQUEST['message'])){
	cntck2("index.php", $_REQUEST['message']);
}
else{
	cntck1("index.php");
}
include "myconnect.php";
?>
			
<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8" />
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
						if(!isset($_SESSION['s220113active'])){
							echo 	"<div class=|\"sidebar-module sidebar-module-inset\">
										<h4 class=\"margin20\">Login</h4>
				            			<form id=\"login\" action=\"login.php\" method=\"POST\">
						            		<dl>
						            			<dt>Username</dt>
						            			<dd><input name=\"username\" type=\"text\" placeholder=\"Username\" maxlength=\"20\"></dd>
							            		<dt>Password</dt>
							            		<dd><input name=\"password\" type=\"password\" placeholder=\"Password\" maxlength=\"20\"></dd>
							            		<dt><br></dt>
							            		<dd><input type=\"submit\" value=\"Login\"></dd>
						            		</dl>
					            		</form>
					            		<hr>
					            		<dl>
					            			<dt>o se sei nuovo: </dt> 
											<button id=\"signup\" class=\"float-left\" >Signup</button>
										</dl>
					            		<hr>
									</div><!-- sidebar-module -->";
						}
						else{//sessione attiva
							echo	"<div class=\"sidebar-module sidebar-module-inset\">
						            	<h4 class=\"margin20\">Partecipa ad una nostra attivit&agrave</h4>
										<dl>
					            			<dd>O gestisci le tue <button id=\"tueattivita\" class=\"float-left\" >attivit&agrave</button><dd>
					            		</dl>
					            		<hr>
									</div><!-- sidebar-module -->
									
									<div class=\"sidebar-module sidebar-module-inset\">
									<button id=\"logout\" class=\"float-left\" >Logout</button>
									</div><!-- sidebar-module -->";
						}						
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
			        		$ris = mysqli_query($conn, "select * from attivita order by postidisp desc");
			        		if(mysqli_num_rows($ris)<=0){
			        			echo "<div class=\"blog-post\">";
			        			echo "<h2 class=\"blog-post-title\">Nessuna attività proposta</h2>";
			        			echo "</div><!-- /.blog-post -->";
			        			mysqli_free_result($ris);
			        			mysqli_close($conn);
			        		}
			        		else{
			        			for($i = 0; $i < mysqli_num_rows($ris); $i++ ){
			        				$riga = mysqli_fetch_array($ris, MYSQLI_ASSOC);
			        				echo	"<div class=\"blog-post\">
		        							<h2 class=\"blog-post-title\">$riga[nomeA]</h2>
		        							<p><div class=\"giustificato\">$riga[descrizione]</div><p>";
			        				
			        				if(!isset($_SESSION['s220113active'])){
			        					echo"<dd>
			        							<button id=\"partecipa\" class=\"float-left\" onclick=\"farelogin()\" >Partecipa</button>
				        						Posti: TOTALI= $riga[postitot]; DISPONIBILI= $riga[postidisp]
				        					</dd>";
			        				}
			        				else{
			        					$attivita = $riga['idA'];
			        					echo"<dd>
				        						<div id=\"bottoni\">
						        					<button id=\"partecipaloggato\" class=\"float-left\" onclick=\"mostramenu($attivita, this)\" >Partecipa</button>
						        					
						        					<form id=\"$attivita\" action=\"prenota.php\" method=\"GET\" style=\"display: none;\">
									            		<dl>
									            			<dt>Adulti</dt>
									            			<dd><input type=\"text\" name=\"adulti\" value=1 readonly></dd>
										            		<dt>Bambini</dt>
										            		<dd>
										            			<select name=\"bambini\">
										            			<option value=0>0</option>
																<option value=1>1</option>
																<option value=2>2</option>
																<option value=3>3</option>
																</select>
															</dd>
															<input type=\"text\" name=\"idA\" value=$attivita style=\"display: none;\">
										            		<dt><br></dt>
										            		<dd><input type=\"submit\" value=\"Prenota\"></dd>
									            		</dl>
								            		</form>
								            		
						        					Posti: TOTALI= $riga[postitot]; DISPONIBILI= $riga[postidisp]
					        					</div>
				        					</dd>";
			        				}
			        				echo "<hr>
			        						</div><!-- /.blog-post -->";
			        				
			        			}
			        			mysqli_free_result($ris);
			        			mysqli_close($conn);
			        		}
			        	} 
			        ?>			      	
		        </div><!-- /.blog-main -->
			</div><!-- /.row -->
			
		</div><!-- /.container -->
		
	 </body>
</html>

<script type="text/javascript">
   	function farelogin() {
        alert("Devi effettuare il login");
    };
</script>

<script type="text/javascript">
    document.getElementById("tueattivita").onclick = function () {
        location.href = "tueattivita.php";
    };
</script>


<script type="text/javascript">
    document.getElementById("signup").onclick = function () {
        location.href = "signup.php";
    };
</script>

<script type="text/javascript">
    document.getElementById("logout").onclick = function () {
        location.href = "logout.php";
    };
</script>

<script type="text/javascript">
   function  mostramenu(idm, obj){
	   //alert("ciao");
	   var x = document.getElementById(idm);
       x.style.display="block";
       obj.style.display="none";
    };
</script>

	    
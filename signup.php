<?php 
include "switchhttps.php";
include "controlloSessione.php";
include "controllocookie.php";
if(isset($_REQUEST['message'])){
	cntck2("signup.php", $_REQUEST['message']);
}
else{
	cntck1("signup.php");
}
?>
<!DOCTYPE html>
<html >
<head>
	<meta http-equiv="Content-Type" charset="UTF-8" />
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
					<div class="sidebar-module sidebar-module-inset">
						
					</div><!-- sidebar-module -->			
		        </div><!-- /.blog-sidebar -->
		        		        
		        
	        
		        <div class="col-sm-8 blog-main">
		        	<noscript>
					    <h1>ABILITARE JAVASCRIPT. IL SITO POTREBBE NON FUNIONARE CORRETTAMENTE</h1>
					</noscript>
			        <?php 
		        		if(isset($_REQUEST['message'])){
		        			$_REQUEST['message'] = strip_tags($_REQUEST['message']);
		        			echo	"<div class=\"blog-post\">
										<h2 class=\"blog-post-title\">$_REQUEST[message]</h2>
										<button id=\"riprova\" class=\"float-left\" >Riprova</button>
									</div><!-- /.blog-post -->";
									
		        		}
		        		else{
		        			echo 	"<div class=\"blog-post\">
							        	<h2 class=\"blog-post-title\">Inserisci i tuoi dati</h2>
							        	<form id=\"submit\" action=\"register.php\" onsubmit=\"checkPassword(this)\" method=\"POST\">
						            		<dl>
						            			<dt>Username</dt>
						            			<dd><input name=\"username\" type=\"text\" placeholder=\"Username (max 20)\" maxlength=\"20\"></dd>
							            		<dt>Password</dt>
							            		<dd><input type=\"password\" name=\"pass1\" id=\"pass1\" onkeyup=\"checkPass()\" placeholder=\"Password (max 20)\" maxlength=\"20\"></dd>
							            		<dt>Confirm password</dt>
							            		<dd><input type=\"password\" name=\"pass2\" id=\"pass2\" onkeyup=\"checkPass()\" placeholder=\"Ripeti password (max 20)\" maxlength=\"20\"></dd>
				            					<dd><span id=\"confirmMessage\" class=\"confirmMessage\"></span></dd>
				            					<dt><br></dt>
							            		<dd><input id =\"bottone\" type=\"submit\" value=\"Registrami\"></dd>
						            		</dl>
					            		</form>
										<dl>
											<dt>O torna alla home</dt>
											<dd><button id =\"tohome\" class=\"float-left\">Home</button></dd>
										<dl>
								   </div><!-- /.blog-post -->";
		        		}
			        	
			        ?>
			            	
			        
			        
		        </div><!-- /.blog-main -->
			</div><!-- /.row -->
			
		</div><!-- /.container -->
		
	  </body>
</html>


<script type="text/javascript">
	function checkPass()
	{
		var bott = document.getElementById('bottone');
	    var pass1 = document.getElementById('pass1');
	    var pass2 = document.getElementById('pass2');
	    var message = document.getElementById('confirmMessage');
	    var goodColor = "#66cc66";
	    var badColor = "#ff6666";
	    if(pass1.value == pass2.value){
	        pass2.style.backgroundColor = goodColor;
	        message.style.color = goodColor;
	        message.innerHTML = "Passwords Match!"
	    }else{
	        pass2.style.backgroundColor = badColor;
	        message.style.color = badColor;
	        message.innerHTML = "Passwords Do Not Match!"
	    }
	}  
</script>

<script type="text/javascript">
document.getElementById("riprova").onclick = function () {
	location.href = "signup.php";
};
</script>

<script type="text/javascript">
document.getElementById("tohome").onclick = function () {
	location.href = "index.php";
};
</script>

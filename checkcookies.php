<?php
include "switchhttps.php";
session_start();
	if(isset($_SESSION['s220113cookieson'])){
		if(isset($_REQUEST['message'])){
			if(isset($_REQUEST['returnpath'])){
				$msg = strip_tags($_REQUEST['message']);
				header('HTTP/1.1 307 temporary redirect');
				header('Location: '.$_REQUEST['returnpath']."?message=".$msg);
				exit;
			}
			
		}
		header('HTTP/1.1 307 temporary redirect');
		//header('Location: '."index.php");
		header('Location: '.$_REQUEST['returnpath']);
		exit;
	}
?>
<!DOCTYPE html>
<html >
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
	    		<h1> <div class="textwhite">Scegli la tua attivit&agrave</font></h1>
	    	</div>
		</div>
	    <div class="container">
			<div class="row">
				<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
					<div class="sidebar-module sidebar-module-inset">
						<input type=button onClick="location.href='index.php'" value="home">
					</div><!-- sidebar-module -->
				</div><!-- /.blog-sidebar -->
							
		        <div class="col-sm-8 blog-main">
		        	<div class="blog-post">
			        	<h2 class="blog-post-title">ABILITARE I COOKIES!</h2>
			        	<noscript>
						    <h1>ABILITARE JAVASCRIPT. IL SITO POTREBBE NON FUNIONARE CORRETTAMENTE</h1>
						</noscript>
			        	<hr>
			        </div><!-- /.blog-post -->
		        </div><!-- /.blog-main -->
			</div><!-- /.row -->
		</div><!-- /.container -->
		
	 </body>
</html>
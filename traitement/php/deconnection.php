<?php
	session_start();

	//Suppression des variables de session et de la session
	$_SESSION=array();
	session_destroy();
	unset($_SESSION);

	//Vider le cache du navigateur
	header("Cache-Control: no-store,no-cache, must-revalidate");

	//Redirection vers la page de connection
	header('Location: ../../index.php?logout=ok');

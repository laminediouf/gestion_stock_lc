<?php
	if(empty($_SESSION['user']))
	{
		header('Location: ../../index.php?logout=ok');
	}

	if(isset($_GET['logout']))
	{
		unset($_SESSION);
		session_destroy();
		header("Location:../../index.php?logout=ok");
	}

<?php
	require_once'../../database/dbconfig.php';
		

	$id		=	$_SESSION['user_id'];

	
	
	unset($_SESSION['user_id']);
	unset($_SESSION['sy_id']);
	session_destroy();
	header("Location:../../");
?>

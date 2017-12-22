<?php
	//logout, destroys sessions

	session_start();
	unset($_SESSION['username']);
	unset($_SESSION['id']);
	header('Location: ../index.php');
	exit;
?>
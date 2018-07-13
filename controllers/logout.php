<?php
	include_once 'function.php';
	include_once 'config.php';

	session_start();

	$accID = $_SESSION['accID'];

	$txtEvent = "Logged out of the system";
	logEvent($con, $accID, $txtEvent);

	unset($_SESSION['accID']);
	header('location: ../login.php');
?>
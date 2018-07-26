<?php
	include_once 'function.php';
	include_once 'config.php';

	session_start();

	# Get the current session ID
	$accID = $_SESSION['accID'];

	# Log the event
	$txtEvent = "Logged out of the system";
	logEvent($con, $accID, $txtEvent);

	# Unset the session ID 
	unset($_SESSION['accID']);
	header('location: ../login.php');
?>
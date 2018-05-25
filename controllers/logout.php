<?php
	session_start();
	unset($_SESSION['accID']);
	header('location: ../login.php');
?>
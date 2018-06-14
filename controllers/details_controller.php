<?php
	$pageTitle = "Record Details";
	include_once 'includes/header.php';

	#*** use htmlspecialchars when displaying outputs

	#validate that the record being requested through the url
	#is an existing/valid record
	#if the record does not exist, show an error
	if(isset($_GET['rid']))
	{
		$recordID = $_GET['rid'];

		#validate that the ID exists in the records
		$sql_validate = $con->prepare("SELECT csID FROM costsavings WHERE csID = ?");
		$sql_validate->bind_param("i", $recordID);
	}
	else
	{
		header('location: error.php');
	}
?>
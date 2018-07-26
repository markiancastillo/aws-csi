<?php
	$pageTitle = "Audit Logs";
	include_once 'includes/header.php';

	# Determine if the current user has access to the page
	# If not, redirect to the home page
	$allowAccess = allowAccess($con, $accID);
	if($allowAccess != 1)
	{
		header('location: error.php');
	}

	# Get the records from the logs table
	$sql_logs = "SELECT logDate, logUser, logEvent FROM logs ORDER BY logDate DESC";
	$result_logs = $con->query($sql_logs) or die(mysqli_error($con));

	$list_logs = "";
	while($row = mysqli_fetch_array($result_logs))
	{
		# Change the output format for the date
		$logDate = date('m/d/Y H:i:s', strtotime($row['logDate']));
		$logUser = $row['logUser'];
		$logEvent = $row['logEvent'];

		# Display the results as a table format
		$list_logs .= "
			<tr>
				<td>$logDate</td>
				<td>$logUser</td>
				<td>$logEvent</td>
            </tr>
		";
	}
?>
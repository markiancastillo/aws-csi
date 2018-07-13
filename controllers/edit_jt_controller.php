<?php
	$pageTitle = "Edit Team Name";
	include_once 'includes/header.php';

	# Echoes a redirect line if the user does not have access to the page
	accessPage($con, $accID);

	if(isset($_GET['id']))
	{
		$requestID = $_GET['id'];

		# Validate that the requested input exists
		$sql_validate = "SELECT teamID FROM journeyteams WHERE teamID = $requestID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

		if(mysqli_num_rows($result_validate) == 0)
		{
			# No records match
			header('location: error.php');
		}
		else
		{
			# Display the current value
			$sql_display = "SELECT teamID, teamName FROM journeyteams WHERE teamID = $requestID";
			$result_display = $con->query($sql_display) or die(mysqli_error($con));

			while($rd = mysqli_fetch_array($result_display))
			{
				$teamName = htmlspecialchars($rd['teamName']);
			}

			if(isset($_POST['btnSave']))
			{
				# Get the input data from the form
				$inpName = $_POST['inpName'];

				# Execute the update query
				$sql_update = $con->prepare("UPDATE journeyteams SET teamName = ? WHERE teamID = ?");
				$sql_update->bind_param("si", $inpName, $requestID);
				$sql_update->execute();

				$txtEvent = "Updated record #". $requestID . " of journey teams from '" . $teamName . "' to '" . $inpName . "'";
				logEvent($con, $accID, $txtEvent);

				$msgDisplay = successAlert("Successfully udpated the record!");

				header('refresh: 1; url=add_jt.php');
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
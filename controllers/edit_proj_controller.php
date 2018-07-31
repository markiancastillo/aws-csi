<?php
	$pageTitle = "Edit Project Details";
	include_once 'includes/header.php';

	# Echoes a redirect line if the user does not have access to the page
	accessPage($con, $accID);

	if(isset($_GET['id']))
	{
		$requestID = $_GET['id'];

		# Validate that the requested ID exists
		$sql_validate = "SELECT projectID FROM projects WHERE projectID = $requestID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

		if(mysqli_num_rows($result_validate) == 0)
		{
			# No records match
			header('location: error.php');
		}
		else
		{
			# Display the current value of the name 
			$sql_display = "SELECT projectID, projectName, projectDescription FROM projects WHERE projectID = $requestID";
			$result_display = $con->query($sql_display) or die(mysqli_error($con));

			while($rd = mysqli_fetch_array($result_display))
			{
				$projectName = htmlspecialchars($rd['projectName']);
				$projectDescription = htmlspecialchars($rd['projectDescription']);
			}

			if(isset($_POST['btnSave']))
			{
				# Get the input data from the form
				$inpName = $_POST['inpName'];
				$inpDesc = $_POST['inpDesc'];

				# Execute the update query
				$sql_update = $con->prepare("UPDATE projects SET projectName = ?, projectDescription = ? WHERE projectID = ?");
				$sql_update->bind_param("ssi", $inpName, $inpDesc, $requestID);
				$sql_update->execute();

				$txtEvent = "Updated record #". $requestID . " of projects from '" . $projectName . "' to '" . $inpName . "'";
				logEvent($con, $accID, $txtEvent);

				$msgDisplay = successAlert("Successfully udpated the record!");

				header('refresh: 1; url=add_proj.php');
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
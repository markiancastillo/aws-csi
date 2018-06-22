<?php
	$pageTitle = "Edit Environment";
	include_once 'includes/header.php';

	if(isset($_GET['id']))
	{
		$requestID = $_GET['id'];

		# Validate that the requested ID exists
		$sql_validate = "SELECT envID FROM environments WHERE envID = $requestID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

		if(mysqli_num_rows($result_validate) == 0)
		{
			# No records match
			header('location: error.php');
		}
		else
		{
			# Display the current value of the name 
			$sql_display = "SELECT envID, envName FROM environments WHERE envID = $requestID";
			$result_display = $con->query($sql_display) or die(mysqli_error($con));

			while($rd = mysqli_fetch_array($result_display))
			{
				$envName = htmlspecialchars($rd['envName']);
			}

			if(isset($_POST['btnSave']))
			{
				# Get the input data from the form
				$inpName = $_POST['inpName'];

				# Execute the update query
				$sql_update = $con->prepare("UPDATE environments SET envName = ? WHERE envID = ?");
				$sql_update->bind_param("si", $inpName, $requestID);
				$sql_update->execute();

				$msgDisplay = successAlert("Successfully udpated the record!");

				header('refresh: 1; url=add_env.php');
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
<?php
	$pageTitle = "Edit Cost Savings Type";
	include_once 'includes/header.php';

	if(isset($_GET['id']))
	{
		$requestID = $_GET['id'];

		# Validate that the requested ID exists
		$sql_validate = "SELECT typeID FROM savingtypes WHERE typeID = $requestID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

		if(mysqli_num_rows($result_validate) == 0)
		{
			# No records match
			header('location: error.php');
		}
		else
		{
			# Display the current value
			$sql_display = "SELECT typeID, typeName FROM savingtypes WHERE typeID = $requestID";
			$result_display = $con->query($sql_display) or die(mysqli_error($con));

			while($rd = mysqli_fetch_array($result_display))
			{
				$typeName = htmlspecialchars($rd['typeName']);
			}

			if(isset($_POST['btnSave']))
			{
				# Get the input data from the form
				$inpName = $_POST['inpName'];

				# Execute the update query
				$sql_update = $con->prepare("UPDATE savingtypes SET typeName = ? WHERE typeID = ?");
				$sql_update->bind_param("si", $inpName, $requestID);
				$sql_update->execute();

				$msgDisplay = successAlert("Successfully udpated the record!");

				header('refresh: 1; url=add_type.php');
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
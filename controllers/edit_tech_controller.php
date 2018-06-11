<?php
	$pageTitle = "Edit Technology";
	include_once 'includes/header.php';

	if(isset($_GET['id']))
	{
		#validate that a request id is set
		$requestID = $_GET['id'];
		#then validate that the requested input exists
		$sql_validate = "SELECT techID FROM technologies WHERE techID = $requestID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

		if(mysqli_num_rows($result_validate) == 0)
		{
			#no records match
			header('location: error.php');
		}
		else
		{
			#display the current value of the name 
			$sql_display = "SELECT techID, techName FROM technologies WHERE techID = $requestID";
			$result_display = $con->query($sql_display) or die(mysqli_error($con));

			while($rd = mysqli_fetch_array($result_display))
			{
				$techName = htmlspecialchars($rd['techName']);
			}

			if(isset($_POST['btnSave']))
			{
				#get the input data from the form
				$inpName = $_POST['inpName'];

				#query the update 
				$sql_update = $con->prepare("UPDATE technologies SET techName = ? WHERE techID = ?");
				$sql_update->bind_param("si", $inpName, $requestID);
				$sql_update->execute();

				$msgDisplay = successAlert("Successfully udpated the record!");

				header('refresh: 1; url=add_tech.php');
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
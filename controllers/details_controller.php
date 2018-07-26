<?php
	$pageTitle = "Record Details";
	ini_set('display_errors', 0);
	$readonly = "";
	$msgDisplay = "";
	
	# For the ability to make use of the functions as well as connect to the database
	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
   	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');
	if(isset($_GET['rid']))
	{
		# Bind the get value
		$recordID = $_GET['rid'];

		# Validate that the ID exists in the records
		$sql_validate = $con->prepare("SELECT csID FROM costsavings WHERE csID = ?");
		$sql_validate->bind_param("i", $recordID);
		$sql_validate->execute();

		$result_validate = $sql_validate->get_result();

		if(mysqli_num_rows($result_validate) == 0)
		{
			# The record does not exist - show error
			header('location: error.php');
		}
		else
		{
			# The record exists; get the record information
			$sql_record = $con->prepare("SELECT j.teamName, v.envName, h.techName, y.typeName, u.userFN, u.userLN, c.userID,  csDate, csCause, csSteps, csInitial, csFinal, csSavings FROM costsavings c
							INNER JOIN journeyteams j ON c.teamID = j.teamID 
							INNER JOIN environments v ON c.envID = v.envID
							INNER JOIN technologies h ON c.techID = h.techID
							INNER JOIN savingtypes y ON c.typeID = y.typeID 
							INNER JOIN users u ON c.userID = u.userID 
							WHERE csID = ?");
			$sql_record->bind_param("i", $recordID);
			$sql_record->execute() or die(mysqli_error($con));

			$result_record = $sql_record->get_result();

			while($row = mysqli_fetch_array($result_record))
			{
				$teamName = htmlspecialchars($row['teamName']);
				$envName = htmlspecialchars($row['envName']);
				$techName = htmlspecialchars($row['techName']);
				$typeName = htmlspecialchars($row['typeName']);
				$csDate = htmlspecialchars($row['csDate']);
				$userID = htmlspecialchars($row['userID']);
				$userName = htmlspecialchars($row['userFN']) . ' ' . htmlspecialchars($row['userLN']);
				$csCause = htmlspecialchars($row['csCause']);
				$csSteps = htmlspecialchars($row['csSteps']);
				$csInitial = htmlspecialchars($row['csInitial']);
				$csFinal = htmlspecialchars($row['csFinal']);
				$csSavings = htmlspecialchars($row['csSavings']);
			}

			# These values will be passed to the header.php for use in the meta tags
			# Change the displayed format for the date field
			$displayDate = date('m/d/Y', strtotime($csDate));
			# This is used by Slack as a default title for the share text
			$metaTitle = $userName . " of Team " . $teamName . " applied the solution: '" . $csSteps . "' on " . $techName . " and saved a total of $" . $csSavings . ". Click on the link to view the details.";
			# This is used by Facebook as its default title in the share card/link
			$metaDescription = $userName . " implemented '" . $csSteps . "' and saved a total of USD " . $csSavings . ". Click the link to view the details.";
			
			if(isset($_GET['viewonly']))
			{
				include_once 'includes/header_viewonly.php';
			}
			else
			{
				# Load the regular header
				# This is loaded after the sql statements so data can be properly passed to the meta tags
				# (used for the default sharing message)
				include_once 'includes/header.php';
			}	

			# Get the userID of the record. If it matches the session ID, enable editing
			if($userID == $accID)
			{
				# Show the update button
				$showButton = "";

				# If the update button is pressed...
				if(isset($_POST['btnUpdate']))
				{
					# Get the input values from the form
					$inpCause = mysqli_real_escape_string($con, $_POST['inpCause']);
					$inpSteps = mysqli_real_escape_string($con, $_POST['inpSteps']);
					$inpInitial = str_replace(",", "", mysqli_real_escape_string($con, $_POST['inpInitial']));
					$inpFinal = str_replace(",", "", mysqli_real_escape_string($con, $_POST['inpFinal']));
					$totSavings = $inpInitial - $inpFinal;

					# Validation: input for the problem and solution textarea fields must not be empty or all whitespace
					if(empty(trim($inpCause)) || empty(trim($inpSteps)))
					{
						$msgDisplay = errorAlert("Input for the problem and/or solution must not be empty.");
					}
					else
					{
						# Update the record with the input
						$sql_update = $con->prepare("UPDATE costsavings SET csCause = ?, csSteps = ?, csInitial = ?, csFinal = ?, csSavings = ? WHERE csID = ?");
						$sql_update->bind_param("ssdddi", $inpCause, $inpSteps, $inpInitial, $inpFinal, $totSavings, $recordID);
						$sql_update->execute() or die(mysqli_error($con));
						$txtEvent = "Updated the information of cost savings record #" . $recordID;
						logEvent($con, $accID, $txtEvent);

						$msgDisplay = successAlert("Successfully updated the record.");
						header('refresh: 1');
					}
				}
			}
			else
			{
				# Set the readonly property to the input fields
				$readonly = "readonly";

				# Hide the update button
				$showButton = "style='display: none;'";

				if(isset($_POST['btnUpdate']))
				{
					$msgDisplay = errorAlert("You are not allowed to perform any changes on this record.");
				}
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
<?php
	$pageTitle = "Record Details";
	

	if(isset($_GET['viewonly']))
	{
		# Loads the css and js but without the navbar
		include 'controllers/includes/header_viewonly.php';
	}
	else 
	{
		include_once 'includes/header.php';
	}

	if(isset($_GET['rid']))
	{
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
			# Get the record information
			$sql_record = $con->prepare("SELECT j.teamName, v.envName, h.techName, y.typeName, csDate, csActor, csCause, csSteps, csInitial, csFinal, csSavings FROM costsavings c
							INNER JOIN journeyteams j ON c.teamID = j.teamID 
							INNER JOIN environments v ON c.envID = v.envID
							INNER JOIN technologies h ON c.techID = h.techID
							INNER JOIN savingtypes y ON c.typeID = y.typeID 
							WHERE csID = ?");
			$sql_record->bind_param("i", $recordID);
			$sql_record->execute();

			$result_record = $sql_record->get_result();

			while($row = mysqli_fetch_array($result_record))
			{
				$teamName = $row['teamName'];
				$envName = $row['envName'];
				$techName = $row['techName'];
				$typeName = $row['typeName'];
				$csDate = $row['csDate'];
				$csActor = $row['csActor'];
				$csCause = $row['csCause'];
				$csSteps = $row['csSteps'];
				$csInitial = $row['csInitial'];
				$csFinal = $row['csFinal'];
				$csSavings = $row['csSavings'];
			}

			# Change the displayed format for the date field
			$displayDate = date('m/d/Y', strtotime($csDate));

			# Assumption: input for the cost savings form involves a complete set of data
			# Details currently set on view only. Updating is not a feature (yet)
		}
	}
	else
	{
		header('location: error.php');
	}
?>
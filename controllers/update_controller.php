<?php
	$pageTitle = "Update Record";
	include 'includes/header.php';

	# Validate the record being requested:
	# If the id doesnt exist, show an error
	if(isset($_GET['rid']))
	{
		$requestedID = $_GET['rid'];

		# Query: check that the ID exists
		$sql_validate = "SELECT csID FROM costsavings WHERE csID = $requestedID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));
	
		if(mysqli_num_rows($result_validate) == 0)
		{
			# Requested ID does not exist; redirect to the error page
			header('location: error.php');
		}
		else
		{
			# Query: get the values for the fields with the requested ID
			$sql_values = "SELECT csID, csCause, csSteps, csActor, csDate, csSavings, csInitial, csFinal, teamID, techID, envID, typeID FROM costsavings WHERE csID = $requestedID";
			$result_values = $con->query($sql_values) or die(mysqli_error($con));
	
			while($row = mysqli_fetch_array($result_values))
			{
				$csCause = $row['csCause'];
				$csSteps = $row['csSteps'];
				$csActor = $row['csActor'];
				$csDate = $row['csDate'];
				$csSavings = $row['csSavings'];
				$csInitial = $row['csInitial'];
				$csFinal = $row['csFinal'];
				$selTeam = $row['teamID'];
				$selTech = $row['techID'];
				$selEnv = $row['envID'];
				$selType = $row['typeID'];
			}

			$displayDate = new DateTime(date('Y-m-d', strtotime($csDate)));
	
			# SQL query for the journey teams dropdown list
			$sql_teams = "SELECT teamID, teamName FROM journeyteams";
			$result_teams = $con->query($sql_teams) or die(mysqli_error($con));
		
			$list_teams = "";
			while($rowt = mysqli_fetch_array($result_teams))
			{
				$teamID = htmlspecialchars($rowt['teamID']);
				$teamName = htmlspecialchars($rowt['teamName']);
				
				$selectedTeam = $teamID == $selTeam ? "selected" : "";
				$list_teams .= "<option value='$teamID' $selectedTeam>$teamName</option>";
			}
		
			# SQL query for the devops technology dropdown list
			$sql_tech = "SELECT techID, techName FROM technologies";
			$result_tech = $con->query($sql_tech) or die(mysqli_error($con));
		
			$list_tech = "";
			while($rowh = mysqli_fetch_array($result_tech))
			{
				$techID = htmlspecialchars($rowh['techID']);
				$techName = htmlspecialchars($rowh['techName']);
			
				$selectedTech = $techID == $selTech ? "selected" : "";
				$list_tech .= "<option value='$techID' $selectedTech>$techName</option>";
			}
		
			# SQL query for the environments dropdown list
			$sql_env = "SELECT envID, envName FROM environments";
			$result_env = $con->query($sql_env) or die(mysqli_error($con));
		
			$list_env = "";
			while($rowv = mysqli_fetch_array($result_env))
			{
				$envID = htmlspecialchars($rowv['envID']);
				$envName = htmlspecialchars($rowv['envName']);
				
				$selectedEnv = $envID == $selEnv ? "selected" : "";
				$list_env .= "<option value='$envID' $selectedEnv>$envName</option>";
			}
		
			# SQL query for the cost savings type dropdown list
			$sql_type = "SELECT typeID, typeName FROM savingtypes";
			$result_type = $con->query($sql_type) or die(mysqli_error($con));
		
			$list_type = "";
			while($rowy = mysqli_fetch_array($result_type))
			{
				$typeID = htmlspecialchars($rowy['typeID']);
				$typeName = htmlspecialchars($rowy['typeName']);
				
				$selectedType = $typeID == $selType ? "selected" : "";
				$list_type .= "<option value='$typeID' $selectedType>$typeName</option>";
			}
		}
	}
	else
	{
		# The record being requested (via url) does not exist
		header('location: error.php');
	}
?>
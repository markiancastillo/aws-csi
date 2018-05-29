<?php
	$pageTitle = "Update Record";
	include 'includes/header.php';

	#validate the record being requested:
	#if the id doesnt exist, show an error
	if(isset($_GET['rid']))
	{
		$requestedID = $_GET['rid'];

		#query: check that the ID exists
		$sql_validate = "SELECT csID FROM costsavings WHERE csID = $requestedID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));
	
		if(mysqli_num_rows($result_validate) == 0)
		{
			#requested ID is non-existent; redirect to the error page
			header('location: error.php');
		}
		else
		{
			#query: get the values for the fields with the requested ID
			$sql_values = "SELECT csDesc, csActor, csDate, csSavings, csInitial, csFinal, teamID, techID, envID, typeID FROM costsavings WHERE csID = $requestedID";
			$result_values = $con->query($sql_values) or die(mysqli_error($con));
	
			while($row = mysqli_fetch_array($result_values))
			{
				$csDesc = $row['csDesc'];
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
	
			#data for journey teams ddl
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
		
			#data for devops technology ddl
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
		
			#data for environment ddl
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
		
			#data for savings type ddl
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


			if(isset($_POST['btnSubmit']))
			{
				if(!isset($_FILES['inpPhoto']) || $_FILES['inpPhoto']['error'])
				{
					#image is not set in the form
					#display an error
				}
				else
				{
					#validate the image (file must be an image file type)
					#accepted files: ???
					
					$imgName = $_FILES['inpPhoto']['name'];
					$imgDir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . "/images/";
					$imgNew = date('YmdHis') . "_" . basename($imgName);
					$imgFile = $imgDir . $imgNew;
	
					move_uploaded_file($_FILES['inpPhoto']['tmp_name'], $imgFile);
		
					#update the data of the record
					$stmt_update = $con->prepare("UPDATE costsavings SET csFinal = ? WHERE csID = ?");
					$stmt_update->bind_param("si", $imgNew, $requestedID);
	
					$stmt_update->execute() or die(mysqli_error($con));
	
					header('location: view.php');
				}
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
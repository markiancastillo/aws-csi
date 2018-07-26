<?php
	$pageTitle = "My Account"; 
	include_once 'includes/header.php';

	ini_set('display_errors', 0);
	$userID = getUserID($con, $accID);
	$selected = "";
	$msgDisplay = "";

	# Get the data for the recent entries for the current user 
	$sql_recent = $con->prepare("SELECT s.csID, s.csCause, s.csSteps, s.csDate, s.csSavings, s.csInitial, s.csFinal, m.teamName, h.techName, e.envName, y.typeName
				 FROM costsavings s 
				 INNER JOIN journeyteams m ON s.teamID = m.teamID 
				 INNER JOIN technologies h ON s.techID = h.techID 
				 INNER JOIN environments e ON s.envID = e.envID 
				 INNER JOIN savingtypes y ON s.typeID = y.typeID
				 WHERE s.userID = ? 
				 ORDER BY s.csDate DESC");
	$sql_recent->bind_param("i", $accID);
	$sql_recent->execute();

	$result_recent = $sql_recent->get_result();

    # Display the results in a table format
	$list_records = "";
	while($row = mysqli_fetch_array($result_recent))
	{
		$csID = htmlspecialchars($row['csID']);
		$csCause = htmlspecialchars($row['csCause']);
		$csSteps = htmlspecialchars($row['csSteps']);
		$csDate = htmlspecialchars($row['csDate']);
		$displayDate = date('m/d/Y', strtotime($csDate));
		$csSavings = htmlspecialchars($row['csSavings']);
		$csInitial = htmlspecialchars($row['csInitial']);
		$csFinal = htmlspecialchars($row['csFinal']);
		$teamName = htmlspecialchars($row['teamName']);
		$techName = htmlspecialchars($row['techName']);
		$envName = htmlspecialchars($row['envName']);
		$typeName = htmlspecialchars($row['typeName']);

		$list_records .= "
		<tr class='clickable-row' data-href='details.php?rid=$csID' style='cursor: pointer;'>
			<td>$displayDate</td>
            <td>$teamName</td>
            <td>$techName</td>
            <td>$envName</td>
            <td>$typeName</td>
            <td>
                <span class='float-left'>$</span>
                <span class='float-right'>$csInitial</span>
            </td>
            <td>$csSteps</td>
            <td>
                <span class='float-left'>$</span>
                <span class='float-right'>$csFinal</span>
            </td>
            <td>
                <span class='float-left'>$</span>
                <span class='float-right'>$csSavings</span>
            </td>
        </tr>";
    }

    # Get the default values for the dropdowns
    $sql_default = $con->prepare("SELECT envID, teamID, techID FROM users WHERE userID = ?");
    $sql_default->bind_param("i", $userID);
    $sql_default->execute();

    $result_default = $sql_default->get_result();

    while ($row = mysqli_fetch_array($result_default)) 
    {
    	# Get the values...
    	$def_envID = $row['envID'];
    	$def_teamID = $row['teamID'];
    	$def_techID = $row['techID'];
    }

	# Code for saving/updating the dropdown values
    if(isset($_POST['btnSave']))
    {	
    	# Get the value from the form (set default to 0 if there is no input)
    	$inpTeam = htmlspecialchars($_POST['inpTeam']);
    	if(empty($inpTeam)) { $inpTeam = 0;	}

    	$inpEnv = htmlspecialchars($_POST['inpEnv']);
    	if(empty($inpEnv)) { $inpEnv = 0; }

    	$inpTech = htmlspecialchars($_POST['inpTech']);
    	if(empty($inpTech)) { $inpTech = 0; }

    	# Update the values in the database
    	$sql_update = $con->prepare("UPDATE users SET envID = ?, teamID = ?, techID = ? WHERE userID = ?");
    	$sql_update->bind_param("iiii", $inpEnv, $inpTeam, $inpTech, $userID);
    	$sql_update->execute();

    	$txtEvent = "Updated their account information.";
    	logEvent($con, $accID, $txtEvent);

		$msgDisplay = successAlert("You have successfully updated your account information.");
		header('refresh: 1');
    }
?>
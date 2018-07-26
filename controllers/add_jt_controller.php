<?php
	$pageTitle = 'Journey Teams';
	include_once 'includes/header.php';

	# Echoes a redirect line if the user does not have access to the page
	accessPage($con, $accID);

	# Query for displaying the existing journey teams
	$sql_list = "SELECT teamID, teamName FROM journeyteams";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$list_teams = "";

	if(mysqli_num_rows($result_list) == 0)
	{

	}
	else 
	{
		# Display the records in a table format
		while($teams = mysqli_fetch_array($result_list))
		{
			$teamID = $teams['teamID'];
			$teamName = htmlspecialchars($teams['teamName']);
	
			$list_teams .= "
				<tr>
					<td>$teamName <a href='edit_jt.php?id=$teamID' class='float-right'><span class='fa fa-edit fa-fw'></span></a></td>
				</tr>";
		}
	}

	if(isset($_POST['btnAdd']))
	{
		# Validate the input
		$inpName = inpcheck($_POST['inpName']);

		if(empty($inpName))
		{
			$msgDisplay = errorAlert("Please make sure that your input is valid and try again.");
		}
		else
		{
			# Convert the input into upper string for validation
			$tName = strtoupper($inpName);
			
			# Validate that the input is not a duplicate
			$sql_validate = "SELECT teamName FROM journeyteams WHERE UPPER(teamName) = '$tName'";
			$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

			if(mysqli_num_rows($result_validate) > 0)
			{
				$msgDisplay = errorAlert("The team you are adding already exists.");
			}
			else
			{
				$stmt_insert = $con->prepare("INSERT INTO journeyteams (teamName) VALUES (?)");
				$stmt_insert->bind_param("s", $inpName);
				$stmt_insert->execute();

				$txtEvent = "Added a new journey team: " . $inpName;
				logEvent($con, $accID, $txtEvent);

				$msgDisplay = successAlert("Successfully added a new team.");

				header('Refresh: 1');
			}
		}
	}
?>
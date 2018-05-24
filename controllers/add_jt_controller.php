<?php
	$pageTitle = 'Journey Teams';
	include_once 'includes/header.php';

	#query for displaying the existing journey teams
	$sql_list = "SELECT teamName FROM journeyteams";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$list_teams = "";

	if(mysqli_num_rows($result_list) == 0)
	{

	}
	else 
	{
		while($teams = mysqli_fetch_array($result_list))
		{
			$teamName = htmlspecialchars($teams['teamName']);
	
			$list_teams .= "
				<tr>
					<td>$teamName</td>
				</tr>";
		}
	}

	if(isset($_POST['btnAdd']))
	{
		#validate that the input is valid
		$inpName = inpcheck($_POST['inpName']);

		if(empty($inpName))
		{
			$msgDisplay = errorAlert("Please make sure that your input is valid and try again.");
		}
		else
		{
			$tName = strtoupper($inpName);
			
			#validate that the journey team being added is not a duplicate
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

				$msgDisplay = successAlert("Successfully added a new team.");

				header('Refresh: 1');
			}
		}
	}
?>
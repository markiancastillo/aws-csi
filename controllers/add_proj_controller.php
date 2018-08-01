<?php
	$pageTitle = "Projects";
	include 'includes/header.php';

	# Echoes a redirect line if the user does not have access to the page
	accessPage($con, $accID);

	# Query for displaying the records
	$sql_list = "SELECT projectID, projectName, projectDescription FROM projects";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$list_proj = "";
	if(mysqli_num_rows($result_list) == 0)
	{
		#$list_env .= "
		#	<tr>
		#		<td class='text-center'>There are no records to display.</td>
		#	</tr>";
	}
	else
	{
		# Display the result in a table format
		while($row = mysqli_fetch_array($result_list))
		{
			$projID = $row['projectID'];
			$projName = htmlspecialchars($row['projectName']);
			$projDescription = htmlspecialchars($row['projectDescription']);

			$list_proj .= "
				<tr>
					<td>$projName</td>
					<td>$projDescription</td>
					<td>
						<a href='edit_proj.php?id=$projID' class='btn btn-outline-link btn-sm float-right'>
							<span class='fa fa-edit fa-fw'></span>
						</a>
					</td>
				</tr>";
		}
	}

	if(isset($_POST['btnAdd']))
	{
		# Get the input from the form
		$inpName = inpcheck($_POST['inpName']);
		$inpDesc = htmlspecialchars($_POST['inpDesc']);

		# Validate that the input is not empty
		if(empty($inpName))
		{
			$msgDisplay = errorAlert("Please make sure that your input is valid and try again.");
		}
		else
		{
			# convert the input value to uppercase for validation
			$tName = strtoupper($inpName);

			# Validate that the record being added doesnt already exist
			$sql_validate = "SELECT projectName FROM projects WHERE UPPER(projectName) = '$tName'";
			$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

			if(mysqli_num_rows($result_validate) > 0)
			{
				$msgDisplay = errorAlert("The record you are trying to add already exists.");
			}
			else
			{
				# Insert the record with default status set to '1' for an 'Active' status
				$stmt_insert = $con->prepare("INSERT INTO projects (projectName, projectDescription, projectStatus) VALUES (?, ?, 1)");
				$stmt_insert->bind_param("ss", $inpName, $inpDesc);
				$stmt_insert->execute();

				$txtEvent = "Added a new project: " . $inpName;
				logEvent($con, $accID, $txtEvent);

				$msgDisplay = successAlert("Successfully added a new record.");

				header('Refresh: 1');
			}
		}
	}
?>
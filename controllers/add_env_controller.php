<?php
	$pageTitle = "Environments";
	include 'includes/header.php';

	# Echoes a redirect line if the user does not have access to the page
	accessPage($con, $accID);

	# Query for displaying the records
	$sql_list = "SELECT envID, envName FROM environments";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$list_env = "";
	if(mysqli_num_rows($result_list) == 0)
	{
		#$list_env .= "
		#	<tr>
		#		<td class='text-center'>There are no records to display.</td>
		#	</tr>";
	}
	else
	{
		while($row = mysqli_fetch_array($result_list))
		{
			$envID = $row['envID'];
			$envName = htmlspecialchars($row['envName']);

			$list_env .= "
				<tr>
					<td>$envName 
						<a href='edit_env.php?id=$envID' class='btn btn-outline-link btn-sm float-right'>
							<span class='fa fa-edit fa-fw'></span>
						</a>
					</td>
				</tr>";
		}
	}

	if(isset($_POST['btnAdd']))
	{
		$inpName = inpcheck($_POST['inpName']);

		if(empty($inpName))
		{
			$msgDisplay = errorAlert("Please make sure that your input is valid and try again.");
		}
		else
		{
			$tName = strtoupper($inpName);

			# Validate that the record being added doesnt already exist
			$sql_validate = "SELECT envName FROM environments WHERE UPPER(envName) = '$tName'";
			$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

			if(mysqli_num_rows($result_validate) > 0)
			{
				$msgDisplay = errorAlert("The record you are trying to add already exists.");
			}
			else
			{
				$stmt_insert = $con->prepare("INSERT INTO environments (envName) VALUES (?)");
				$stmt_insert->bind_param("s", $inpName);
				$stmt_insert->execute();

				$txtEvent = "Added a new environment: " . $inpName;
				logEvent($con, $accID, $txtEvent);

				$msgDisplay = successAlert("Successfully added a new record.");

				header('Refresh: 1');
			}
		}
	}
?>
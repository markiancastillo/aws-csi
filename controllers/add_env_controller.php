<?php
	$pageTitle = "Environments";
	include 'includes/header.php';

	#query for displaying the records
	$sql_list = "SELECT envName FROM environments";
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
			$envName = htmlspecialchars($row['envName']);

			$list_env .= "
				<tr>
					<td>$envName</td>
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

			#validate that the record being added doesnt already exist
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

				$msgDisplay = successAlert("Successfully added a new record.");

				header('Refresh: 1');
			}
		}
	}
?>
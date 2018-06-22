<?php
	$pageTitle = "Cost Savings Types";
	include_once 'includes/header.php';

	# Query to display records
	$sql_list = "SELECT typeID, typeName FROM savingtypes";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$list_types = "";
	if(mysqli_num_rows($result_list) == 0)
	{

	}
	else
	{
		while($row = mysqli_fetch_array($result_list))
		{
			$typeID = $row['typeID'];
			$typeName = htmlspecialchars($row['typeName']);

			$list_types .= "
				<tr>
					<td>$typeName <a href='edit_type.php?id=$typeID' class='float-right'><span class='fa fa-edit fa-fw'></span></a></td>
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

			# Validate duplication of records
			$sql_validate = "SELECT typeName FROM savingtypes WHERE UPPER(typeName) = '$tName'";
			$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

			if(mysqli_num_rows($result_validate) > 0)
			{
				$msgDisplay = errorAlert("The team you are adding already exists.");
			}
			else
			{
				$stmt_insert = $con->prepare("INSERT INTO savingtypes (typeName) VALUES (?)");
				$stmt_insert->bind_param("s", $inpName);
				$stmt_insert->execute();

				$msgDisplay = successAlert("Successfully added a new savings type.");

				header('Refresh: 1');
			}
		}
	}
?>
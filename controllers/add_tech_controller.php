<?php
	$pageTitle = "AWS/DevOps Technologies";
	include_once 'includes/header.php';

	#query to get the records
	$sql_list = "SELECT techID, techName FROM technologies";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$list_tech = "";
	if(mysqli_num_rows($result_list) == 0)
	{

	}
	else
	{
		while($row = mysqli_fetch_array($result_list))
		{
			$techID = $row['techID'];
			$techName = htmlspecialchars($row['techName']);

			$list_tech .= "
				<tr>
					<td>$techName <a href='edit_tech.php?id=$techID' class='float-right'><span class='fa fa-edit fa-fw'></span></a></td>
				</tr>";
		}
	}
	
	if(isset($_POST['btnAdd']))
	{
		$inpName = inpcheck($_POST['inpName']);

		if(empty($inpName))
		{
			$msgDisplay = errorAlert("Please make sure that your input is valid.");
		}
		else
		{
			$tName = strtoupper($inpName);
			$sql_validate = "SELECT techName FROM technologies WHERE UPPER(techName) = '$tName'";
			$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

			if(mysqli_num_rows($result_validate) > 0)
			{
				$msgDisplay = errorAlert("The record you are trying to add already exists.");
			}
			else
			{
				$stmt_insert = $con->prepare("INSERT INTO technologies(techName) VALUES (?)");
				$stmt_insert->bind_param("s", $inpName);
				$stmt_insert->execute();
	
				$msgDisplay = successAlert("Successfully added a new record.");
	
				header('Refresh: 1');
			}
		}
	}
?>
<?php
	$pageTitle = "Manage Access";
	include 'includes/header.php';

	# Determine if the current user has access to the page
	# If not, redirect to the home page
	$allowAccess = allowAccess($con, $accID);
	if($allowAccess != 1)
	{
		header('location: error.php');
	}

	# Query the records in the database
	$sql_users = "SELECT a.accountID, u.userFN, u.userLN, a.accountStatus, s.accessRole FROM accounts a 
				  INNER JOIN users u ON a.userID = u.userID
				  INNER JOIN access s ON a.accountAccess = s.accessID";
	$result_users = $con->query($sql_users) or die(mysqli_error($con));

	$list_users = "";
	while($row = mysqli_fetch_array($result_users))
	{
		$accountID = $row['accountID'];
		$userFN = $row['userFN'];
		$userLN = $row['userLN'];
		$userName = $userFN . ' ' . $userLN;
		$accessRole = $row['accessRole'];
		$def_status = $row['accountStatus'];

		$statusText = listStatus($con, $def_status);

		$list_users .= "
			<tr>
				<td class='text-center'>$userName</td>
				<td class='text-center'>$accessRole</td>
				<td class='text-center'>$statusText</td>
				<td class='text-center'>
					<a href='user.php?uid=$accountID' class='float-right'>
						<i class='fa fa-edit fa-fw'></i>
					</a>
				</td>
			</tr>
		";
	}
?>
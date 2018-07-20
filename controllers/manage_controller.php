<?php
	$pageTitle = "Manage Access";
	include 'includes/header.php';

	# Query the records in the database
	$sql_users = "SELECT u.userFN, u.userLN, a.accountAccess, a.accountStatus FROM accounts a 
				  INNER JOIN users u ON a.userID = u.userID";
	$result_users = $con->query($sql_users) or die(mysqli_error($con));

	$list_users = "";
	while($row = mysqli_fetch_array($result_users))
	{
		$userFN = $row['userFN'];
		$userLN = $row['userLN'];
		$userName = $userFN . ' ' . $userLN;
		$accountAccess = $row['accountAccess'];
		$accountStatus = $row['accountStatus'];

		# (remove hardcoding by adding a database table or something...)
		switch ($accountStatus) 
		{
			case 0:
				$statusText = "Inactive/Archived";
				break;
			case 1: 
				$statusText = "Active";
				break;
			case 2:
				$statusText = "Pending";
				break;
			default:
				$statusText = "Undetermined";
				break;
		}

		switch ($accountAccess) 
		{
			case 1: 
				$accessText = "Administrator";
				break;
			case 2:
				$accessText = "User (Elevated)";
				break;
			case 3: 
				$accessText = "User";
				break;
			default:
				$accessText = "Undetermined";
				break;
		}

		$list_users .= "
			<tr>
				<td class='text-center'>$userName</td>
				<td class='text-center'>$accessText</td>
				<td class='text-center'>$statusText</td>
				<td class='text-center'>
					<a href='user.php?uid=999' class='float-right'>
						<i class='fa fa-edit fa-fw'></i>
					</a>
				</td>
			</tr>
		";
	}
?>
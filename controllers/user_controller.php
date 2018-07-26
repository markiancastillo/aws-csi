<?php 
	$pageTitle = "Edit Access";
	include_once 'includes/header.php';
	$msgDisplay = "";

	# Determine if the current user has access to the page
	# If not, redirect to the home page
	$allowAccess = allowAccess($con, $accID);
	if($allowAccess != 1)
	{
		header('location: error.php');
	}

	# Check if the user id parameter has been passed
	if(isset($_GET['uid']))
	{
		$uid = $_GET['uid'];

		# Validate that the uid value is valid/existing
		$sql_validate = $con->prepare("SELECT userID FROM users WHERE userID = ?");
		$sql_validate->bind_param("i", $uid);
		$sql_validate->execute();

		$result_validate = $sql_validate->get_result();

		if(mysqli_num_rows($result_validate) == 0)
		{
			# No record with the requested ID exists
			header('location: error.php');
		}
		else
		{
			# Get the display name 
			$sql_name = $con->prepare("SELECT userFN, userLN FROM users WHERE userID = ?");
			$sql_name->bind_param("i", $uid);
			$sql_name->execute();

			$result_name = $sql_name->get_result();

			while($acn = mysqli_fetch_array($result_name))
			{
				$userFN = $acn['userFN'];
				$userLN = $acn['userLN'];
				$userName = $userFN . ' ' . $userLN;
			}

			# Get the data for the team, env, and tech
/*			$sql_details = $con->prepare("SELECT v.envName, m.teamName, t.techName FROM users u 
										  INNER JOIN environments v ON u.envID = v.envID 
										  INNER JOIN journeyteams m ON u.teamID = m.teamID 
										  INNER JOIN technologies t ON u.techID = t.techID 
										  WHERE userID = ?");
			$sql_details->bind_param("i", $uid);
			$sql_details->execute();

			$result_details = $sql_details->get_result();

			while($row = mysqli_fetch_array($result_details))
			{
				$envName = $row['envName'];
				$teamName = $row['teamName'];
				$techName = $row['techName'];
			}
*/
			# Get the account status and access
			$sql_account = $con->prepare("SELECT accountAccess, accountStatus FROM accounts WHERE userID = ?");
			$sql_account->bind_param("i", $uid);
			$sql_account->execute();

			$result_account = $sql_account->get_result();

			# Get the user's data for account status and access
			while($act = mysqli_fetch_array($result_account))
			{
				$def_status = $act['accountStatus'];
				$def_access = $act['accountAccess'];
			}

			# Change the button being displayed depending on the account status value
			# (Display 'Archive' for active accounts, 'Activate' for archived accounts)
			$displayButton = "";
			if($def_status == 0)
			{
				# Account is inactive/disabled; display 'Activate' button instead
				$displayButton = "<button class='btn btn-success float-right' data-toggle='modal' data-target='#activateModal' id='btnActive' name='btnActive'>Activate Account</button>";
			}
			else
			{
				# Account is active; display 'Archive' (also as default display)
				$displayButton = "<button class='btn btn-danger float-right' data-toggle='modal' data-target='#archiveModal' id='btnModal' name='btnModal'>Archive Account</button>";
			}

			# Save the changes on the access level on button press
			if(isset($_POST['btnSave']))
			{
				# Get the access level value
				$inpAccess = $_POST['inpAccess'];

				# Update the value in the database
				$sql_update = $con->prepare("UPDATE accounts SET accountAccess = ? WHERE userID = ?");
				$sql_update->bind_param("ii", $inpAccess, $uid);
				$sql_update->execute() or die(msqli_error($con));

				$txtEvent = "Changed the access level of " . $userName . " from " . $def_access . " to " . $inpAccess;
				logEvent($con, $accID, $txtEvent);

				$msgText = "Successfully updated the access level.";
				$msgDisplay = successAlert($msgText);
				header('refresh: 1');
			}

			# Password re-entry verification on archiving of account
			if(isset($_POST['btnArchive']))
			{
				# Get the input password
				$inpPassword = $_POST['inpConfirm'];

				# Verify that the input and stored values are the same
				if(confirmPassword($con, $accID, $inpPassword) == 1) 
				{
					# Update the account's status value to 0 (inactive/archived)
					$sql_archive = $con->prepare("UPDATE accounts SET accountStatus = 0 WHERE userID = ?");
					$sql_archive->bind_param("i", $uid);
					$sql_archive->execute();

					$txtEvent = "Archived " . $userName . "'s account (account ID #" . $uid . ")";
					logEvent($con, $accID, $txtEvent);

					$msgText = "Successfully archived the account.";
					$msgDisplay = successAlert($msgText);
					header('refresh: 1');
				} 
				else 
				{
					$msgText = "Your password input is incorrect.";
					$msgDisplay = errorAlert($msgText);
				}
			}

			# Password re-entry verification on activating/re-activating of account
			if(isset($_POST['btnActivate']))
			{
				# Get the input password
				$inpPassword = $_POST['inpConfirm'];

				# Verify the input vs the stored
				if(confirmPassword($con, $accID, $inpPassword) == 1)
				{
					# Update the account status value to 1 (active)
					$sql_active = $con->prepare("UPDATE accounts SET accountStatus = 1 WHERE userID = ?");
					$sql_active->bind_param("i", $uid);
					$sql_active->execute();

					$txtEvent = "";
					logEvent($con, $accID, $txtEvent);

					$msgText = "Successfully activated the account.";
					$msgDisplay = successAlert($msgText);
					header('refresh: 1');
				}
				else 
				{
					$msgText = "Your password input is incorrect.";
					$msgDisplay = errorAlert($msgText);
				}
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
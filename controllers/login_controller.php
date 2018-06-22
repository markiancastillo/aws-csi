<?php 
	include('config.php');
	include('function.php');

	if(isset($_POST['btnLogin']))
	{
		/*
			Account status numbers:
			0 - inactive/deactivated, 1 - active, 2 - pending (for confirmation)
		*/

		$inpEmail = inpcheck($_POST['inpEmail']);
		$inpPassword = inpcheck($_POST['inpPassword']);

		# Validate the input: email and password fields must not be empty
		if(empty($inpEmail) || empty($inpPassword))
		{
			$msgDisplay = errorAlert("Please make sure that the entries are valid.");
		}
		else
		{
			# Query accounts with matching credentials and active status
			$sql_validate = "SELECT accountID, accountPW, accountStatus FROM accounts WHERE accountUN = '$inpEmail'";
			$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

			if(mysqli_num_rows($result_validate) == 0)
			{
				$msgDisplay = errorAlert("Incorrect email/password. Please check your input and try again.");
			}
			else
			{
				while($row = mysqli_fetch_array($result_validate))
				{
					$accountID = $row['accountID'];
					$accountPW = $row['accountPW'];
					$accountStatus = $row['accountStatus'];

					# Check the validity of the password
					if(password_verify($inpPassword, $accountPW))
					{
						# The input password is valid...
						# If the status is 0 or 2 (inactive/pending), display a message
						if($accountStatus == 1)
						{
							session_start();
							$_SESSION['accID'] = $accountID;
		
							header('location: index.php');
						}
						else if($accountStatus == 2)
						{
							# Account status is 'pending'
							$msgDisplay = warningAlert("Please check your email and verify your account before logging in.");
						}
						else if($accountStatus == 0)
						{
							# Account status is 'inactive/disabled'
						}
					}
					else
					{
						# The password is invalid
						$msgDisplay = errorAlert("The input username and/or password is incorrect. Please check your input and try again.");
					}
				}
			}
		}
	}
?>
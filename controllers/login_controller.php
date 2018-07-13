<?php 
	include('config.php');
	include('function.php');

	if(isset($_POST['btnLogin']))
	{
		/*	Account status numbers:
			0 - inactive/deactivated, 1 - active, 2 - pending (for confirmation)
		*/

		# Get the input from the form
		$inpEmail = inpcheck($_POST['inpEmail']);
		$inpPassword = inpcheck($_POST['inpPassword']);

		# Validate the input: email and password must be valid and not empty
		if(empty(trim($inpEmail)) || empty(trim($inpPassword)))
		{
			$msgDisplay = errorAlert("Please make sure that the entries are valid.");
		}
		else
		{
			# SELECT statement to get the account records from the database
			$sql_account = "SELECT accountID, accountUN, accountPW, accountStatus FROM accounts";
			$result_account = $con->query($sql_account) or die(mysqli_error($con));

			$ucount = 0;

			#Check through the database records
			while($row = mysqli_fetch_array($result_account))
			{
				# Get the information for each row
				$accountID = $row['accountID'];
				$accountUN = $row['accountUN'];
				$accountPW = $row['accountPW'];
				$accountStatus = $row['accountStatus'];

				# Compare between the input and the stored record (returns boolean)
				$compAccount = password_verify($inpEmail, $accountUN);
				$compPass = password_verify($inpPassword, $accountPW);

				# Look for the account and password that match
				if($compAccount == 1 && $compPass == 1)
				{
					# The input match the stored values
					$ucount = $ucount + 1;
					# End the loop when a match has been found
					break;
				}
			}

			# If the count is >= 1, a record has been found
			if($ucount >= 1)
			{
				if($accountStatus == 1)
				{
					session_start();
					$_SESSION['accID'] = $accountID;
					$accID = $_SESSION['accID'];

					$txtEvent = "Logged in into the system";
					logEvent($con, $accID, $txtEvent);
	
					header('location: index.php');
				}
				else if($accountStatus == 2)
				{
					# Account status is pending...
					$msgDisplay = warningAlert("Please check your email and verify your account before logging in.");
				}
				else if($accountStatus == 0)
				{
					# Account status is disabled/inavtive...
					$msgDisplay = errorAlert("Your account is currently disabled/inactive.");
				}
			}
			else
			{
				# There are no records that match the input creentials...
				$msgDisplay = errorAlert("Incorrect email/password. Please check your input and try again.");
			}
		}
	}

	/*	Account status numbers:
			0 - inactive/deactivated, 1 - active, 2 - pending (for confirmation)
	*/
?>
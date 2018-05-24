<?php  
	include('config.php');
	include('function.php');

	if(isset($_POST['btnRegister']))
	{
		#get the input data from the form
		$inpFN = inpcheck($_POST['inpFN']);
		$inpLN = inpcheck($_POST['inpLN']);
		$inpEmail = inpcheck($_POST['inpEmail']);
		$inpPW = inpcheck($_POST['inpPW']);
		$inpConfirm = inpcheck($_POST['inpConfirm']);

		#fields should have a valid input
		if(empty($inpFN) || empty($inpLN) || empty($inpEmail) || empty($inpPW))
		{
			$msgDisplay = errorAlert("Please make sure that your inputs are valid and try again.");
		}
		else
		{
			#validate that the pw and confirmpw fields match
			if(strcmp($inpPW, $inpConfirm) == 0)
			{
				#validate if the email/account exists
				$sql_validate = "SELECT accountID FROM accounts WHERE accountUN = '$inpEmail'";
				$result_validate = $con->query($sql_validate) or die(mysqli_error($con));

				if(mysqli_num_rows($result_validate) == 0)
				{
					#email does not exist yet; insert the record
					/*
						Account status: 
						1 - active, 2 - pending, 3 - inactive/disabled
					*/

					#insert the user's information into the database
					$stmt_user = $con->prepare("INSERT INTO users (userFN, userLN) VALUES (?, ?)");
					$stmt_user->bind_param("ss", $inpFN, $inpLN);
					$stmt_user->execute();

					#get the id of the inserted record
					$last_user = $con->insert_id;

					#insert the account/login info w/ the user's id
					$stmt_account = $con->prepare("INSERT INTO accounts (accountUN, accountPW, accountStatus, userID) VALUES (?, ?, 2, ?)");
					$stmt_account->bind_param("sss", $inpEmail, $inpPW, $last_user);
					$stmt_account->execute();

					$msgDisplay = successAlert("<strong>Success!</strong> Please check your email to confirm your account.");
				}
				else
				{
					#the email exists; display an error
					$msgDisplay = errorAlert("That email already exists. Sign in <a href='login.php'>here</a> if you already have an account.");
				}
			}
			else
			{
				$msgDisplay = errorAlert("Please make sure that both passwords match.");
			}
		}
	}
?>
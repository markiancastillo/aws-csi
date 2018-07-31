<?php
	$msgDisplay = "";

	function test()
	{
		echo 'hello';
	}

	# Used by the view.php and index.php's modal for adding a new record
	function addRecord($con, $inpTeam, $inpEnv, $inpTech, $inpType, $inpInitial, $inpFinal, $totSavings, $inpCause, $inpSteps, $inpDate, $inpProj, $userID)
	{
		$stmt_insert = $con->prepare("INSERT INTO costsavings (csCause, csSteps, csDate, csSavings, csInitial, csFinal, teamID, techID, envID, typeID, projectID, userID) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt_insert->bind_param("sssdddiiiiii", $inpCause, $inpSteps, $inpDate, $totSavings, $inpInitial, $inpFinal, $inpTeam, $inpTech, $inpEnv, $inpType, $inpProj, $userID);
		$stmt_insert->execute() or die(mysqli_error($con));

		$msgDisplay = successAlert("Successfully inserted a new record.");

		return $msgDisplay;
	}

	# Gets the access value from the database to determine the availability of administrator functions for the user
	function allowAccess($con, $accID)
	{
		$sql_access = $con->prepare("SELECT accountAccess FROM accounts WHERE accountID = ?");
		$sql_access->bind_param("i", $accID);
		$sql_access->execute();

		$result_access = $sql_access->get_result();

		while($row = mysqli_fetch_array($result_access))
		{
			$accountAccess = $row['accountAccess'];
		}

		return $accountAccess;
	}

	# Determines whether the page can be accessed by the user
	# Used in the Manage Data pages (add/edit teams, tech, savings types, environments)
	function accessPage($con, $accID)
	{
		$accountAccess = allowAccess($con, $accID);

		if($accountAccess == 1 || $accountAccess == 2)
		{
			
		}
		else
		{
			header('location: error.php');
		}

		#return $accessPage;
	}

	# Used to compare password inputs for verification
	# Currently used in the access management page (user.php)
	function confirmPassword($con, $accID, $inpPassword)
	{
		# Get the password stored in the database
		$sql_pass = $con->prepare("SELECT accountPW FROM accounts WHERE accountID = ?");
		$sql_pass->bind_param("i", $accID);
		$sql_pass->execute();

		$result_pass = $sql_pass->get_result();

		while($row = mysqli_fetch_array($result_pass))
		{
			$accountPW = $row['accountPW'];
		}

		# Verify that the input and stored values are the same
		# password_verify(input, hash); returns bool
		return password_verify($inpPassword, $accountPW);
	}

	# Used to display an error alert box
	function errorAlert($msgText)
	{
		$msgError = "<div class='alert alert-danger alert-dismissible fade show'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						" . $msgText . "
					</div>";
		return $msgError;
	}

	# Checks the input data by removing slashes and white spaces
	function inpcheck($inputData)
	{
		$inputData = removeslashes($inputData);
		$inputData = stripslashes($inputData);
		$inputData = trim($inputData);
		$inputData = htmlspecialchars($inputData);

		return $inputData;
	}

	# Gets the percent difference between savings values (used in the dashboard)
	function getDiff($sumLast, $sumSavings)
	{
		#formula to get the % difference for the current week vs. previous week
		$percDiff = ($sumLast == 0) ? '--' : number_format((float)(($sumSavings-$sumLast) / $sumLast)*100, 2, '.', '');

		return $percDiff;
	}

	# Determines the arrow icon to display based on the increase or decrease of savings (previous vs current)
	function getArrowIcon($sumLast, $sumSavings)
	{
		$percDiff = getDiff($sumLast, $sumSavings);

		if($percDiff < 0)
		{
			$arrowIcon = "<span class='fa fa-fw fa-arrow-circle-down' style='color: red'></span>";
		}
		else if($percDiff > 0)
		{
			$arrowIcon = "<span class='fa fa-fw fa-arrow-circle-up' style='color: green'></span>";
		}
		else 
		{
			$arrowIcon = "<span class='fa fa-fw fa-minus-circle' style='color: grey'></span>";
		}

		return $arrowIcon;
	}

	function getProjectName($con, $inpProj)
	{
		# Get the project name for the audit text
		$sql_projName = $con->prepare("SELECT projectName FROM projects WHERE projectID = ?");
		$sql_projName->bind_param("i", $inpProj);
		$sql_projName->execute();

		$result_projName = $sql_projName->get_result();

		while($row = mysqli_fetch_array($result_projName))
		{
			$projName = $row['projectName'];
		}

		return $projName;
	}

	# 
	function getUserID($con, $accID)
	{
		$sql_user = $con->prepare("SELECT userID FROM accounts WHERE accountID = ?");
		$sql_user->bind_param("i", $accID);
		$sql_user->execute();

		$result_user = $sql_user->get_result();

		while($ru = mysqli_fetch_array($result_user))
		{
			$userID = $ru['userID'];
		}

		return $userID;
	}

	#
	function getUserName($con, $accID)
	{
		$sql_name = $con->prepare("SELECT u.userFN, u.userLN FROM accounts a INNER JOIN users u ON a.userID = u.userID WHERE a.userID = ?");
		$sql_name->bind_param("i", $accID);
		$sql_name->execute() or die(mysqli_error($con));

		$result_name = $sql_name->get_result();

		while($row = mysqli_fetch_array($result_name))
		{
			$userFN = $row['userFN'];
			$userLN = $row['userLN'];
		}

		$userName = $userFN . ' ' . $userLN;
		return $userName;
	}

	# Get the list of access types and its default
	function listAccess($con, $def_access)
	{
		$sql_access = "SELECT accessID, accessRole FROM access";
		$result_access = $con->query($sql_access) or die(mysqli_error($con));

		$list_access = "";
		while($row = mysqli_fetch_array($result_access))
		{
			$accessID = $row['accessID'];
			$accessRole = htmlspecialchars($row['accessRole']);

			if($accessID == $def_access) { $selected = "selected='true'"; } else { $selected = ""; }

			$list_access .= "<option value='$accessID' $selected>$accessRole</option>";
		}
		
		return $list_access;
	}

	# Gets the list of environments for the dropdown
	function listEnvironments($con, $def_envID)
	{
		# Default value for the environment dropdown
		$sql_env = "SELECT envID, envName FROM environments";
		$result_env = $con->query($sql_env) or die(mysqli_error($con));
	
		$list_env = "";
		while($rowv = mysqli_fetch_array($result_env))
		{
			$envID = htmlspecialchars($rowv['envID']);
			$envName = htmlspecialchars($rowv['envName']);
	
			if($envID == $def_envID) { $selected = "selected='true'"; } else { $selected = ""; }
	
			$list_env .= "<option value='$envID' $selected>$envName</option>";
		}

		return $list_env;
	}

	function listProjects($con)
	{
		$sql_proj = "SELECT projectID, projectName FROM projects";
		$result_proj = $con->query($sql_proj) or die(mysqli_error($con));

		$list_proj = "";
		while($row = mysqli_fetch_array($result_proj))
		{
			$projectID = ($row['projectID']);
			$projectName = htmlspecialchars($row['projectName']);

			$list_proj .= "<option value='$projectID'>$projectName</option>";
		}

		return $list_proj;
	}

	#Gets the list of status (roles) related to a user's account
	function listStatus($con, $def_status)
	{
		switch ($def_status) 
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

		return $statusText;
	}

	# Gets the list of journey teams for the dropdown
	function listTeams($con, $def_teamID)
	{    
	    # Default value for the team dropdown
	    $sql_teams = "SELECT teamID, teamName FROM journeyteams";
		$result_teams = $con->query($sql_teams) or die(mysqli_error($con));
	
		$list_teams = "";
		while($rowt = mysqli_fetch_array($result_teams))
		{
			$teamID = htmlspecialchars($rowt['teamID']);
			$teamName = htmlspecialchars($rowt['teamName']);
	
			if($teamID == $def_teamID) { $selected = "selected='true'"; } else { $selected = ""; }
	
			$list_teams .= "<option value='$teamID' $selected>$teamName</option>";
		}

		return $list_teams;
	}

	# Gets the list of aws/devops technologies for the dropdown
	function listTech($con, $def_techID)
	{
		# Default value for the tech dropdown
		$sql_tech = "SELECT techID, techName FROM technologies";
		$result_tech = $con->query($sql_tech) or die(mysqli_error($con));
	
		$list_tech = "";
		while($rowh = mysqli_fetch_array($result_tech))
		{
			$techID = htmlspecialchars($rowh['techID']);
			$techName = htmlspecialchars($rowh['techName']);
	
			if($techID == $def_techID) { $selected = "selected='true'"; } else { $selected = ""; }
	
			$list_tech .= "<option value='$techID' $selected>$techName</option>";
		}

		return $list_tech;
	}

	# Gets the list of savings types for the dropdown
	function listTypes($con)
	{
		$sql_type = "SELECT typeID, typeName FROM savingtypes";
		$result_type = $con->query($sql_type) or die(mysqli_error($con));
	
		$list_type = "";
		while($rowy = mysqli_fetch_array($result_type))
		{
			$typeID = htmlspecialchars($rowy['typeID']);
			$typeName = htmlspecialchars($rowy['typeName']);
	
			$list_type .= "<option value='$typeID'>$typeName</option>";
		}

		return $list_type;
	}

	# Logs the event/action that was performed on a page as well as the actor of the event
	function logEvent($con, $accID, $txtEvent)
	{
		$userName = getUserName($con, $accID);
		$sql_log = $con->prepare("INSERT INTO logs (logDate, logUser, logEvent) VALUES (NOW(), ?, ?)");
		$sql_log->bind_param("ss", $userName, $txtEvent);
		$sql_log->execute() or die(mysqli_error($con));
	}

	# Removes slashes from input data
	function removeslashes($inpData)
	{
		$inpData = implode("", explode("\\", $inpData));
		$inpData = implode("", explode("/", $inpData));
		return $inpData;
	}

	/* taken from https://screenshotlayer.com/documentation
	   note: only the free version is used. there is a limitation
	   of 2 requests per minute and 100 requests per month
	   ** currently unused **
	*/
	function screenshotlayer($url, $args) 
    {
        // set access key
        $access_key = "3e2fb89a508890b8ee36657091d275e7";
        
        // set secret keyword (defined in account dashboard)
        $secret_keyword = "helloworld114";
        
        // encode target URL
        $params['url'] = urlencode($url);
        
        $params += $args;
        
        // create the query string based on the options
        foreach($params as $key => $value) { $parts[] = "$key=$value"; }
        
        // compile query string
        $query = implode("&", $parts);
        
        // generate secret key from target URL and secret keyword
        $secret_key = md5($url . $secret_keyword);

        return "https://api.screenshotlayer.com/api/capture?access_key=$access_key&secret_key=$secret_key&$query";
    }

    # Displays a success alert box
	function successAlert($msgText)
	{
		$msgSuccess = "<div class='alert alert-success alert-dismissible fade show'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						" . $msgText . "
						</div>";
		return $msgSuccess;
	}

	# Displays a warning alert box
	function warningAlert($msgText)
	{
		$msgWarning = "<div class='alert alert-warning alert-dismissible fade show'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						" . $msgText . "
						</div>";
		return $msgWarning;
	}

	
?>
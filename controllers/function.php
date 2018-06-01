<?php
	$msgDisplay = "";

	function errorAlert($msgText)
	{
		$msgError = "<div class='alert alert-danger alert-dismissible fade show'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						" . $msgText . "
					</div>";
		return $msgError;
	}

	function inpcheck($inputData)
	{
		$inputData = removeslashes($inputData);
		$inputData = stripslashes($inputData);
		$inputData = trim($inputData);
		$inputData = htmlspecialchars($inputData);
		return $inputData;
	}

	function listEnvironments($con)
	{
		$sql_env = "SELECT envID, envName FROM environments";
		$result_env = $con->query($sql_env) or die(mysqli_error($con));
	
		$list_env = "";
		while($rowv = mysqli_fetch_array($result_env))
		{
			$envID = htmlspecialchars($rowv['envID']);
			$envName = htmlspecialchars($rowv['envName']);
	
			$list_env .= "<option value='$envID'>$envName</option>";
		}

		return $list_env;
	}

	function listTeams($con)
	{
		$sql_teams = "SELECT teamID, teamName FROM journeyteams";
		$result_teams = $con->query($sql_teams) or die(mysqli_error($con));
	
		$list_teams = "";
		while($rowt = mysqli_fetch_array($result_teams))
		{
			$teamID = htmlspecialchars($rowt['teamID']);
			$teamName = htmlspecialchars($rowt['teamName']);
	
			$list_teams .= "<option value='$teamID'>$teamName</option>";
		}

	    return $list_teams;
	}

	function listTech($con)
	{
		$sql_tech = "SELECT techID, techName FROM technologies";
		$result_tech = $con->query($sql_tech) or die(mysqli_error($con));
	
		$list_tech = "";
		while($rowh = mysqli_fetch_array($result_tech))
		{
			$techID = htmlspecialchars($rowh['techID']);
			$techName = htmlspecialchars($rowh['techName']);
	
			$list_tech .= "<option value='$techID'>$techName</option>";
		}

		return $list_tech;
	}

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

	function removeslashes($inpData)
	{
		$inpData = implode("", explode("\\", $inpData));
		$inpData = implode("", explode("/", $inpData));
		return $inpData;
	}

	# taken from https://screenshotlayer.com/documentation
	# note: only the free version is used. there is a limitation
	# of 2 requests per minute and 100 requests per month
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

	function successAlert($msgText)
	{
		$msgSuccess = "<div class='alert alert-success alert-dismissible fade show'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						" . $msgText . "
						</div>";
		return $msgSuccess;
	}

	function warningAlert($msgText)
	{
		$msgWarning = "<div class='alert alert-warning alert-dismissible fade show'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						" . $msgText . "
						</div>";
		return $msgWarning;
	}
?>
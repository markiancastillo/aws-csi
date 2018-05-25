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
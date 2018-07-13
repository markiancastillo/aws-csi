<?php
	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');

    ob_start();
    session_start();

    # Change the default timezone for the date/time functions
	date_default_timezone_set("Asia/Singapore");

	# Parameters for the screenshotlayer API
	# Set optional parameters (leave blank if unused)
	$params['fullpage']  = '1';    
	$params['width'] = '';      
	$params['viewport']  = '';  
	$params['format'] = '';      
	$params['css_url'] = '';      
	$params['delay'] = '';      
	$params['ttl'] = '';  
	$params['force']     = '1';     
	$params['placeholder'] = '';      
	$params['user_agent'] = '';      
	$params['accept_lang'] = '';      
	$params['export'] = '';
	$params['access'] = 'screenshotlayerapi@mail.com';
	$params['pk'] = 'screenshotlayer';

	# Get the current url of the page to pass into the og:image meta tag
	$current_uri = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
	# Call Screenshotlayer's API (assigned to a function)
	$imglink = screenshotlayer($current_uri, $params);

    if(isset($_SESSION['accID']))
    {
    	$accID = $_SESSION['accID'];
	
	    # SQL query for displaying the current user's name
	    $sql_name = "SELECT userFN, userLN FROM users WHERE userID = $accID";
	    $result_name = $con->query($sql_name) or die(mysqli_error($con));
	
	    while($row = mysqli_fetch_array($result_name))
	    {
	    	$userFN = $row['userFN'];
	    	$userLN = $row['userLN'];
	    }

	    # Hide/show certain navbar buttons depending on the user's access level
		$accessLevel = allowAccess($con, $accID);
	}
	else if(isset($_GET['access']))
	{
		# **Originally used for sceenshotlayer's API; currently unused
		# The session id is not set but login info can still be queried
		$ssaccess = $_GET['access'];
		$sql_su = "SELECT userID FROM accounts WHERE accountEmail = $ssaccess";
		$result_su = $con->query($sql_su) or die(mysqli_error($con));

		while($a_row = mysqli_fetch_array($result_su))
		{
			$userID = $a_row['userID'];
		}

		$sql_ss = "SELECT userFN, userLN FROM users WHERE userID = $userID";
		$result_ss = $con->query($sql_ss) or die(myslqli_error($con));

		while($s_row = mysqli_fetch_array($result_ss))
		{
			$userFN = $s_row['userFN'];
	    	$userLN = $s_row['userLN'];
		}
	}
	else
	{
		header('location: login.php');
	}
?>
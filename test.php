<?php
	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');

    if(isset($_GET['access']) && isset($_GET['pk']))
    {
    	echo 'access is: ' . $_GET['access'];
    	echo '<br>';
    	echo 'passkey is: ' . $_GET['pk'];
    	echo '<br>';    	
    }

    // check from the database the records being passed via the URL 
    $access = urldecode($_GET['access']);
    $passkey = 'screenshotlayer';

    $sql_verify = "SELECT accountUN, accountPW FROM accounts WHERE accountUN='$access'";
    $result_verify = $con->query($sql_verify) or die(mysqli_error($con));

    if(mysqli_num_rows($result_verify) > 0)
    {
    	while($row = mysqli_fetch_array($result_verify))
    	{
    		$accessPW = $row['accountPW'];

    		if(password_verify($passkey, $accessPW))
    		{
    			echo '<br>Username and password accepted!';
    		}
    		else
    		{
    			echo '<br>Access denied.';
    		}
    	}
    }
    else
    {
    	echo '<br>No matching columns';
    }
?>
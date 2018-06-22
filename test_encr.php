<?php
/*	// Usage 1:
	echo password_hash('rasmuslerdorf', PASSWORD_DEFAULT)."<br>";
	// $2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
	// For example:
	// $2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a
	
	// Usage 2:
	$options = [
	  'cost' => 11
	];
	echo password_hash('rasmuslerdorf', PASSWORD_BCRYPT, $options)."<br>";
	// $2y$11$6DP.V0nO7YI3iSki4qog6OQI5eiO6Jnjsqg7vdnb.JgGIsxniOn4C
	
	#  To verify a user provided password against an existing hash, 
	#  you may use the password_verify() as such:
	
	// See the password_hash() example to see where this came from.
	#$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
	$hash = '$2y$10$aSyihD4S3gMbetc/JJGf2eRT4sCXLiXK08AirLQbEj97uFMyCycXO';
	echo $hash;

	if (password_verify('rasmuslerdorf', $hash)) {
	    echo 'Password is valid!';
	} else {
	    echo 'Invalid password.';
	}

	echo "<br><hr><br>";

	if (password_verify('rasmuslerdorf', $hash)) {
		echo 'TRUE';
		print_r(password_verify('rasmuslerdorf', $hash));
	} else {
		echo 'FALSE';
		print_r(password_verify('rasmuslerdorf', $hash));
	}
*/
	if(isset($_POST['btnSubmit']))
	{
		# get the password input to be checked
		$inpPW = $_POST['inpPW'];

		# this is the correct password
		#$string = "123admin";
		#$hash = password_hash($string, PASSWORD_DEFAULT);
		$hash = '$2y$10$0MwJioraw1YcS2HVjCcpyuGfhFHHB0itRkzks1CgsWDAOr8Rf4Ub.';

		# compare the input password to the stored hash
		if(password_verify($inpPW, $hash))
		{
			echo "User input: " . $inpPW . "<br> Hash: " . $hash . "<br><strong style='color: green'>Password is valid</strong>";
		}
		else
		{
			echo "<p style='color: red'>Password is invalid</p>";
		}
	}

	echo "<br><hr>";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test encryption</title>
</head>
<body>
	<h3>Password Input</h3>
	<form method="POST">
		<input type="text" name="inpPW" />
		<input type="submit" name="btnSubmit" value="Check if the PW is correct..." />
	</form>
</body>
</html>
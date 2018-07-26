<?php
	#localhost paameters 
	$server = "127.0.0.1";		# Host name or IP address
	$username = "root";			# MySQL username
	$password = "";				# MySQL password
	$database = "aws-csi"; 		# Database name

	# syntax: mysqli_connect(host, username, password, dbname, port, socket)
	$con = mysqli_connect($server, $username, $password, $database);

# 	For testing
#	if(!$con)
#	{
#		echo "Database connection error.";
#	}
?>
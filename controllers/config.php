<?php
	#localhost paameters 
	$server = "127.0.0.1";
	$database = "prog"; 
	$username = "root";
	$password = "";

	#000webhost parameters
	#$server = "localhost";
	#$database = "id5114526_prog";
	#$username = "id5114526_castillomi";
	#$password = "damong_talahiban";

	$con = mysqli_connect($server, $username, $password, $database);

	if(!$con)
	{
		echo "error!";
	}
?>
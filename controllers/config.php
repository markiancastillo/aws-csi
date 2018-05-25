<?php
	#localhost paameters 
	$server = "127.0.0.1";
	$database = "prog"; 
	$username = "root";
	$password = "";

	#000webhost parameters
	#$server = "localhost";
	#$database = "id5913580_aws_csi";
	#$username = "id5913580_castillomi";
	#$password = "damong_talahiban";

	$con = mysqli_connect($server, $username, $password, $database);

	if(!$con)
	{
		echo "error!";
	}
?>
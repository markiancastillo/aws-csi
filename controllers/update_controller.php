<?php
	$pageTitle = "Update Record";
	include 'includes/header.php';

	#validate the record being requested:
	#if the id doesnt exist, show an error
	if(isset($_GET['rid']))
	{
		$requestedID = $_GET['rid'];

		#query: check that the ID exists
		$sql_validate = "SELECT csID FROM costsavings WHERE csID = $requestedID";
		$result_validate = $con->query($sql_validate) or die(mysqli_error($con));
	
		if(mysqli_num_rows($result_validate) == 0)
		{
			header('location: error.php');
		}
		else
		{
			if(isset($_POST['btnSubmit']))
			{
				if(!isset($_FILES['inpPhoto']) || $_FILES['inpPhoto']['error'])
				{
					#image is not set in the form
					#display an error
				}
				else
				{
					#validate the image (file must be an image file type)
					#accepted files: ???
					
					$imgName = $_FILES['inpPhoto']['name'];
					$imgDir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . "/images/";
					$imgNew = date('YmdHis') . "_" . basename($imgName);
					$imgFile = $imgDir . $imgNew;
	
					move_uploaded_file($_FILES['inpPhoto']['tmp_name'], $imgFile);
		
					#update the data of the record
					$stmt_update = $con->prepare("UPDATE costsavings SET csFinal = ? WHERE csID = ?");
					$stmt_update->bind_param("si", $imgNew, $requestedID);
	
					$stmt_update->execute() or die(mysqli_error($con));
	
					header('location: view.php');
				}
			}
		}
	}
	else
	{
		header('location: error.php');
	}
?>
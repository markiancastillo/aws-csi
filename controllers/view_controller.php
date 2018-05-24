<?php
	$pageTitle = "Cost Savings";
	include_once 'includes/header.php';

	$tomorrowDate = new DateTime(date("Y-m-d"));
	$tomorrowDate->add(new DateInterval("P1D"));

	#get the data for the dropdowns in the add form
	#data for journey teams ddl
	$sql_teams = "SELECT teamID, teamName FROM journeyteams";
	$result_teams = $con->query($sql_teams) or die(mysqli_error($con));

	$list_teams = "";
	while($rowt = mysqli_fetch_array($result_teams))
	{
		$teamID = htmlspecialchars($rowt['teamID']);
		$teamName = htmlspecialchars($rowt['teamName']);

		$list_teams .= "<option value='$teamID'>$teamName</option>";
	}

	#data for devops technology ddl
	$sql_tech = "SELECT techID, techName FROM technologies";
	$result_tech = $con->query($sql_tech) or die(mysqli_error($con));

	$list_tech = "";
	while($rowh = mysqli_fetch_array($result_tech))
	{
		$techID = htmlspecialchars($rowh['techID']);
		$techName = htmlspecialchars($rowh['techName']);

		$list_tech .= "<option value='$techID'>$techName</option>";
	}

	#data for environment ddl
	$sql_env = "SELECT envID, envName FROM environments";
	$result_env = $con->query($sql_env) or die(mysqli_error($con));

	$list_env = "";
	while($rowv = mysqli_fetch_array($result_env))
	{
		$envID = htmlspecialchars($rowv['envID']);
		$envName = htmlspecialchars($rowv['envName']);

		$list_env .= "<option value='$envID'>$envName</option>";
	}

	#data for savings type ddl
	$sql_type = "SELECT typeID, typeName FROM savingtypes";
	$result_type = $con->query($sql_type) or die(mysqli_error($con));

	$list_type = "";
	while($rowy = mysqli_fetch_array($result_type))
	{
		$typeID = htmlspecialchars($rowy['typeID']);
		$typeName = htmlspecialchars($rowy['typeName']);

		$list_type .= "<option value='$typeID'>$typeName</option>";
	}

	#get the records for the table
	# !! image display to be added
	$sql_list = "SELECT s.csID, s.csDesc, s.csActor, s.csDate, s.csSavings, s.csInitial, s.csFinal, m.teamName, h.techName, e.envName, y.typeName 
				 FROM costsavings s 
				 INNER JOIN journeyteams m ON s.teamID = m.teamID 
				 INNER JOIN technologies h ON s.techID = h.techID 
				 INNER JOIN environments e ON s.envID = e.envID 
				 INNER JOIN savingtypes y ON s.typeID = y.typeID";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$cs_list = "";
	$imgModal = "";
	while($row = mysqli_fetch_array($result_list))
	{
		$csID = htmlspecialchars($row['csID']);
		$csDesc = htmlspecialchars($row['csDesc']);
		$csActor = htmlspecialchars($row['csActor']);
		$csDate = htmlspecialchars($row['csDate']);
		$displayDate = date('m/d/Y', strtotime($csDate));
		$csSavings = htmlspecialchars($row['csSavings']);
		$csInitial = htmlspecialchars($row['csInitial']);
		$csFinal = htmlspecialchars($row['csFinal']);
		$teamName = htmlspecialchars($row['teamName']);
		$techName = htmlspecialchars($row['techName']);
		$envName = htmlspecialchars($row['envName']);
		$typeName = htmlspecialchars($row['typeName']);

		$displayInitial = ($csInitial === null || empty($csInitial)) ? "placeholder.jpg" : $csInitial;
		$displayFinal = ($csFinal === null || empty($csFinal)) ? "placeholder.jpg" : $csFinal;

		$cs_list .= "
			<tr>
                <td>$teamName</td>
                <td>$techName</td>
                <td>$envName</td>
                <td>$typeName</td>
                <td>
                	<a role='button' data-toggle='modal' data-target='#imgModal$csID'>
                		<img src='images/$displayInitial' width='100px'>
                	</a>
                </td>
                <td>
                	<a role='button' data-toggle='modal' data-target='#imgModal$csID'>
                		<img src='images/$displayFinal' width='100px'>
                	</a>
                </td>
                <td>$csDesc</td>
                <td>$csActor</td>
                <td>$displayDate</td>
                <td>
                    <span class='float-left'>$</span>
                    <span class='float-right'>$csSavings</span>
                </td>
                <td>
                	<a class='btn btn-primary' href='update.php?rid=$csID'>Update</a>
                </td>
            </tr>";

        $imgModal .= "
        	<div class='modal fade' tabindex='-1' role='dialog' id='imgModal$csID'>
			    <div class='modal-dialog modal-lg' role='document'>
			        <div class='modal-content'>
			            <div class='modal-header'>
			                <p class='modal-title'></p>
			                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
			                    <span aria-hidden='true'>&times;</span>
			                </button>
			            </div>
			            <div class='modal-body'>
							<div id='imgCarousel$csID' class='carousel slide' data-ride='carousel'>
							    <ul class='carousel-indicators'>
							        <li data-target='#imgCarousel$csID' data-slide-to='0' class='active'></li>
							        <li data-target='#imgCarousel$csID' data-slide-to='1'></li>
							    </ul>
							
							    <div class='carousel-inner'>
							        <div class='carousel-item active'>
							        	Initial Screenshot ($displayInitial)
							            <img class='img-fluid' src='images/$displayInitial' width='100%'>
							        </div>
							        <div class='carousel-item'>
										FInal Screenshot ($displayFinal)
							            <img class='img-fluid' src='images/$displayFinal' width='100%'>
							        </div>
							    </div>
							
							    <a class='carousel-control-prev' data-target='#imgCarousel$csID' data-slide='prev'>
							        <span class='carousel-control-prev-icon'></span>
							    </a>
							    <a class='carousel-control-next' data-target='#imgCarousel$csID' data-slide='next'>
							        <span class='carousel-control-next-icon'></span>
							    </a>
							</div>
			            </div>
			            <div class='modal-footer'>
			                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
			            </div>
			        </div>
			    </div>
			</div>";
	}

	#insert the input into the database
	if(isset($_POST['btnSubmit']))
	{
		#validation: description and name fields must have a valid input

		#validation: savings (number) input must not be 0.00 or a negative number

		#retrieve the input data from the form
		$inpTeam = mysqli_real_escape_string($con, $_POST['inpTeam']);
		$inpTech = mysqli_real_escape_string($con, $_POST['inpTech']);
		$inpEnv = mysqli_real_escape_string($con, $_POST['inpEnv']);
		#$inpInitial = mysqli_real_escape_string($con, $_POST['inpInitial']); -- to be added
		$inpDesc = mysqli_real_escape_string($con, $_POST['inpDesc']);
		$inpName = mysqli_real_escape_string($con, $_POST['inpName']);
		$inpDate = mysqli_real_escape_string($con, $_POST['inpDate']);
		$inpType = mysqli_real_escape_string($con, $_POST['inpType']);
		$inpSave = str_replace(",", "", mysqli_real_escape_string($con, $_POST['inpSave']));

		#check the image uploaded
		if(!isset($_FILES['inpPhoto']) || $_FILES['inpPhoto']['error'])
		{
			#there is no input
			#1 - do not include in the insertion of records (current) || 2 - show an error prompt 
			#CURRENT: inert 'placeholder.jpg' into the csInitial column
			$stmt_insert = $con->prepare("INSERT INTO costsavings (csDesc, csActor, csDate, csSavings, csInitial, teamID, techID, envID, typeID) VALUES (?, ?, ?, ?, 'placeholder.jpg', ?, ?, ?, ?)");
			$stmt_insert->bind_param("sssdiiii", $inpDesc, $inpName, $inpDate, $inpSave, $inpTeam, $inpTech, $inpEnv, $inpType);
		}
		else
		{
			#validate that the file is a valid image (to be added)
			#accepted file types: ???

			$imgName = $_FILES['inpPhoto']['name'];					#name of the image file
			$imgDir = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . "/images/";	#file save location
			$imgNew = date('YmdHis') . "_" . basename($imgName);	#add timestamp to filename
			$imgFile = $imgDir . $imgNew;

			#move the file to the new destination with the new file name
			move_uploaded_file($_FILES['inpPhoto']['tmp_name'], $imgFile);

			#insert the data into the database
			#the image itself will not be inserted directly in the database
			#instead, only the image name will be saved in the db while the file is saved locally
			$stmt_insert = $con->prepare("INSERT INTO costsavings (csDesc, csActor, csDate, csSavings, csInitial, teamID, techID, envID, typeID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt_insert->bind_param("sssdsiiii", $inpDesc, $inpName, $inpDate, $inpSave, $imgNew, $inpTeam, $inpTech, $inpEnv, $inpType);
		}

		$stmt_insert->execute() or die(mysqli_error($con));

		$msgDisplay = successAlert("Successfully inserted a new record.");

		header('Refresh: 1');
	}

?>
<?php
	$pageTitle = "Cost Savings";
	include_once 'includes/header.php';

	$dateToday = new DateTime(date("Y-m-d"));

	# Get the records for the table
	$sql_list = "SELECT s.csID, s.csCause, s.csSteps, s.csActor, s.csDate, s.csSavings, s.csInitial, s.csFinal, m.teamName, h.techName, e.envName, y.typeName 
				 FROM costsavings s 
				 INNER JOIN journeyteams m ON s.teamID = m.teamID 
				 INNER JOIN technologies h ON s.techID = h.techID 
				 INNER JOIN environments e ON s.envID = e.envID 
				 INNER JOIN savingtypes y ON s.typeID = y.typeID
				 ORDER BY s.csDate DESC";
	$result_list = $con->query($sql_list) or die(mysqli_error($con));

	$cs_list = "";
#	$imgModal = ""; -- image uploading removed (06/01/2018)
	while($row = mysqli_fetch_array($result_list))
	{
		$csID = htmlspecialchars($row['csID']);
		$csCause = htmlspecialchars($row['csCause']);
		$csSteps = htmlspecialchars($row['csSteps']);
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

#		$displayInitial = ($csInitial === null || empty($csInitial)) ? "placeholder.jpg" : $csInitial;	-- removed (06/01/2018)
#		$displayFinal = ($csFinal === null || empty($csFinal)) ? "placeholder.jpg" : $csFinal;

		$cs_list .= "
			<tr class='clickable-row' data-href='details.php?rid=$csID' style='cursor: pointer;'>
				<td>$displayDate</td>
                <td>$teamName</td>
                <td>$techName</td>
                <td>$envName</td>
                <td>$typeName</td>
                <td>$csActor</td>
                <td>$csSteps</td>
                <td>
                    <span class='float-left'>$</span>
                    <span class='float-right'>$csSavings</span>
                </td>
            </tr>";
        # Update 06/01/2018: image input is replaced with cost input
        /*$imgModal .= "
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
			</div>";*/
	}

	# Insert the input into the database
	if(isset($_POST['btnAdd']))
	{
		# Retrieve the input data from the form
		$inpTeam = mysqli_real_escape_string($con, $_POST['inpTeam']);
		$inpEnv = mysqli_real_escape_string($con, $_POST['inpEnv']);
		$inpTech = mysqli_real_escape_string($con, $_POST['inpTech']);
		$inpType = mysqli_real_escape_string($con, $_POST['inpType']);
		# Rremove the commas from the money input
		$inpInitial = str_replace(",", "", mysqli_real_escape_string($con, $_POST['inpInitial']));
		$inpFinal = str_replace(",", "", mysqli_real_escape_string($con, $_POST['inpFinal']));
		$totSavings = $inpInitial - $inpFinal;

		$inpCause = mysqli_real_escape_string($con, $_POST['inpCause']);
		$inpSteps = mysqli_real_escape_string($con, $_POST['inpSteps']);
		$inpName = mysqli_real_escape_string($con, $_POST['inpName']);
		$inpDate = mysqli_real_escape_string($con, $_POST['inpDate']);

/* 		Update 06/01/2018: image input is replaced with cost input
		#check the image uploaded
		if(!isset($_FILES['inpPhoto']) || $_FILES['inpPhoto']['error'])
		{
			#there is no input
			#1 - do not include in the insertion of records (current) || 2 - show an error prompt 
			#CURRENT: inert 'placeholder.jpg' into the csInitial column
			$stmt_insert = $con->prepare("INSERT INTO costsavings (csCause, csActor, csDate, csSavings, csInitial, teamID, techID, envID, typeID) VALUES (?, ?, ?, ?, 'placeholder.jpg', ?, ?, ?, ?)");
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
			$stmt_insert = $con->prepare("INSERT INTO costsavings (csCause, csActor, csDate, csSavings, csInitial, teamID, techID, envID, typeID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt_insert->bind_param("sssdsiiii", $inpDesc, $inpName, $inpDate, $inpSave, $imgNew, $inpTeam, $inpTech, $inpEnv, $inpType);
		}
*/

		addRecord($con, $inpTeam, $inpEnv, $inpTech, $inpType, $inpInitial, $inpFinal, $totSavings, $inpCause, $inpSteps, $inpName, $inpDate);

		$msgDisplay = successAlert("Successfully inserted a new record.");
		header('Refresh: 1');
	}
?>
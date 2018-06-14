<?php
	$pageTitle = "Dashboard";
	include 'includes/header.php';

	#error_reporting(0);
	#ini_set('display_errors', 0);
	
	#query: get the list of teams for the filter
	$sql_listTeams = "SELECT teamID, teamName FROM journeyteams";
	$result_listTeams = $con->query($sql_listTeams) or die(mysqli_error($con));

	$list_teams = "";
	while($rt = mysqli_fetch_array($result_listTeams))
	{
		$teamID = $rt['teamID'];
		$teamName = $rt['teamName'];

		if(isset($_GET['filter']) && $teamID == $_GET['filter'])
		{
			$isActive = "selected='true'";
		}
		else 
		{
			$isActive = "";
		}

		$list_teams .= "<option value='?filter=$teamID' $isActive>$teamName</option>";
	}

#SQL - for doughnut chart (breakdown by teams)
	$sql_team = "SELECT j.teamName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN journeyteams j ON c.teamID = j.teamID 
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";

	$teamArray = array();
	$tsavingsArray = array();

#SQL - for doughnut chart (breakdown by environment)
	$sql_env = "SELECT v.envName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN environments v ON c.envID = v.envID
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";

	$envArray = array();
	$esavingsArray = array();

#SQL - for doughnut chart (breakdown by Technology)
	$sql_tech = "SELECT h.techName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN technologies h ON c.techID = h.techID
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";
	$techArray = array();
	$hsavingsArray = array();

#SQL - for doughnut chart (breakdown by savings type)
	$sql_type = "SELECT y.typeName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c 
				 INNER JOIN savingtypes y ON c.typeID = y.typeID 
				 WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";

	$typeArray = array();
	$ysavingsArray = array();

#SQL - for the 10 latest initiatives
	$sql_latest = "SELECT c.csDate, j.teamName, h.techName, v.envName, y.typeName, c.csSavings FROM costsavings c 
				   INNER JOIN journeyteams j ON c.teamID = j.teamID 
				   INNER JOIN technologies h ON c.techID = h.techID
				   INNER JOIN environments v ON c.envID = v.envID
				   INNER JOIN savingtypes y ON c.typeID = y.typeID";

#Values for bar chart
		$valMonth = date('n'); #numeric month without leading zeros
		$data_bar = "[";
		$bar_cs = 0;

#misc. variables 
		$thisMon = date('Y-m-d', strtotime("monday this week"));
		$thisFri = date('Y-m-d', strtotime("sunday this week"));
		$lastMon = date('Y-m-d', strtotime("monday last week"));
		$lastFri = date('Y-m-d', strtotime("friday last week"));
		$headerDisplay = "";
		$pieDisplay = "Breakdown by Team";

		$mon = date_create($thisMon); $fri = date_create($thisFri);
		$cstotalDate = date_format($mon, 'F d') . ' - ' . date_format($fri, 'd, Y');

# ----- 

	if(isset($_GET['filter'])) #check if the filter value is set
	{
		#bind filter values to variable/s
		$valFilter = $_GET['filter'];

		#validation: check if the requested record exists
		$sql_validate = $con->prepare("SELECT csID FROM costsavings WHERE teamID = ?");
		$sql_validate->bind_param("i", $valFilter);
		$sql_validate->execute();

		$result_validate = $sql_validate->get_result();

		if(mysqli_num_rows($result_validate) > 0)
		{

#display header/change the text when applying a filter

			$sql_label = $con->prepare("SELECT teamName FROM journeyteams WHERE teamID = ?");
			$sql_label->bind_param("i", $valFilter);
			$sql_label->execute();

			$result_label = $sql_label->get_result();

			while($rl = mysqli_fetch_array($result_label))
			{
				$labelTeam = $rl['teamName'];
			}

			$headerDisplay = "Team " . $labelTeam;
			$pieDisplay = "Team " . $labelTeam;

#filtered weekly total (w/ percentages)
			#current week total
			$sql_total = $con->prepare("SELECT SUM(csSavings) AS 'sumSavings' FROM costsavings 
										WHERE teamID = ? AND csDate >= ? AND csDate <= ?");
			$sql_total->bind_param("iss", $valFilter, $thisMon, $thisFri);
			$sql_total->execute();

			$result_total = $sql_total->get_result();
			while($row = mysqli_fetch_array($result_total))
			{
				$sumSavings = $row['sumSavings'];
			}

			if(empty($sumSavings))
			{
				$sumSavings = '0.00';
			}

			#previous week total (for comparison)
			$sql_last = $con->prepare("SELECT SUM(csSavings) AS 'sumLast' FROM costsavings 
									   WHERE teamID = ? AND csDate >= ? AND csDate <= ?");
			$sql_last->bind_param("iss", $valFilter, $lastMon, $lastFri);
			$sql_last->execute();
	
			$result_last = $sql_last->get_result();
			while($t_row = mysqli_fetch_array($result_last))
			{
				$sumLast = $t_row['sumLast'];
			}
			
			if(empty($sumLast))
			{
				$sumLast = 0;
			}

#filtered largest input for the week
			$sql_largest_filtered = $con->prepare("SELECT m.teamName, h.techName, y.typeName, v.envName, c.csCause, c.csSteps, c.csSavings, c.csActor, c.csDate
					FROM costsavings c 
					INNER JOIN journeyteams m ON c.teamID = m.teamID 
					INNER JOIN technologies h ON c.techID = h.techID 
					INNER JOIN savingtypes y ON c.typeID = y.typeID 
					INNER JOIN environments v ON c.envID = v.envID
					WHERE c.csDate >= ? AND c.csDate <= ? AND c.teamID = ?
					ORDER BY c.csSavings DESC
					LIMIT 1");
			$sql_largest_filtered->bind_param("ssi", $thisMon, $thisFri, $valFilter);
			$sql_largest_filtered->execute();
	
			$result_largest = $sql_largest_filtered->get_result();
			if(mysqli_num_rows($result_largest) == 0)
			{
				$lar_teamName = "-";
				$lar_techName = "-";
				$lar_typeName = "-";
				$lar_envName = "-";
				$lar_csCause = "No data available";
				$lar_csSteps = "No data available";
				$lar_csSavings = "-";
				$lar_csActor = "";
				$lar_csDate = "No data available";
			}
			else
			{
				while($row_largest = mysqli_fetch_array($result_largest))
				{
					$lar_teamName = $row_largest['teamName'];
					$lar_techName = $row_largest['techName'];
					$lar_typeName = $row_largest['typeName'];
					$lar_envName = $row_largest['envName'];
					$lar_csCause = $row_largest['csCause'];
					$lar_csSteps = $row_largest['csSteps'];
					$lar_csSavings = $row_largest['csSavings'];
					$lar_csActor = $row_largest['csActor'];
					$lar_csDate = $row_largest['csDate'];
				}
			}

#filtered monthly total
			for($i = 1; $i <= $valMonth; $i++)
			{
				#$monthName = date('F', mktime(null, null, null, $i, 1));
				#loop the sql statements for the monthly data
				$sql_barData = "SELECT SUM(csSavings) AS 'totSavings' FROM costsavings 
								WHERE MONTH(csDate) = $i AND teamID = $valFilter 
								GROUP BY MONTH(csDate)";
				$result_barData = $con->query($sql_barData) or die(mysqli_error($con));
		
				while($bar_row = mysqli_fetch_array($result_barData))
				{
					$bar_cs = $bar_row['totSavings'];
					if(empty($bar_cs) || $bar_cs === NULL)
					{
						$bar_cs = 0;
					} 
					else 
					{
						$bar_cs = $bar_row['totSavings'];
					}
				}
				$data_bar .= $bar_cs . ",";
			}
			$data_bar .= "],";

#filtered doughnut charts (filtered by team)
		#for the breakdown by team
			$sql_team_filtered = $sql_team . " AND c.teamID = $valFilter GROUP BY c.teamID";
			$result_team = $con->query($sql_team_filtered) or die(mysqli_error($con));
	
			while($row = mysqli_fetch_array($result_team))
			{
				$teamArray[] = $row['teamName'];
				$tsavingsArray[] = $row['totSavings'];
			}
		
			$tsavings_list = '[' . implode(', ', $tsavingsArray) . '],';
			$teams_list = '["' . implode('", "', $teamArray) . '"],';

		#for the breakdown by environment
			$sql_env_filtered = $sql_env . " AND c.teamID = $valFilter GROUP BY c.envID";
			$result_env = $con->query($sql_env_filtered) or die(mysqli_error($con));
	
			while($e_row = mysqli_fetch_array($result_env))
			{
				$envArray[] = $e_row['envName'];
				$esavingsArray[] = $e_row['totSavings'];
			}
		
			$esavings_list = '[' . implode(', ', $esavingsArray) . '],';
			$env_list = '["' . implode('", "', $envArray) . '"],';

		#for the breakdown by technology
			$sql_tech_filtered = $sql_tech . " AND c.teamID = $valFilter GROUP BY c.techID";
			$result_tech = $con->query($sql_tech_filtered) or die(mysqli_error($con));
	
			while($h_row = mysqli_fetch_array($result_tech))
			{
				$techArray[] = $h_row['techName'];
				$hsavingsArray[] = $h_row['totSavings'];
			}
		
			$hsavings_list = '[' . implode(', ', $hsavingsArray) . '],';
			$tech_list = '["' . implode('", "', $techArray) . '"],';

		#for the breakdown by savings type
			$sql_type_filtered = $sql_type . " AND c.teamID = $valFilter GROUP BY c.typeID";
			$result_type = $con->query($sql_type_filtered) or die(mysqli_error($con));
		
			while($y_row = mysqli_fetch_array($result_type))
			{
				$typeArray[] = $y_row['typeName'];
				$ysavingsArray[] = $y_row['totSavings'];
			}
		
			$ysavings_list = '[' . implode(', ', $ysavingsArray) . '],';
			$type_list = '["' . implode('", "', $typeArray) . '"],';

#filtered recent initiatives
			$sql_latest_filtered = $sql_latest . " WHERE c.teamID = $valFilter ORDER BY csDate DESC LIMIT 10";
			$result_latest = $con->query($sql_latest_filtered) or die(mysqli_error($con));
	
			$list_latest = "";
			while($l_row = mysqli_fetch_array($result_latest))
			{
				$csDate = htmlspecialchars($l_row['csDate']);
				$teamName = htmlspecialchars($l_row['teamName']);
				$techName = htmlspecialchars($l_row['techName']);
				$typeName = htmlspecialchars($l_row['typeName']);
				$envName = htmlspecialchars($l_row['envName']);
				$csSavings = htmlspecialchars($l_row['csSavings']);
	
				#display the date without the year
				$displayDate = date_format(date_create($csDate), 'm/d');
		
				$list_latest .= "
					<tr>
		            	<td>$displayDate</td>
		            	<td>$teamName</td>
		            	<td>$techName</td>
		            	<td>$envName</td>
		            	<td>$typeName</td>
		            	<td>
		            		<span class='float-left'>$</span>
		            		<span class='float-right'>$csSavings</span>
		            	</td>
		            </tr>";
			}

		}
		else 
		{
			#record does not exist; display an error message
			header('location: error.php');
		}
	}
	else #this will display the "default" values for the dashboard (show all)
	{
#default for weekly total (w/ percentages)
		$sql_total = $con->prepare("SELECT SUM(csSavings) AS 'sumSavings' FROM costsavings WHERE csDate >= ? AND csDate <= ?");
		$sql_total->bind_param("ss", $thisMon, $thisFri);
		$sql_total->execute();

		$result_total = $sql_total->get_result();
		while($row = mysqli_fetch_array($result_total))
		{
			$sumSavings = $row['sumSavings'];
		}

		if(empty($sumSavings))
		{
			$sumSavings = '0.00';
		}

		#query to get the total value for the previous week
		$sql_last = $con->prepare("SELECT SUM(csSavings) AS 'sumLast' FROM costsavings WHERE csDate >= ? AND csDate <= ?");
		$sql_last->bind_param("ss", $lastMon, $lastFri);
		$sql_last->execute();

		$result_last = $sql_last->get_result();
		while($t_row = mysqli_fetch_array($result_last))
		{
			$sumLast = $t_row['sumLast'];
		}
		
		if(empty($sumLast))
		{
			$sumLast = 0;
		}

#default for largest input for the week
		$sql_largest = $con->prepare("SELECT m.teamName, h.techName, y.typeName, v.envName, c.csCause, c.csSteps, c.csSavings, c.csActor, c.csDate 
					FROM costsavings c 
					INNER JOIN journeyteams m ON c.teamID = m.teamID 
					INNER JOIN technologies h ON c.techID = h.techID 
					INNER JOIN savingtypes y ON c.typeID = y.typeID 
					INNER JOIN environments v ON c.envID = v.envID
					WHERE c.csDate >= ? AND c.csDate <= ?
					ORDER BY c.csSavings DESC
					LIMIT 1");
		$sql_largest->bind_param("ss", $thisMon, $thisFri);
		$sql_largest->execute();

		$result_largest = $sql_largest->get_result();
		if(mysqli_num_rows($result_largest) == 0)
		{
			$lar_teamName = "-";
			$lar_techName = "-";
			$lar_typeName = "-";
			$lar_envName = "-";
			$lar_csCause = "No data available";
			$lar_csSteps = "No data available";
			$lar_csSavings = "-";
			$lar_csActor = "";
			$lar_csDate = "No data available";
		}
		else
		{
			while($row_largest = mysqli_fetch_array($result_largest))
			{
				$lar_teamName = $row_largest['teamName'];
				$lar_techName = $row_largest['techName'];
				$lar_typeName = $row_largest['typeName'];
				$lar_envName = $row_largest['envName'];
				$lar_csCause = $row_largest['csCause'];
				$lar_csSteps = $row_largest['csSteps'];
				$lar_csSavings = $row_largest['csSavings'];
				$lar_csActor = $row_largest['csActor'];
				$lar_csDate = $row_largest['csDate'];
			}
		}

#default monthly total (bar graph)
		for($i = 1; $i <= $valMonth; $i++)
		{
			#$monthName = date('F', mktime(null, null, null, $i, 1));
			#loop the sql statements for the monthly data
			$sql_barData = "SELECT SUM(csSavings) AS 'totSavings' FROM costsavings 
							WHERE MONTH(csDate) = $i
							GROUP BY MONTH(csDate)";
			$result_barData = $con->query($sql_barData) or die(mysqli_error($con));
	
			while($bar_row = mysqli_fetch_array($result_barData))
			{
				$bar_cs = $bar_row['totSavings'];
				if(empty($bar_cs) || $bar_cs === NULL)
				{
					$bar_cs = 0;
				} 
				else 
				{
					$bar_cs = $bar_row['totSavings'];
				}
			}
			$data_bar .= $bar_cs . ",";
		}
		$data_bar .= "],";

#default pie/doughnut charts
	#cost savings per team
		$sql_team_default = $sql_team . " GROUP BY c.teamID";
		$result_team = $con->query($sql_team_default) or die(mysqli_error($con));
	
		while($row = mysqli_fetch_array($result_team))
		{
			$teamArray[] = $row['teamName'];
			$tsavingsArray[] = $row['totSavings'];
		}
	
		$tsavings_list = '[' . implode(', ', $tsavingsArray) . '],';
		$teams_list = '["' . implode('", "', $teamArray) . '"],';

	#cost savings per environment
		$sql_env_default = $sql_env . " GROUP BY c.envID";
		$result_env = $con->query($sql_env_default) or die(mysqli_error($con));
	
		while($e_row = mysqli_fetch_array($result_env))
		{
			$envArray[] = $e_row['envName'];
			$esavingsArray[] = $e_row['totSavings'];
		}
	
		$esavings_list = '[' . implode(', ', $esavingsArray) . '],';
		$env_list = '["' . implode('", "', $envArray) . '"],';

	#cost savings per technology
		$sql_tech_default = $sql_tech . " GROUP BY c.techID";
		$result_tech = $con->query($sql_tech_default) or die(mysqli_error($con));
	
		while($h_row = mysqli_fetch_array($result_tech))
		{
			$techArray[] = $h_row['techName'];
			$hsavingsArray[] = $h_row['totSavings'];
		}
	
		$hsavings_list = '[' . implode(', ', $hsavingsArray) . '],';
		$tech_list = '["' . implode('", "', $techArray) . '"],';

	#cost savings per savings type
		$sql_type_default = $sql_type . " GROUP BY c.typeID";
		$result_type = $con->query($sql_type_default) or die(mysqli_error($con));
	
		while($y_row = mysqli_fetch_array($result_type))
		{
			$typeArray[] = $y_row['typeName'];
			$ysavingsArray[] = $y_row['totSavings'];
		}
	
		$ysavings_list = '[' . implode(', ', $ysavingsArray) . '],';
		$type_list = '["' . implode('", "', $typeArray) . '"],';

#default 10 latest initiative input
		$sql_latest_default = $sql_latest . " ORDER BY csDate DESC LIMIT 10";
		$result_latest = $con->query($sql_latest_default) or die(mysqli_error($con));
	
		$list_latest = "";
		while($l_row = mysqli_fetch_array($result_latest))
		{
			$csDate = htmlspecialchars($l_row['csDate']);
			$teamName = htmlspecialchars($l_row['teamName']);
			$techName = htmlspecialchars($l_row['techName']);
			$typeName = htmlspecialchars($l_row['typeName']);
			$envName = htmlspecialchars($l_row['envName']);
			$csSavings = htmlspecialchars($l_row['csSavings']);

			#display the date without the year
			$displayDate = date_format(date_create($csDate), 'm/d');
	
			$list_latest .= "
				<tr>
	            	<td>$displayDate</td>
	            	<td>$teamName</td>
	            	<td>$techName</td>
	            	<td>$envName</td>
	            	<td>$typeName</td>
	            	<td>
	            		<span class='float-left'>$</span>
	            		<span class='float-right'>$csSavings</span>
	            	</td>
	            </tr>";
		}
	}

	#code for when the filter button is pressed
	if(isset($_POST['btnFilter']))
	{
		#get the value from the selected item in the dropdown list
		$filterTeam = $_POST['filterTeam'];

		#redirect to a specific link based on the value
		header('location: ' . $_SERVER['PHP_SELF'] . $filterTeam);
	}
?>
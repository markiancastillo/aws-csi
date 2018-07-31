<?php
	$pageTitle = "Dashboard";
	$metaTitle = "Cost Savings Dashboard";

	# This is used by Slack as a default title for the share text
	$metaTitle = "Cost Savings Knowledge Base - Dashboard";
	# This is used by Facebook as its default title in the share card/link
	$metaDescription = "View analytical data from the cost savings entries.";

	# if 'viewonly' is set in the url, 
	# it loads the page with the same css and js but without the header/navbar
	if(isset($_GET['viewonly']))
	{
		include 'controllers/includes/header_viewonly.php';
		$animation = "animation: { duration: 0 },";
	}
	else
	{
		include 'includes/header.php';
		$animation = "";
	}
	
# SQL query to get the list of teams for the filter dropdown
	$sql_listTeams = "SELECT teamID, teamName FROM journeyteams";
	$result_listTeams = $con->query($sql_listTeams) or die(mysqli_error($con));

	$list_teams = "";
	while($rt = mysqli_fetch_array($result_listTeams))
	{
		$teamID = $rt['teamID'];
		$teamName = htmlspecialchars($rt['teamName']);

		# Determine which of the options should have the 'active' attribute when the records are filtered
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

# These queries are used for both the filtered and non-filtered outputs
# SQL - for the doughnut chart (breakdown by team)
	$sql_team = "SELECT j.teamName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN journeyteams j ON c.teamID = j.teamID 
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";

	$teamArray = array();
	$tsavingsArray = array();

# SQL - for the doughnut chart (breakdown by team - by project)
	$sql_proj = "SELECT p.projectName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c 
				 INNER JOIN projects p ON c.projectID = p.projectID 
				 WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";

	$projArray = array();
	$psavingsArray = array();

# SQL - for doughnut chart (breakdown by environment)
	$sql_env = "SELECT v.envName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN environments v ON c.envID = v.envID
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";

	$envArray = array();
	$esavingsArray = array();

# SQL - for doughnut chart (breakdown by Technology)
	$sql_tech = "SELECT h.techName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN technologies h ON c.techID = h.techID
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";
	$techArray = array();
	$hsavingsArray = array();

# SQL - for doughnut chart (breakdown by savings type)
	$sql_type = "SELECT y.typeName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c 
				 INNER JOIN savingtypes y ON c.typeID = y.typeID 
				 WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())";

	$typeArray = array();
	$ysavingsArray = array();

# SQL - for the 10 latest initiatives
	$sql_latest = "SELECT c.csID, c.csDate, j.teamName, h.techName, v.envName, y.typeName, c.csSavings 
				   FROM costsavings c 
				   INNER JOIN journeyteams j ON c.teamID = j.teamID 
				   INNER JOIN technologies h ON c.techID = h.techID
				   INNER JOIN environments v ON c.envID = v.envID
				   INNER JOIN savingtypes y ON c.typeID = y.typeID";

# Initialization of the values for the bar chart
# This is shared by the filtered and non-filtered outputs
	$valMonth = date('n'); 		# numeric month without leading zeros
	$data_bar = "[";			# start of the variable to be passed to the js
	$bar_cs = 0;				# holds the total for the month; defaulted to 0 in case of empty result sets

# Mics. variables (this is used mostly for muted text/card footers)
		$thisMon = date('Y-m-d', strtotime("monday this week"));
		$thisFri = date('Y-m-d', strtotime("sunday this week"));
		$lastMon = date('Y-m-d', strtotime("monday last week"));
		$lastFri = date('Y-m-d', strtotime("friday last week"));
		$headerDisplay = "";
		$pieDisplay = "Breakdown by Team";
		$tableDisplay = "";

		$mon = date_create($thisMon); $fri = date_create($thisFri);
		$cstotalDate = date_format($mon, 'F d') . ' - ' . date_format($fri, 'd, Y');

# -------- 

	# Check if the filter value is set...
	if(isset($_GET['filter']))
	{
		# Bind the value to a variable 
		$valFilter = $_GET['filter'];

		# SQL query to validate if the record being requested by the filter exists
		#$sql_validate = $con->prepare("SELECT csID FROM costsavings WHERE teamID = ?");
		#$sql_validate->bind_param("i", $valFilter);
		#$sql_validate->execute();

		$sql_validate = $con->prepare("SELECT teamName FROM journeyteams WHERE teamID = ?");
		$sql_validate->bind_param("i", $valFilter);
		$sql_validate->execute();

		$result_validate = $sql_validate->get_result();

		# if the validation query returns more than 0 rows (i.e. the record exists)
		if(mysqli_num_rows($result_validate) > 0)
		{
		# Display a header/label and change the text of one of the graphs when the data is filtered
			$sql_label = $con->prepare("SELECT teamName FROM journeyteams WHERE teamID = ?");
			$sql_label->bind_param("i", $valFilter);
			$sql_label->execute();

			$result_label = $sql_label->get_result();

			while($rl = mysqli_fetch_array($result_label))
			{
				$labelTeam = htmlspecialchars($rl['teamName']);
			}

			$headerDisplay = "Team " . $labelTeam;		# adds a header that displays the current filtered team
			$pieDisplay = "Team " . $labelTeam;			# changes the display of the team doughnut chart
			$tableDisplay = " from Team " . $labelTeam;	# appends the team name in the latest initiatives table

		# Filtered values - weekly total (current and prev. week, including percentage values)
			$sql_total = $con->prepare("SELECT SUM(csSavings) AS 'sumSavings' FROM costsavings 
										WHERE teamID = ? AND csDate >= ? AND csDate <= ?");
			$sql_total->bind_param("iss", $valFilter, $thisMon, $thisFri);
			$sql_total->execute();

			$result_total = $sql_total->get_result() or die(mysqli_error($con));

				while($row = mysqli_fetch_array($result_total))
				{
					$sumSavings = $row['sumSavings'];
				}
	
				if(empty($sumSavings) || $sumSavings === NULL)
				{
					$sumSavings = '0.00';	# a default value for when there are no records yet
				}
	
				# we get the data for the previous week for comparison
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
					$sumLast = '0.00';
				}

		# Filtered values - largest input for the current week 
			$sql_largest_filtered = $con->prepare("SELECT m.teamName, h.techName, y.typeName, v.envName, c.csCause, c.csSteps, c.csSavings, c.csDate, u.userFN, u.userLN
					FROM costsavings c 
					INNER JOIN journeyteams m ON c.teamID = m.teamID 
					INNER JOIN technologies h ON c.techID = h.techID 
					INNER JOIN savingtypes y ON c.typeID = y.typeID 
					INNER JOIN environments v ON c.envID = v.envID
					INNER JOIN users u ON c.userID = c.userID 
					WHERE c.csDate >= ? AND c.csDate <= ? AND c.teamID = ?
					ORDER BY c.csSavings DESC
					LIMIT 1");
			$sql_largest_filtered->bind_param("ssi", $thisMon, $thisFri, $valFilter);
			$sql_largest_filtered->execute();
	
			$result_largest = $sql_largest_filtered->get_result();
			if(mysqli_num_rows($result_largest) == 0)
			{
				# Setting the default values for when there are no existing records for the current week
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
					$lar_teamName = htmlspecialchars($row_largest['teamName']);
					$lar_techName = htmlspecialchars($row_largest['techName']);
					$lar_typeName = htmlspecialchars($row_largest['typeName']);
					$lar_envName = htmlspecialchars($row_largest['envName']);
					$lar_csCause = htmlspecialchars($row_largest['csCause']);
					$lar_csSteps = htmlspecialchars($row_largest['csSteps']);
					$lar_csSavings = htmlspecialchars($row_largest['csSavings']);
					$lar_csActor = htmlspecialchars($row_largest['userFN']) . ' ' . htmlspecialchars($row_largest['userLN']);
					$lar_csDate = htmlspecialchars($row_largest['csDate']);
				}
			}

		# Filtered values - total savings per month (bar chart)
			for($i = 1; $i <= $valMonth; $i++)
			{
				# The SQL queries are looped to get the data for each month
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

		# Filtered values - doughnut charts
		# Filtered breakdown by team
			$sql_team_filtered = $sql_team . " AND c.teamID = $valFilter GROUP BY c.teamID";
			$result_team = $con->query($sql_team_filtered) or die(mysqli_error($con));
	
			while($row = mysqli_fetch_array($result_team))
			{
				$teamArray[] = $row['teamName'];
				$tsavingsArray[] = $row['totSavings'];
			}
			
			# These variables will be passed to the js of the pie chart as their data set
			$tsavings_list = '[' . implode(', ', $tsavingsArray) . '],';	# Output: [val1, val2, ...],
			$teams_list = '["' . implode('", "', $teamArray) . '"],';		# Output: ['team1', 'team2', ...],

		# Filtered breakdown by projects (will replace the team pie chart when the filter is set)
			$sql_proj_filtered = $sql_proj . " AND c.teamID = $valFilter GROUP BY c.projectID";
			$result_proj = $con->query($sql_proj_filtered) or die(mysqli_error($con));

			while($row = mysqli_fetch_array($result_proj))
			{
				$projArray[] = $row['projectName'];
				$psavingsArray[] = $row['totSavings'];
			}

			# Variables to be passed to the output
			# ** Will replace the team pie chart on filter
			$tsavings_list = '[' . implode(', ', $psavingsArray) . '],';
			$teams_list = '["' . implode('", "', $projArray) . '"],';

			#$pieDisplay = "Breakdown by Project - Team " . $labelTeam;
			$pieDisplay = "Breakdown by Project";

		# Filtered breakdown by environment
			$sql_env_filtered = $sql_env . " AND c.teamID = $valFilter GROUP BY c.envID";
			$result_env = $con->query($sql_env_filtered) or die(mysqli_error($con));
	
			while($e_row = mysqli_fetch_array($result_env))
			{
				$envArray[] = $e_row['envName'];
				$esavingsArray[] = $e_row['totSavings'];
			}
			
			# Variables for the environments chart
			$esavings_list = '[' . implode(', ', $esavingsArray) . '],';
			$env_list = '["' . implode('", "', $envArray) . '"],';

		# Filtered breakdown by technology
			$sql_tech_filtered = $sql_tech . " AND c.teamID = $valFilter GROUP BY c.techID";
			$result_tech = $con->query($sql_tech_filtered) or die(mysqli_error($con));
	
			while($h_row = mysqli_fetch_array($result_tech))
			{
				$techArray[] = $h_row['techName'];
				$hsavingsArray[] = $h_row['totSavings'];
			}

			# Variables for the technology chart
			$hsavings_list = '[' . implode(', ', $hsavingsArray) . '],';
			$tech_list = '["' . implode('", "', $techArray) . '"],';

		# Filtered breakdown by savings type
			$sql_type_filtered = $sql_type . " AND c.teamID = $valFilter GROUP BY c.typeID";
			$result_type = $con->query($sql_type_filtered) or die(mysqli_error($con));
		
			while($y_row = mysqli_fetch_array($result_type))
			{
				$typeArray[] = $y_row['typeName'];
				$ysavingsArray[] = $y_row['totSavings'];
			}
			
			# Variables for the savings type chart
			$ysavings_list = '[' . implode(', ', $ysavingsArray) . '],';
			$type_list = '["' . implode('", "', $typeArray) . '"],';

		# Filtered values - latest initiavies/entries
			$sql_latest_filtered = $con->prepare($sql_latest . " WHERE c.teamID = ? ORDER BY csDate DESC LIMIT 10");
			$sql_latest_filtered->bind_param("i", $valFilter);
			$sql_latest_filtered->execute();

			$result_latest = $sql_latest_filtered->get_result();
	
			$list_latest = "";
			while($l_row = mysqli_fetch_array($result_latest))
			{
				$csID = $l_row['csID'];
				$csDate = htmlspecialchars($l_row['csDate']);
				$teamName = htmlspecialchars($l_row['teamName']);
				$techName = htmlspecialchars($l_row['techName']);
				$typeName = htmlspecialchars($l_row['typeName']);
				$envName = htmlspecialchars($l_row['envName']);
				$csSavings = htmlspecialchars($l_row['csSavings']);
	
				# Display the date on the table without the year
				$displayDate = date_format(date_create($csDate), 'm/d');
				
				# Class .clickable-row allows the table row to act as a button/hyperlink
				# that opens the details page for the selected record
				$list_latest .= "
					<tr class='clickable-row' data-href='details.php?rid=$csID' style='cursor: pointer;'>
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
			#validate if the record exists in the list of teams
			#if it does, display 'no recrds yet' value/s
			#else, redirect to the error page

			# The validation query returned 0 rows (no records match)
			# Display (redirect to) an error page
			#header('location: error.php');
		}
	}
	else 	#...display the "default"/unfiltered values (show all)
	{
	# Default values - weekly total (current and prev. week w/ percentages)
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

	# Default values - largest input for the current week
		$sql_largest = $con->prepare("SELECT m.teamName, h.techName, y.typeName, v.envName, c.csCause, c.csSteps, c.csSavings, c.csDate, u.userFN, u.userLN 
					FROM costsavings c 
					INNER JOIN journeyteams m ON c.teamID = m.teamID 
					INNER JOIN technologies h ON c.techID = h.techID 
					INNER JOIN savingtypes y ON c.typeID = y.typeID 
					INNER JOIN environments v ON c.envID = v.envID
					INNER JOIN users u ON c.userID = u.userID 
					WHERE c.csDate >= ? AND c.csDate <= ?
					ORDER BY c.csSavings DESC
					LIMIT 1");
		$sql_largest->bind_param("ss", $thisMon, $thisFri);
		$sql_largest->execute();

		$result_largest = $sql_largest->get_result();
		if(mysqli_num_rows($result_largest) == 0)
		{
			# Default values in case there are no records yet
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
				$lar_teamName = htmlspecialchars($row_largest['teamName']);
				$lar_techName = htmlspecialchars($row_largest['techName']);
				$lar_typeName = htmlspecialchars($row_largest['typeName']);
				$lar_envName = htmlspecialchars($row_largest['envName']);
				$lar_csCause = htmlspecialchars($row_largest['csCause']);
				$lar_csSteps = htmlspecialchars($row_largest['csSteps']);
				$lar_csSavings = htmlspecialchars($row_largest['csSavings']);
				$lar_csActor = htmlspecialchars($row_largest['userFN']) . ' ' . htmlspecialchars($row_largest['userLN']);
				$lar_csDate = htmlspecialchars($row_largest['csDate']);
			}
		}

	# Default values - total savings per month
		for($i = 1; $i <= $valMonth; $i++)
		{
			# Set the default value for the bar graph data
			$bar_cs = 0;

			#Loop the SQL statement to get the monthly values
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

	# Default values - doughnut charts
	# Default breakdown per team
		$sql_team_default = $sql_team . " GROUP BY c.teamID";
		$result_team = $con->query($sql_team_default) or die(mysqli_error($con));
	
		while($row = mysqli_fetch_array($result_team))
		{
			$teamArray[] = $row['teamName'];
			$tsavingsArray[] = $row['totSavings'];
		}
		
		# Variables that will be passed to the doughnut chart js
		$tsavings_list = '[' . implode(', ', $tsavingsArray) . '],';	# Output: [num1, num2, ...],
		$teams_list = '["' . implode('", "', $teamArray) . '"],';		# Output: ["team1", "team2", ...],

	# Default breakdown per environment
		$sql_env_default = $sql_env . " GROUP BY c.envID";
		$result_env = $con->query($sql_env_default) or die(mysqli_error($con));
	
		while($e_row = mysqli_fetch_array($result_env))
		{
			$envArray[] = $e_row['envName'];
			$esavingsArray[] = $e_row['totSavings'];
		}
		
		$esavings_list = '[' . implode(', ', $esavingsArray) . '],';
		$env_list = '["' . implode('", "', $envArray) . '"],';

	# Default breakdown per technology
		$sql_tech_default = $sql_tech . " GROUP BY c.techID";
		$result_tech = $con->query($sql_tech_default) or die(mysqli_error($con));
	
		while($h_row = mysqli_fetch_array($result_tech))
		{
			$techArray[] = $h_row['techName'];
			$hsavingsArray[] = $h_row['totSavings'];
		}
	
		$hsavings_list = '[' . implode(', ', $hsavingsArray) . '],';
		$tech_list = '["' . implode('", "', $techArray) . '"],';

	# Default breakdown per savings type
		$sql_type_default = $sql_type . " GROUP BY c.typeID";
		$result_type = $con->query($sql_type_default) or die(mysqli_error($con));
	
		while($y_row = mysqli_fetch_array($result_type))
		{
			$typeArray[] = $y_row['typeName'];
			$ysavingsArray[] = $y_row['totSavings'];
		}
	
		$ysavings_list = '[' . implode(', ', $ysavingsArray) . '],';
		$type_list = '["' . implode('", "', $typeArray) . '"],';

	# Default values - latest initiatives/entries
		$sql_latest_default = $sql_latest . " ORDER BY csDate DESC LIMIT 10";
		$result_latest = $con->query($sql_latest_default) or die(mysqli_error($con));
	
		$list_latest = "";
		while($l_row = mysqli_fetch_array($result_latest))
		{
			$csID = $l_row['csID'];
			$csDate = htmlspecialchars($l_row['csDate']);
			$teamName = htmlspecialchars($l_row['teamName']);
			$techName = htmlspecialchars($l_row['techName']);
			$typeName = htmlspecialchars($l_row['typeName']);
			$envName = htmlspecialchars($l_row['envName']);
			$csSavings = htmlspecialchars($l_row['csSavings']);

			#display the date without the year
			$displayDate = date_format(date_create($csDate), 'm/d');
	
			$list_latest .= "
				<tr class='clickable-row' data-href='details.php?rid=$csID' style='cursor: pointer;'>
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

	# When the filter button is pressed...
	if(isset($_POST['btnFilter']))
	{
		# Get the value of the selected item in the filter dropdown
		$filterTeam = $_POST['filterTeam'];

		# Redirect to self with the filter parameter
		header('location: ' . $_SERVER['PHP_SELF'] . $filterTeam);
	}
?>
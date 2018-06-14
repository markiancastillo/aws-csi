<?php
	$pageTitle = "Dashboard";
	include 'includes/header.php';

	error_reporting(0);
	ini_set('display_errors', 0);

	#data for the initiative summary
	#data for: this week's total
	$thisMon = date('Y-m-d', strtotime("monday this week"));
	$thisFri = date('Y-m-d', strtotime("friday this week"));
	$sql_total = "SELECT SUM(csSavings) AS 'sumSavings' FROM costsavings WHERE csDate >= '$thisMon' AND csDate <= '$thisFri'";
	$result_total = $con->query($sql_total) or die(mysqli_error($con));

	while($s_row = mysqli_fetch_array($result_total))
	{
		$sumSavings = $s_row['sumSavings'];
	}

	if(empty($sumSavings))
	{
		$sumSavings = '0.00';
	}

	#query for: comparison of last week vs this week's total
	$lastMon = date('Y-m-d', strtotime("monday last week"));
	$lastFri = date('Y-m-d', strtotime("friday last week"));
	$sql_last = "SELECT SUM(csSavings) AS 'sumLast' FROM costsavings WHERE csDate >= '$lastMon' AND csDate <= '$lastFri'";
	$result_last = $con->query($sql_last) or die(mysqi_error($con));

	while($t_row = mysqli_fetch_array($result_last))
	{
		$sumLast = $t_row['sumLast'];
	}

	if(empty($sumLast))
	{
		$sumLast = 0;
	}

	$diffLast = number_format((float)($sumSavings - $sumLast), 2, '.', '');

	if($diffLast < 0)
	{
		$arrowIcon = "<span class='fa fa-fw fa-arrow-circle-down' style='color: red'></span>";
	}
	else if($diffLast > 0)
	{
		$arrowIcon = "<span class='fa fa-fw fa-arrow-circle-up' style='color: green'></span>";
	}
	else 
	{
		$arrowIcon = "<span class='fa fa-fw fa-minus-circle' style='color: grey'></span>";
	}

	#$percDiff = number_format((float)(($sumSavings-$sumLast) / (($sumSavings + $sumLast)/2))*100, 2, '.', '');

	$percDiff = ($sumLast == 0) ? '--' : number_format((float)(($sumSavings-$sumLast) / $sumLast)*100, 2, '.', '');

	if($percDiff < 0)
	{
		$percDisplay = "<h5 class='text-center' style='color: red'>$percDiff%</h5>";
	}
	else if($percDiff > 0)
	{
		$percDisplay = "<h5 class='text-center' style='color: green'>$percDiff%</h5>";
	}
	else
	{
		$percDisplay = "<h5 class='text-center'>$percDiff%</h5>";
	}

	#query for: largest data entry for the month
	$sql_largest = "SELECT m.teamName, h.techName, y.typeName, v.envName, c.csCause, c.csSteps, c.csSavings, c.csActor 
					FROM costsavings c 
					INNER JOIN journeyteams m ON c.teamID = m.teamID 
					INNER JOIN technologies h ON c.techID = h.techID 
					INNER JOIN savingtypes y ON c.typeID = y.typeID 
					INNER JOIN environments v ON c.envID = v.envID
					WHERE c.csDate >= '$thisMon' AND c.csDate <= '$thisFri'
					ORDER BY c.csSavings DESC
					LIMIT 1";
	$result_largest = $con->query($sql_largest) or die(mysqli_error($con));

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
		}
	}

/*	for debugging:
	echo 'date today: ' . date('m-d', strtotime("today"));
	echo '<br><br>';
	echo 'last monday: ' . date('m-d', strtotime("last week monday"));
	echo '<br>';
	echo 'this monday: ' . date('m-d', strtotime("this week monday"));
	echo '<br>';
	echo 'next monday: ' . date('m-d', strtotime("next week monday"));
	echo '<br>';
*/

	$initiativeFooter = date('F d', strtotime("monday this week")) . ' to ' . date('F d, Y', strtotime("friday this week"));

	#data for the pie chart
	#data query - cost savings total per team
	$sql_team = "SELECT j.teamName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN journeyteams j ON c.teamID = j.teamID 
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())
	 			GROUP BY c.teamID";
	$result_team = $con->query($sql_team) or die(mysqli_error($con));

	$teamArray = array();
	$tsavingsArray = array();

	while($row = mysqli_fetch_array($result_team))
	{
		$teamArray[] = $row['teamName'];
		$tsavingsArray[] = $row['totSavings'];
	}

	$tsavings_list = '[' . implode(', ', $tsavingsArray) . '],';
	$teams_list = '["' . implode('", "', $teamArray) . '"],';

	#data query - cost savings total per environment
	$sql_env = "SELECT v.envName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN environments v ON c.envID = v.envID
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())
	 			GROUP BY c.envID";
	$result_env = $con->query($sql_env) or die(mysqli_error($con));

	$envArray = array();
	$esavingsArray = array();

	while($e_row = mysqli_fetch_array($result_env))
	{
		$envArray[] = $e_row['envName'];
		$esavingsArray[] = $e_row['totSavings'];
	}

	$esavings_list = '[' . implode(', ', $esavingsArray) . '],';
	$env_list = '["' . implode('", "', $envArray) . '"],';

	#data query - cost savings total per technology
	$sql_tech = "SELECT h.techName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c
				INNER JOIN technologies h ON c.techID = h.techID
				WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())
	 			GROUP BY c.techID";
	$result_tech = $con->query($sql_tech) or die(mysqli_error($con));

	$techArray = array();
	$hsavingsArray = array();

	while($h_row = mysqli_fetch_array($result_tech))
	{
		$techArray[] = $h_row['techName'];
		$hsavingsArray[] = $h_row['totSavings'];
	}

	$hsavings_list = '[' . implode(', ', $hsavingsArray) . '],';
	$tech_list = '["' . implode('", "', $techArray) . '"],';

	#data query - cost savings total per cost savings type
	$sql_type = "SELECT y.typeName, SUM(c.csSavings) AS 'totSavings' FROM costsavings c 
				 INNER JOIN savingtypes y ON c.typeID = y.typeID 
				 WHERE MONTH(c.csDate) = MONTH(CURRENT_DATE())
				 GROUP BY c.typeID";
	$result_type = $con->query($sql_type) or die(mysqli_error($con));

	$typeArray = array();
	$ysavingsArray = array();

	while($y_row = mysqli_fetch_array($result_type))
	{
		$typeArray[] = $y_row['typeName'];
		$ysavingsArray[] = $y_row['totSavings'];
	}

	$ysavings_list = '[' . implode(', ', $ysavingsArray) . '],';
	$type_list = '["' . implode('", "', $typeArray) . '"],';

	$valMonth = date('n'); #numeric month without leading zeros
	$data_bar = "[";
	$bar_cs = 0;
	for($i = 1; $i <= $valMonth; $i++)
	{
		#$monthName = date('F', mktime(null, null, null, $i, 1));
		#loop the sql statements for the monthly data (past 5 months)
		$sql_barData = "SELECT SUM(csSavings) AS 'totSavings' FROM costsavings 
						WHERE MONTH(csDate) = $i
						GROUP BY MONTH(csDate)";
		$result_barData = $con->query($sql_barData) or die(mysli_error($con));

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

	#get the label data -- past 5 months label/s
	#$offset = 3;
	function getMonthStr($offset)
	{
    	return date("M", strtotime("$offset months"));
	}

	$months = array_map('getMonthStr', range(-4,-0));
	$months_list = '["' . implode('", "', $months) . '"],';

	#data query for the line graph
	#get the data for the (line 1)

	#get the data for the (line 2)
	#get the data for the (line 3)

	#data query - records for latest initiatives chart/table
	$sql_latest = "SELECT c.csDate, j.teamName, y.typeName, c.csSavings FROM costsavings c 
				   INNER JOIN journeyteams j ON c.teamID = j.teamID 
				   INNER JOIN savingtypes y ON c.typeID = y.typeID 
				   ORDER BY csDate DESC LIMIT 10";
	$result_latest = $con->query($sql_latest) or die(mysqli_error($con));

	$list_latest = "";
	while($l_row = mysqli_fetch_array($result_latest))
	{
		$csDate = htmlspecialchars($l_row['csDate']);
		$teamName = htmlspecialchars($l_row['teamName']);
		$typeName = htmlspecialchars($l_row['typeName']);
		$csSavings = htmlspecialchars($l_row['csSavings']);

		$list_latest .= "
			<tr>
            	<td>$csDate</td>
            	<td>$teamName</td>
            	<td>$typeName</td>
            	<td>
            		<span class='float-left'>$</span>
            		<span class='float-right'>$csSavings</span>
            	</td>
            </tr>";
	}
?>
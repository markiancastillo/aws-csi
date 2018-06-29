<?php
	$pageTitle = "Search Results";
	include_once 'controllers/includes/header.php';

	# Check if a post value was passed
	if(empty($_POST))
	{ 
		header('location: error.php');
	}
	else 
	{
		# Get the search keyword that was entered
		$searchKey = htmlspecialchars($_POST['inpSearch']);
	
		# The initial SQL statement for querying the data
	    $stmt_search = "SELECT s.csID, s.csCause, s.csSteps, s.csActor, s.csDate, s.csSavings, s.csInitial, s.csFinal, m.teamName, h.techName, e.envName, y.typeName 
						FROM costsavings s 
						INNER JOIN journeyteams m ON s.teamID = m.teamID 
						INNER JOIN technologies h ON s.techID = h.techID 
						INNER JOIN environments e ON s.envID = e.envID 
						INNER JOIN savingtypes y ON s.typeID = y.typeID ";
		$stmt_order = " ORDER BY s.csDate DESC";
	
		# Check if the input is empty
		if(empty(trim($searchKey)))
		{
			# If the key is blank/empty, display all the records
	    	$sql_search = $stmt_search . $stmt_order;
	    	$result_search = $con->query($sql_search) or die(mysqli_error($sql_search));
		}
		else 
		{
			#else, filter columns with the key as parameter on the LIKE operator
	    	$sql_search = $con->prepare($stmt_search . 
	    				"WHERE csCause LIKE CONCAT ('%', ?, '%') 
	    					OR csSteps LIKE CONCAT ('%', ?, '%') 
	    					OR csActor LIKE CONCAT ('%', ?, '%') 
	    					OR csDate LIKE CONCAT ('%', ?, '%') 
	    					OR csSavings LIKE CONCAT ('%', ?, '%') 
	    					OR csInitial LIKE CONCAT ('%', ?, '%') 
	    					OR csFinal LIKE CONCAT ('%', ?, '%') 
	    					OR m.teamName LIKE CONCAT ('%', ?, '%') 
	    					OR h.techName LIKE CONCAT ('%', ?, '%') 
	    					OR e.envName LIKE CONCAT ('%', ?, '%') 
	    					OR y.typeName LIKE CONCAT ('%', ?, '%') " . $stmt_order);
	    	$sql_search->bind_param("sssssssssss", $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey);
	    	$sql_search->execute();
	
	    	$result_search = $sql_search->get_result();
		}
	
		# Get the results and display in a table
		$search_table = "";
		while($row = mysqli_fetch_array($result_search))
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
	
			$search_table .= "
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
		}
	}
?>
<?php
	$pageTitle = "Search Results";
	include_once 'controllers/includes/header.php';

	# Initialize/set the default value for the page header
	$displayHeader = "";

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
	    $stmt_search = "SELECT s.csID, s.csCause, s.csSteps, s.csDate, s.csSavings, s.csInitial, s.csFinal, m.teamName, h.techName, e.envName, y.typeName, u.userFN, u.userLN
						FROM costsavings s 
						INNER JOIN journeyteams m ON s.teamID = m.teamID 
						INNER JOIN technologies h ON s.techID = h.techID 
						INNER JOIN environments e ON s.envID = e.envID 
						INNER JOIN savingtypes y ON s.typeID = y.typeID 
						INNER JOIN users u ON s.userID = u.userID ";
		$stmt_order = " ORDER BY s.csDate DESC";
	
		# Check if the input is empty
		if(empty(trim($searchKey)))
		{
			# Header to display if no search key is specified
			$displayHeader = "Displaying All Records";

			# If the key is blank/empty, display all the records
	    	$sql_search = $stmt_search . $stmt_order;
	    	$result_search = $con->query($sql_search) or die(mysqli_error($sql_search));
		}
		else 
		{
			# Header to display if there is a search key specified
			$displayHeader = 'Displaying results with "' . $searchKey . '"';
			#else, filter columns with the key as parameter on the LIKE operator
	    	$sql_search = $con->prepare($stmt_search . 
	    				"WHERE csCause LIKE CONCAT ('%', ?, '%') 
	    					OR csSteps LIKE CONCAT ('%', ?, '%') 
	    					OR u.userFN LIKE CONCAT ('%', ?, '%') 
	    					OR u.userLN LIKE CONCAT ('%', ?, '%') 
	    					OR csDate LIKE CONCAT ('%', ?, '%') 
	    					OR csSavings LIKE CONCAT ('%', ?, '%') 
	    					OR csInitial LIKE CONCAT ('%', ?, '%') 
	    					OR csFinal LIKE CONCAT ('%', ?, '%') 
	    					OR m.teamName LIKE CONCAT ('%', ?, '%') 
	    					OR h.techName LIKE CONCAT ('%', ?, '%') 
	    					OR e.envName LIKE CONCAT ('%', ?, '%') 
	    					OR y.typeName LIKE CONCAT ('%', ?, '%') " . $stmt_order);
	    	$sql_search->bind_param("ssssssssssss", $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey, $searchKey);
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
			$userName = htmlspecialchars($row['userFN']) . ' ' . htmlspecialchars($row['userLN']);
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
	                <td>$userName</td>
	                <td>
                    <span class='float-left'>$</span>
                    	<span class='float-right'>$csInitial</span>
                	</td>
                	<td>$csSteps</td>
                	<td>
                	    <span class='float-left'>$</span>
                	    <span class='float-right'>$csFinal</span>
                	</td>
	                <td>
	                    <span class='float-left'>$</span>
	                    <span class='float-right'>$csSavings</span>
	                </td>
	            </tr>";
		}
	}
?>
<?php
	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');

    session_start();

    if(isset($_SESSION['accID']))
    {
        $msgDisplay = "";
        
        # Change the format of the datetime input and set default to the date today
        $dateToday = new DateTime(date("Y-m-d"));
        
        # Bind the session ID to a variable
        $accID = $_SESSION['accID'];
        
        #Get the user ID using the session ID
        $userID = getUserID($con, $accID);

        # Get the default values for the dropdowns
        $sql_default = $con->prepare("SELECT envID, teamID, techID FROM users WHERE userID = ?");
        $sql_default->bind_param("i", $userID);
        $sql_default->execute();
    
        $result_default = $sql_default->get_result();
    
        while ($row = mysqli_fetch_array($result_default)) 
        {
            # Get the values...
            $def_envID = $row['envID'];
            $def_teamID = $row['teamID'];
            $def_techID = $row['techID'];
        }
    
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
            #$inpName = mysqli_real_escape_string($con, $_POST['inpName']); -- will be automatically added via session ID
            $inpDate = mysqli_real_escape_string($con, $_POST['inpDate']);
    
            addRecord($con, $inpTeam, $inpEnv, $inpTech, $inpType, $inpInitial, $inpFinal, $totSavings, $inpCause, $inpSteps, $inpDate, $userID);

            $txtEvent = "Added a new cost savings entry dated " . $inpDate . ", with a total savings of $" . $totSavings;
            logEvent($con, $accID, $txtEvent);

            $msgDisplay = successAlert("Successfully added a new record!");
            header('Refresh: 1');
        }
    }
    else
    {
        header('location: login.php');
    }
?>
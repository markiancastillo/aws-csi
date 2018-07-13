<?php
	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');

    session_start();

    if(isset($_SESSION['accID']))
    {
        $dateToday = new DateTime(date("Y-m-d"));
        $msgDisplay = "";
        $accID = $_SESSION['accID'];
    
        if(isset($_POST['btnAdd']))
        {
            #Get the user ID using the session ID
            $userID = getUserID($con, $accID);
    
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
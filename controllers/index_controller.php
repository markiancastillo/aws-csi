<?php
	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');

    $dateToday = new DateTime(date("Y-m-d"));

    $msgDisplay = "";

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

        addRecord($con, $inpTeam, $inpEnv, $inpTech, $inpType, $inpInitial, $inpFinal, $totSavings, $inpCause, $inpSteps, $inpName, $inpDate);

        $msgDisplay = successAlert("Successfully added a new record!");
        header('Refresh: 1');
    }
?>
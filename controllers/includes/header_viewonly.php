<?php
	include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- For IE 9 and below. ICO should be 32x32 pixels in size -->
    <!--[if IE]><link rel="shortcut icon" href="images/icons/awslogo.png"><![endif]-->
    <!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. -->
    <link rel="apple-touch-icon-precomposed" href="images/icons/awslogo.png">
    <!-- Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size. -->
    <link rel="icon" href="images/icons/awslogo.png">

    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $pageTitle; ?></title>
	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="lib/fontawesome/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link href="lib/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="css/sb-admin.css" rel="stylesheet">
    <link href="lib/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">
    function takeScreenshot() 
    {
        // Calls the html2canvas API to generate a screenshot
        // Hide buttons (usually the screenshot button and the back button)
        var bu = document.getElementById('formButtons');
        if (bu.style.display === 'none') {
            bu.style.display = 'block';
        } else {
            bu.style.display = 'none';
        }

        // Take screenshot (by calling the API)
        // (html2canvas generates an image by recreating the elements of the html body)
        html2canvas(document.body).then(function(canvas) {
            document.body.appendChild(canvas);
        });

        // Hide form div (so only the screenshot will remain visible on the page)
        setTimeout(function() {
            var x = document.getElementById('formDiv');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            };
        }, 1500);
    }
    </script>

    <style type="text/css">
        .vertical-center {
            min-height: 100%;
            min-height: 100vh;

            display: flex;
            align-items: center;
        }

        .vertical-center-offset {
            min-height: 50%;
            min-height: 50vh;

            max-height: 50%;
            max-height: 50vh;

            display: flex;
            align-items: center;
        }
    </style>
</head>
<body id='page-top' onload="takeScreenshot()">
	<div class="container-fluid">
       	<div class="row">
       		<div class="col-12">
			<!-- Bootstrap core JavaScript-->
            <script src="js/jquery-3.3.1.min.js"></script>
            <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Core plugin JavaScript-->
            <script src="js/jquery.easing.min.js"></script>
            <!-- Chart.js JavaScript-->
            <script src="js/Chart.min.js"></script>
            <!-- Chart.js Datalabels plugin -->
            <script src="lib/chartjs-datalabels/chartjs-plugin-datalabels.js"></script>
            <!-- Data Tables js -->
            <script src="lib/datatables/jquery.dataTables.js"></script>
            <script src="lib/datatables/dataTables.bootstrap4.js"></script>
            <script src="lib/datatables/dataTables.pageResize.min.js"></script>
            <!-- sb-admin template js -->
            <script src="js/sb-admin.min.js"></script>
            <script src="js/sb-admin-datatables.min.js"></script>
            <script src="js/sb-admin-charts.min.js"></script>
            <!-- jasny boostrap -->
            <script src="lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
            <!-- input masking -->
            <script src="js/jquery.maskMoney.min.js"></script>
            <!-- AddThis Share Buttons js -->
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b0220ddd0e5d139"></script>
            <!-- html2canvas js -->
            <script type="text/javascript" src="js/html2canvas.min.js"></script>
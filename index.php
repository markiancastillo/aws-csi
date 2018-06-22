<?php
	#include 'controllers/index_controller.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- For IE 9 and below. ICO should be 32x32 pixels in size -->
    <!--[if IE]><link rel="shortcut icon" href="images/icons/awslogo.png"><![endif]-->
    <!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. -->
    <link rel="apple-touch-icon-precomposed" href="images/icons/awslogo.png">
    <!-- Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size. -->
    <link rel="icon" href="images/icons/awslogo.png">

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="lib/fontawesome/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link href="css/sb-admin.css" rel="stylesheet">

	<title>AWS Cost Savings Knowledge Base</title>

	<style type="text/css">
		.vertical-center {
			min-height: 100%;
			min-height: 100vh;

			display: flex;
			align-items: center;
		}
	</style>
</head>
<body>
	<div class="jumbotron jumbotron-fluid vertical-center">
		<div class="container">
			<h1 class="display-4 text-center">Cost Savings Knowledge Base</h1>
			<p class="lead text-center">Some description goes here...</p>
			<hr class="my-4">
			<p class="lead text-center">
				<a class="btn btn-primary btn-lg" href="dashboard.php" role="button">Dashboard</a>
				<a class="btn btn-primary btn-lg" href="view.php" role="button">Cost Savings Table</a>
			</p>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="js/jquery.easing.min.js"></script>
	<!-- sb-admin template js -->
	<script src="js/sb-admin.min.js"></script>
	<script src="js/sb-admin-datatables.min.js"></script>
	<script src="js/sb-admin-charts.min.js"></script>
</body>
</html>
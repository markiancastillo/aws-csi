<?php
    include 'controllers/header_controller.php';
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

    <meta property="og:url" content="<?php echo $current_uri; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="AWS Cost Savings Initiative - Dashboard">
    <meta property="og:description" content="View the cost savings initiative dashboard.">
    <meta property="og:image" content="<?php echo $imglink; ?>">

    <meta name="description" content="">
    <meta name="author" content="">
	<title><?php echo $pageTitle; ?></title>
	<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="lib/fontawesome/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link href="lib/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<link href="css/sb-admin.css" rel="stylesheet">
    <link href="lib/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">

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
<body class="fixed-nav bg-dark" id="page-top">
<script>
    //Facebook SDK
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '619686831726851',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v3.0'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Navigation bar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
		<a class="navbar-brand" href="">AWS Cost Savings Knowledge Base</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav navbar-sidenav" id="navAccordion">
				<li class="nav-item <?php echo $pageTitle === 'Dashboard' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="dashboard.php">
                        <i class="fas fa-fw fa-chart-pie"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?php echo $pageTitle === 'Cost Savings' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Cost Savings">
                    <a class="nav-link" href="view.php">
                        <i class="fas fa-fw fa-piggy-bank"></i>
                        <span class="nav-link-text">Cost Savings</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Manage Data">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAddData" data-parent="#navAccordion">
                        <i class="fas fa-fw fa-folder-open"></i>
                        <span class="nav-link-text">Manage Data</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseAddData">
                        <li class="<?php echo $pageTitle === 'AWS/DevOps Technologies' ? 'active' : ''; ?>"><a href="add_tech.php">AWS/DevOps Technologies</a></li>
                        <li class="<?php echo $pageTitle === 'Cost Savings Types' ? 'active' : ''; ?>"><a href="add_type.php">Cost Savings Types</a></li>
                        <li class="<?php echo $pageTitle === 'Environments' ? 'active' : ''; ?>"><a href="add_env.php">Environments</a></li>
                        <li class="<?php echo $pageTitle === 'Journey Teams' ? 'active' : ''; ?>"><a href="add_jt.php">Journey Teams</a></li>
                    </ul>
                </li>   
			</ul>
			<ul class="navbar-nav sidenav-toggler">
				<li class="nav-item">
					<a class="nav-link text-center" id="sidenavToggler">
						<i class="fa fa-fw fa-angle-left"></i>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
                <!-- ** Screenshot button used to call screenshotlayer's API
                <form method="POST">
                    <li class="nav-item">
                        <a href="<?php #echo $imglink; ?>" class="nav-link btn btn-basic btn-block" target="_blank" title="Screenshot page">
                            <span><i class="fa fa-fw fa-camera fa-lg"></i></span> 
                             Save a Screenshot (X)
                        </a>
                    </li>
                </form>-->
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbardrop" data-toggle="dropdown">
                        User
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="">Menu 1</a>
                        <a class="dropdown-item" href="">Logout</a>
                    </div>
                </li>-->
				<li class="nav-item">
                    <a class="nav-link btn btn-basic btn-block" data-toggle="modal" data-target="#logoutModal" title="Logout">
                        <i class="fas fa-fw fa-sign-out-alt fa-lg"></i>
                         Logout
                    </a>
                </li>
			</ul>
		</div>
	</nav>
	<div class="content-wrapper">
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

                <!-- custom scripts -->
                <script type="text/javascript">
                    // Clickable table rows
                    jQuery(document).ready(function($) {
                        $(".clickable-row").click(function() {
                            window.location = $(this).data("href");
                        });
                    });
                </script>

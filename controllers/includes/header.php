<?php
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/function.php');
    include_once str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['PHP_SELF']) . '/controllers/config.php');

    ob_start();

    //change the default timezone for the date/time functions
    date_default_timezone_set("Asia/Singapore");

    if(isset($_POST['btnScreen']))
    {
        #note: imagegrabscreen() only works on windows
        $im = imagegrabscreen();
        imagepng($im, "screenshot.png");
    }

    $coverImg = "https://i.imgur.com/3iJPCfj.png";

    // set optional parameters (leave blank if unused)
    $params['fullpage']  = '1';    
    $params['width'] = '';      
    $params['viewport']  = '';  
    $params['format'] = '';      
    $params['css_url'] = '';      
    $params['delay'] = '';      
    $params['ttl'] = '';  
    $params['force']     = '1';     
    $params['placeholder'] = '';      
    $params['user_agent'] = '';      
    $params['accept_lang'] = '';      
    $params['export'] = '';

    # get the current url of the page to pass into the og:image meta tag
    $current_uri = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    #call Screenshotlayer's API
    #$url = "http://castillomi.000webhostapp.com/content/about.php";
    $imglink = screenshotlayer($current_uri, $params);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta property="og:url" content="<?php echo $current_uri; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Cost Savings Initiative - Dashboard">
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
		<a class="navbar-brand" href="index.php">AWS Cost Savings Initiative</a>
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav navbar-sidenav" id="navAccordion">
                <li class="nav-item <?php echo $pageTitle === 'Account' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Account">
                    <a class="nav-link" href="">
                        <i class="fa fa-fw fa-user-circle"></i>
                        <span class="nav-link-text">Current_User</span>
                    </a>
                </li>
				<li class="nav-item <?php echo $pageTitle === 'Dashboard' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.php">
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
				<li class="nav-item" data-toggle="tooltip" data-placement="right" title="New Page">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#navAccordion">
                        <i class="fas fa-fw fa-sitemap"></i>
                        <span class="nav-link-text">Page</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseMulti">
                        <li><a href="#">Second Level Item</a></li>
                        <li><a href="#">Second Level Item</a></li>
                        <li><a href="#">Second Level Item</a></li>
                        <li>
                            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Third Level</a>
                            <ul class="sidenav-third-level collapse" id="collapseMulti2">
                                <li><a href="#">Third Level Item</a></li>
                                <li><a href="#">Third Level Item</a></li>
                                <li><a href="#">Third Level Item</a></li>
                            </ul>
                        </li>
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
                <form method="POST">
                    <a href="<?php echo $imglink; ?>" class="btn btn-light" target="_blank" download="screenshot.png">
                        <span><i class="fa fa-fw fa-camera"></i></span> Save a Screenshot
                    </a>
                </form>
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
                    <a class="nav-link" data-toggle="modal" data-target="#logoutModal" title="Logout">
                        <i class="fas fa-fw fa-sign-out-alt fa-lg"></i>
                    </a>
                </li>
			</ul>
		</div>
	</nav>
	<div class="content-wrapper">
		<div class="container-fluid">
			<!-- Breadcrumbs
        	<ol class="breadcrumb">
        		<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
        		<li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
        	</ol>-->
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
				<!-- sb-admin template js -->
				<script src="js/sb-admin.min.js"></script>
				<script src="js/sb-admin-datatables.min.js"></script>
				<script src="js/sb-admin-charts.min.js"></script>
                <!-- jasny boostrap -->
                <script src="lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
                <!-- input masking -->
                <script src="js/jquery.maskMoney.min.js"></script>

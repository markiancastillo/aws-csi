<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/prog/controllers/function.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/prog/controllers/config.php';

    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $pageTitle; ?></title>
    <!-- bootstrap css -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">-->
    <!-- font awesome css -->
    <link href="lib/fontawesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css">
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">-->
    <!-- sb-admin template css -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- data tables css -->
    <link href="lib/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- jquery js -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <!-- bootstrap js -->
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="lib/bootstrap/js/bootstrap.min.js"></script> -->
    <!-- sb-admin template js -->
    <script src="js/sb-admin.min.js"></script>
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="lib/datatables/jquery.dataTables.js"></script>
    <script src="lib/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/Chart.min.js"></script>
</head>
<body class="fixed-nav bg-dark" id="page-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.php">AWS Cost Savings Initiative</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="navAccordion">
                <li class="nav-item <?php echo $pageTitle === 'Dashboard' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-chart-pie"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item <?php echo $pageTitle === 'Cost Savings' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="view.php">
                        <i class="fas fa-fw fa-piggy-bank"></i>
                        <span class="nav-link-text">Cost Savings</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add New Data">
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
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#navAccordion">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span class="nav-link-text">Page</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li><a href="">MenuPage</a></li>
                        <li><a href="">MenuPage</a></li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#navAccordion">
                        <i class="fas fa-fw fa-file"></i>
                        <span class="nav-link-text">Page</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                        <li><a href="">MenuPage</a></li>
                        <li><a href="">MenuPage</a></li>
                        <li><a href="">MenuPage</a></li>
                        <li><a href="">MenuPage</a></li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
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
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                    <a class="nav-link" href="">
                        <i class="fas fa-fw fa-link"></i>
                        <span class="nav-link-text">Page</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler" onclick="toggleNav()">
                        <i class="fas fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-envelope"></i>
                        <span class="d-lg-none">Messages
                            <span class="badge badge-pill badge-primary">12 New</span>
                        </span>
                        <span class="indicator text-primary d-none d-lg-block">
                            <i class="fas fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">New Messages:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>David Miller</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>Jane Smith</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <strong>John Doe</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all messages</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-bell"></i>
                        <span class="d-lg-none">Alerts
                            <span class="badge badge-pill badge-warning">6 New</span>
                        </span>
                        <span class="indicator text-warning d-none d-lg-block">
                            <i class="fas fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">New Alerts:</h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong><i class="fas fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <span class="text-danger">
                                    <strong><i class="fas fa-long-arrow-down fa-fw"></i>Status Update</strong>
                                </span>
                                <span class="small float-right text-muted">11:21 AM</span>
                                <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                            </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <span class="text-success">
                                <strong><i class="fas fa-long-arrow-up fa-fw"></i>Status Update</strong>
                            </span>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item small" href="#">View all alerts</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-fw fa-sign-out-alt"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="container-fluid">
        <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><?php echo $pageTitle; ?></li>
            </ol>
            <div class="row">
                <div class="col-12">
<!--                <h1>Blank</h1>
                    <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p>
                </div>
            </div>
        </div>
/.container-fluid
/.content-wrapper
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright © Your Website 2018</small>
                </div>
            </div>
        </footer>
Scroll to Top Button
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
Logout Modal
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
-->
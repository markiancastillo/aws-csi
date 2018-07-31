<?php
	include 'controllers/index_controller.php';
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
		body {
			position: fixed;
		    top: 0;
		    left: 0;
		    width: 100%;
		    height: 100%;
			/* background-image: url('images/background.jpg'); */
    		background-repeat: no-repeat;
    		background-attachment: fixed;
    		background-size: 100%;
    		opacity: 0.9;
		}

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
			<h1 class="display-3 text-center"><strong>AWS Cost Savings Knowledge Base</strong></h1>
			<br class="my-3" />
			<div class="col-lg-8 offset-lg-2">
			<p class="lead text-center">
				<form class="form-horizontal" method="POST" action="search.php">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-search fa-fw"></i></span>
						</div>
						<input type="text" class="form-control"	placeholder="Enter a keyword..." name="inpSearch" id="inpSearch">
						<div class="input-group-append">
							<button class="btn btn-dark" name="btnSearch" id="btnSearch">&emsp; Search &emsp;</button>
						</div>
					</div>
				</form>
			</p>
			<p class="lead text-center">
				<a href="view.php" class="btn btn-outline-dark" class="form-control"><i class="fa fa-fw fa-list-ul"></i> View All Records</a>
				<button class="btn btn-outline-dark" data-toggle="modal" data-target="#addCSModal" name="btnAdd" id="btnAdd"><i class="fa fa-fw fa-plus"></i> Add New</button>
			</p>
			</div>
			<div class="col-lg-8 offset-lg-2">
				<?php echo $msgDisplay; ?>
			</div>
		</div>
	</div>

<!-- Modal for creating a new record -->
<div class="modal fade" id="addCSModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">New Cost Savings Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpTeam">Journey Team</label>
                                <select class="form-control" name="inpTeam" id="inpTeam" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTeams($con, $def_teamID); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpEnv">Environment</label>
                                <select class="form-control" name="inpEnv" id="inpEnv" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listEnvironments($con, $def_envID); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpTech">Cloud/DevOps Technology</label>
                                <select class="form-control" name="inpTech" id="inpTech" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTech($con, $def_techID); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpType">Cost Savings Type</label>
                                <select class="form-control" name="inpType" id="inpType" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTypes($con); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpProj">Project Group</label>
                                <select class="form-control" name="inpProj" id="inpProj" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listProjects($con); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpInitial">Inital Cost</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpInitial" id="inpInitial" required="true"  />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpFinal">Final Cost</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpFinal" id="inpFinal" required="true" onkeyup="getTotal()" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpCause">Root Cause</label>
                                <textarea class="form-control" rows="10" name="inpCause" id="inpCause" maxlength="800" placeholder="Details of the problem encountered..." required="true"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpSteps">Solution/s Implemented</label>
                                <textarea class="form-control" rows="10" name="inpSteps" id="inpSteps" maxlength="800" placeholder="Steps taken in order to resolve the issue/s encountered..." required="true"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6" style="display: none">
                            <div class="form-group">
                                <label for="inpName">Action Executed By</label>
                                <input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" placeholder="Enter a name..." value="John Doe" required="true">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDate">Completion Date</label>
                                <input class="form-control" type="date" name="inpDate" id="inpDate" min="2018-01-01" max="<?php echo $dateToday->format('Y-m-d'); ?>" required="true">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDate">Total Savings</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="sampledisp" name="sampledisp" readonly="true" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd">Add Record</button>
                </div>
            </form>
        </div>
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
	<!-- input masking -->
    <script src="js/jquery.maskMoney.min.js"></script>
    <!-- Some custom js for the input masking, default input values, etc. -->
    <script type="text/javascript" src="js/custom.js"></script>
</body>
</html>
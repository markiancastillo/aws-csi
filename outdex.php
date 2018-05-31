<?php 
	include('controllers/outdex_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageTitle; ?></title>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/fontawesome/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link href="lib/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="lib/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color: lightgrey">
    <div class="container">
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
            <div class="card-header">
            	<h5>Initiative Summary</h5>
            </div>
            <div class="card-body">
            	<div class="card-group">
            		<div class="card">
            			<div class="card-body text-center">
            				<p class="card-text">
            					This Week's Total
            					<h3>
                                   <span data-html="true" data-toggle="popover" data-trigger="hover" data-content="
                                   <?php echo $percDisplay; ?> 
                                   Compared to last week: <br /> 
                                   $<?php echo number_format((float)$sumLast, 2, '.', ','); ?> (&Delta; $<?php echo number_format((float)$diffLast, 2, '.', ','); ?>) <br />">
            					       <span class="fa fa-fw fa-dollar-sign"></span>
            					       <?php echo number_format((float)$sumSavings, 2, '.', ','); ?>
            					       <?php echo $arrowIcon; ?>
                                   </span>
            					</h3>
            				</p>
            			</div>
            		</div>
            		<div class="card">
            			<div class="card-body text-center">
            				<p class="card-text">
            					Largest Entry
            					<h3>
                                    <span data-html="true" data-toggle="popover" data-trigger="hover" data-content="
                                    <strong>Team: </strong><?php echo $lar_teamName; ?><br /> 
                                    <strong>Technology: </strong><?php echo $lar_techName; ?><br /> 
                                    <strong>Type: </strong><?php echo $lar_typeName; ?><br/> 
                                    <strong>Environment: </strong><?php echo $lar_envName; ?><br /><br />
                                    <?php echo $lar_csDesc . ' - ' . $lar_csActor; ?>">
                                        <span class="fa fa-fw fa-dollar-sign"></span>
                                        <?php echo number_format((float)$lar_csSavings, 2, '.', ','); ?>
                                        <span class="fa fa-fw fa-info-circle" style="color: #0275d8"></span>
                                    </span>
                                </h3>
            				</p>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="card-footer small text-muted">
            	<?php echo 'For the week of ' . $initiativeFooter; ?>
            </div>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<div class="card-header">
				<h5>Cost Savings Breakdown</h5>
			</div>
			<div class="card-group">
				<div class="card">
					<div class="card-header">
						<p class="card-text text-center">By Team</p>
					</div>
					<div class="card-body">
						<canvas id="pieTeam" width="100%" height="120"></canvas>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<p class="card-text text-center">By Environment</p>
					</div>
					<div class="card-body">
						<canvas id="pieEnv" width="100%" height="120"></canvas>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<p class="card-text text-center">By Technology</p>
					</div>
					<div class="card-body">
						<canvas id="pieTech" width="100%" height="120"></canvas>
					</div>
				</div>
				<div class="card">
					<div class="card-header">
						<p class="card-text text-center">By Type</p>
					</div>
					<div class="card-body">
						<canvas id="pieType" width="100%" height="120"></canvas>
					</div>
				</div>
			</div>
            <div class="card-footer small text-muted">
                For the month of <?php echo date('F, Y'); ?>
            </div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
        <!--<div class="card mb-3">
            <div class="card-header">
            	<h5>Monthly Total</h5>
            </div>
            <div class="card-body">
				<canvas id="barChart"></canvas>
            </div>
            <div class="card-footer small text-muted">
                For the year <?php #echo date('Y'); ?>
            </div>
        </div>-->
        <div class="card mb-3">
            <div class="card-header">
            	<h5>Savings Total Per Month ($)</h5>
            </div>
            <div class="card-body">
				<canvas id="lineChart"></canvas>
            </div>
            <div class="card-footer small text-muted">
                For the year <?php echo date('Y'); ?>
            </div>
        </div>
	</div>
	<div class="col-lg-6">
		<div class="card mb-3">
            <div class="card-header">
            	<h5>Latest Initiatives</h5>
            </div>
            <div class="card-body">
            	<div class="table table-responsive">
                    <table class="table-bordered" id="recentsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            	<th class="text-center">Date</th>
                                <th class="text-center">Team</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $list_latest; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>

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
</div>
<script type="text/javascript">
//for the page-level data-table
	$(document).ready(function() {
    	$('#recentsTable').DataTable( {
        	"order": [[ 0, "desc" ]]
    	} );
	} );
</script>
<script type="text/javascript">
// pie chart -- journey teams
var ctxP = document.getElementById("pieTeam").getContext('2d');
var mypieTeam = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: <?php echo $teams_list; ?>
        datasets: [
            {
                data: <?php echo $tsavings_list; ?>
                //blue & purple:
                //backgroundColor: ["#08306b", "#08519c", "#2171b5", "#4292c6", "#6baed6", "#9ecae1", "#c6dbef", "#deebf7", "#3f007d", "#54278f", "#6a51a3", "#807dba", "#9e9ac8", "#bcbddc", "#dadaeb"],
                //multi-color 1
                //backgroundColor: ["#d53e4f", "#f46d43", "#fdae61", "#fee08b", "#ffffbf", "#e6f598", "#abdda4", "#66c2a5", "#3288bd"],
                backgroundColor: ["#2ecc71", "#9b59b6", "#3498db", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
        responsive: true
    }    
});

// pie chart -- environments
var ctxP = document.getElementById("pieEnv").getContext('2d');
var myPieEnv = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: <?php echo $env_list; ?>
        datasets: [
            {
                data: <?php echo $esavings_list; ?>
                backgroundColor: ["#2ecc71", "#9b59b6", "#3498db", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
        responsive: true
    }    
});

// pie chart -- technologies
var ctxP = document.getElementById("pieTech").getContext('2d');
var myPieTech = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: <?php echo $tech_list; ?>
        datasets: [
            {
                data: <?php echo $hsavings_list; ?>
                backgroundColor: ["#2ecc71", "#9b59b6", "#3498db", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
        responsive: true
    }    
});

// pie chart -- types
var ctxP = document.getElementById("pieType").getContext('2d');
var myPieType = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: <?php echo $type_list; ?>
        datasets: [
            {
                data: <?php echo $ysavings_list; ?>
                backgroundColor: ["#2ecc71", "#9b59b6", "#3498db", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
        responsive: true
    }    
});

// bar chart -- for the monthly report div
//var ctxB = document.getElementById("barChart").getContext('2d');
//var myBarChart = new Chart(ctxB, {
//    type: 'bar',
//    data: {
//        //labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
//        labels: <?php echo $months_list; ?>
//        datasets: [{
//            label: 'Savings Total ($)',
//            //data: [120, 190, 300, 150, 200, 152, 355, 543, 142, 323, 123, 433],
//            data: <?php echo $data_bar; ?>
//            backgroundColor: [
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)',
//                'rgba(2, 117, 216, 1)'
//            ],
//        }]
//    },
//    options: {
//        scales: {
//            yAxes: [{
//                ticks: {
//                    beginAtZero:true,
//                }
//            }]
//        }
//    }
//});

// line chart -- data needed **
var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
        //labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        labels: <?php echo $months_list; ?>
        datasets: [
        //    {
        //        label: "01",
        //        backgroundColor: "rgba(46,204,113,0.0)",
        //        borderColor: "rgba(46,204,113,0.8)",            
        //        pointBackgroundColor: "rgba(46,204,113,1)",
        //        pointBorderColor: "rgba(100,100,100,1)",
        //        lineTension: "0.1",
        //        data: [65, 40, 80, 81, 56, 52, 91, 76, 20, 32, 72, 23]
        //    },
        //    {
        //        label: "02",
        //        backgroundColor: "rgba(155,89,182,0.0)",
        //        borderColor: "rgba(155,89,182,0.8)",
        //        pointBackgroundColor: "rgba(155,89,182,1)",
        //        pointBorderColor: "rgba(100,100,100,1)",
        //        lineTension: "0.1",
        //        data: [28, 48, 40, 19, 86, 21, 34, 76, 44, 52, 32, 41]
        //    },
        //    {
        //        label: "03",
        //        backgroundColor: "rgba(2,117,216,0.0)",
        //        borderColor: "rgba(2,117,216,0.8)",
        //        pointBackgroundColor: "rgba(2,117,216,1)",
        //        pointBorderColor: "rgba(100,100,100,1)",
        //        lineTension: "0.1",
        //        data: [43, 65, 21, 44, 31, 76, 82, 51, 64, 64, 32, 43]
        //    }
            {
                label: "Savings Total ($)",
                backgroundColor: "rgba(2,117,216,0.0)",
                borderColor: "rgba(2,117,216,0.8)",
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(100,100,100,1)",
                lineTension: "0.1",
                data: <?php echo $data_bar; ?>
            }
        ]
    },
    options: {
        responsive: true
    }    
});
</script>
<script type="text/javascript">
// popover for initiative summary
    $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
</body>
</html>
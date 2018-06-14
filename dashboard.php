<?php 
	include('controllers/dashboard_controller.php');
?>
<div class="row">
	<div class="col-lg-12">
        <h4 class="display-4"><?php echo $headerDisplay; ?></h4>
		<div class="card-deck">
			<div class="card mb-3">
				<div class="card-body text-center">
					<div class="row">
						<div class="col-lg-12">
							<p>Cost Savings Total <br><small class="text-muted"><?php echo '(for ' . $cstotalDate . ')'; ?></small></p>
							<h3 class="card-title">
								<i class="fa fa-fw fa-dollar-sign fa-sm"></i> 
                                <?php echo $sumSavings; ?>
							</h3>
						</div>
					</div>
					<br />
					<div class="row">
						<div class="col-lg-12">
							<h5><?php echo getDiff($sumLast, $sumSavings); ?>% <?php echo getArrowIcon($sumLast, $sumSavings); ?></h5>
							<small class="text-muted">vs $ <?php echo $sumLast; ?> (prev.)</small>
						</div>
					</div>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-body text-center">
					<p>Largest Entry</p>
					<p class="card-text">
						<h3>
							<i class="fa fa-fw fa-dollar-sign fa-sm"></i>
							<?php echo $lar_csSavings; ?>
						</h3>
					</p>
					<small class="text-muted">
						Action performed by: <br><?php echo $lar_csActor; ?>
                        <br><?php echo $lar_csDate; ?>
					</small>
				</div>
			</div>
			<div class="card mb-3">
				
			</div>
            <div class="card mb-3">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <label for="filterTeam"><small class="text-muted">Filter by Team</small></label>
                            <select class="form-control" name="filterTeam" id="filterTeam">
                                <option value="" <?php if(!isset($_GET['filter'])) {echo "selected='true'";} else { echo ""; } ?>>Show All</option>
                                <?php echo $list_teams; ?>
                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary text-center" name="btnFilter" id="btnFilter">Apply Filter</button>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="card mb-3">
			<div class="card-header">
				Some graph
			</div>
			<div class="card-body">
				<canvas id="barChart" height="90"></canvas>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="card-deck">
			<div class="card mb-3">
				<div class="card-body">
					<h5><?php echo $pieDisplay; ?></h5><br>
					<canvas id="pieTeam" width="100%"></canvas>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-body">
					<h5>Breakdown by Environment</h5><br>
					<canvas id="pieEnv" width="100%"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="card-deck">
			<div class="card mb-3">
				<div class="card-body">
					<h5>Breakdown by Technology</h5><br>
					<canvas id="pieTech" width="100%"></canvas>
				</div>
			</div>
			<div class="card mb-3">
				<div class="card-body">
					<h5>Breakdown by Savings Type</h5><br>
					<canvas id="pieType" width="100%"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
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
                                <th class="text-center">Technology</th>
                                <th class="text-center">Environment</th>
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
    <div class="col-lg-12">
        <div class="card-deck">
            <div class="card mb-3" style="border-color: white;">
                <div class="card-body">
                    <div class="float-right">
                        <div class="addthis_inline_share_toolbox"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
//js for the bar chart
	var ctxL = document.getElementById("barChart").getContext('2d');
	var myBarChart = new Chart(ctxL, {
    type: 'bar',
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [
            {
                label: "Savings Total ($)",
                backgroundColor: "rgba(52, 152, 219,0.8)",
                borderColor: "rgba(52, 152, 219,0.8)",
                pointBackgroundColor: "rgba(52, 152, 219,0)",
                //pointBorderColor: "rgba(100,100,100,1)",
                //lineTension: "0.1",
                //data: [100,102,133,102,105,123,142,109,102,120,111,123]
                data: <?php echo $data_bar; ?>
            }
        ]
    },
    options: {
    	scales: {
    		yAxes: [{
    			ticks: {
    				beginAtZero: true
    			}
    		}]
    	},
        responsive: true
    }    
});

//js for the pie chart (per team data)
var ctxP = document.getElementById("pieTeam").getContext('2d');
var mypieTeam = new Chart(ctxP, {
    type: 'doughnut',
    data: {
        labels: <?php echo $teams_list; ?>
        datasets: [
            {
                data: <?php echo $tsavings_list; ?>
                //blue & purple:
                //backgroundColor: ["#08306b", "#08519c", "#2171b5", "#4292c6", "#6baed6", "#9ecae1", "#c6dbef", "#deebf7", "#3f007d", "#54278f", "#6a51a3", "#807dba", "#9e9ac8", "#bcbddc", "#dadaeb"],
                //multi-color 1
                //backgroundColor: ["#d53e4f", "#f46d43", "#fdae61", "#fee08b", "#ffffbf", "#e6f598", "#abdda4", "#66c2a5", "#3288bd"],
                backgroundColor: ["#3498db", "#2ecc71", "#9b59b6", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
        legend: {
            position: 'right'
        },
        responsive: true
    }    
});

//js for the pie chart (per environment data)
var ctxP = document.getElementById("pieEnv").getContext('2d');
var myPieEnv = new Chart(ctxP, {
    type: 'doughnut',
    data: {
        labels: <?php echo $env_list; ?>
        datasets: [
            {
                data: <?php echo $esavings_list; ?>
                backgroundColor: ["#3498db", "#2ecc71", "#9b59b6", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
    	legend: {
            position: 'right'
        },
        responsive: true
    }    
});

// pie chart -- technologies
var ctxP = document.getElementById("pieTech").getContext('2d');
var myPieTech = new Chart(ctxP, {
    type: 'doughnut',
    data: {
        labels: <?php echo $tech_list; ?>
        datasets: [
            {
                data: <?php echo $hsavings_list; ?>
                backgroundColor: ["#3498db", "#2ecc71", "#9b59b6", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
    	legend: {
            position: 'right'
        },
        responsive: true
    }    
});

// pie chart -- types
var ctxP = document.getElementById("pieType").getContext('2d');
var myPieType = new Chart(ctxP, {
    type: 'doughnut',
    data: {
        labels: <?php echo $type_list; ?>
        datasets: [
            {
                data: <?php echo $ysavings_list; ?>
                backgroundColor: ["#3498db", "#2ecc71", "#9b59b6", "#e67e22", "#1abc9c", "#e74c3c", "#f39c12", "#8e44ad", "#2c3e50", "#2980b9", "#7f8c8d", "#27ae60", "#34495e", "#c0392b", "#d35400"],
                hoverBackgroundColor: []
            }
        ]
    },
    options: {
    	legend: {
            position: 'right'
        },
        responsive: true
    }    
});
</script>
<script type="text/javascript">
//for the data table (10 most recent entries)
	$(document).ready(function() {
    	$('#recentsTable').DataTable( {
        	"order": [[ 0, "desc" ]],
            "paging": false
    	} );
	} );
</script>
<script type="text/javascript">
// popover for initiative summary
    $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
<?php
	include 'controllers/account_controller.php';
?>
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true">My Account</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="recents-tab" data-toggle="tab" href="#recents" role="tab" aria-controls="recents" aria-selected="false">Cost Savings Entries</a>
  </li>
</ul>
<br />
<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="account" role="tabpanel" aria-labelledby="account-tab">
		<div class="card mb-3">
			<div class="card-header">
				Account Details
			</div>
			<div class="card-body">
				<form class="forn-horizontal" method="POST">
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
								<label for="inpTeam">Journey Team</label>
								<select class="form-control" name="inpTeam" id="inpTeam">
									<option selected="true" disabled="true">Choose one...</option>
									<option value="0" <?php echo $def_teamID == 0 ? "selected = 'true'" : ""; ?>>None</option>
									<?php echo listTeams($con, $def_teamID); ?>
								</select>
							</div>
						</div>
						<div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpEnv">Environment</label>
                                <select class="form-control" name="inpEnv" id="inpEnv">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <option value="0" <?php echo $def_envID == 0 ? "selected = 'true'" : ""; ?>>None</option>
                                    <?php echo listEnvironments($con, $def_envID); ?>
                                </select>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
		            		    <label for="inpTech">Cloud/DevOps Technology</label>
		            		    <select class="form-control" name="inpTech" id="inpTech">
		            		        <option selected="true" disabled="true">Choose one...</option>
		            		        <option value="0" <?php echo $def_techID == 0 ? "selected = 'true'" : ""; ?>>None</option>
		            		        <?php echo listTech($con, $def_techID); ?>
		            		    </select>
		            		</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<small class="form-text text-muted align-bottom">The saved data will be used as the default values in the add form.</small>
						</div>
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary float-right" id="btnSave" name="btnSave">Save Changes</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php echo $msgDisplay; ?>
	</div>
	<div class="tab-pane" id="recents" role="tabpanel" aria-labelledby="recents-tab">
		<div class="table table-responsive table-hover">
			<table class="table-bordered" id="recentsTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th class="text-center">Date</th>
	                       <th class="text-center">Journey Team</th>
	                       <th class="text-center">Cloud/DevOps Technology</th>
	                       <th class="text-center">Environment</th>
	                       <th class="text-center">Type</th>
	                       <th class="text-center">Inital Cost</th>
	                       <th class="text-center">Solution/s Implemented</th>
	                       <th class="text-center">Final Cost</th>
	                       <th class="text-center">Total Savings</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $list_records; ?>
				</tbody>
				<tfoot>
					<tr>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>




<script type="text/javascript">
$(document).ready(function() {
    $('#recentsTable').DataTable( {
        "order": [[ 0, "desc" ]],
        pageResize: true,
        scrollY:        '55vh',
        scrollX:        '100%',
        scrollCollapse: true,
        paging:         false,
        initComplete: function () {
            this.api().columns([1,2,3,4]).every( function () {
                var column = this;
                var title = $(this).text();
                var select = $('<select class="form-control"><option value="">Show All</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

$(document).ready(function () {             
    $('.dataTables_filter input[type="search"]').
    attr('placeholder','Enter a keyword...').
    css({'width':'300px','display':'inline-block'});
});
</script>

<?php include 'controllers/includes/footer.php'; ?>
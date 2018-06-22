<?php
	include 'controllers/add_jt_controller.php';
?>
<div class="row">
	<div class="col-md-12">
		<?php echo $msgDisplay; ?>
		<div class="card mb-3">
			<div class="card-header">
				<h5>Journey Teams
					<button class="btn btn-primary float-right" data-toggle="modal" data-target="#addTeamModal">
						<span>Add a Journey Team</span>
					</button>
				</h5>
			</div>
			<div class="card-body">
				<div class="table table-responsive">
					<table class="table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Team Name</th>
							</tr>
						</thead>
						<tbody>
							<?php echo $list_teams; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal for creating a new team -->
<div class="modal fade" id="addTeamModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title" id="addModalLabel">New Journey Team</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <form class="form-horizontal" method="POST">
              	<div class="modal-body">
                	<div class="form-group">
                		<label for="inpName">Journey Team Name</label>
                		<input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" required="true">
                	</div>
            	</div>
            	<div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                	<button class="btn btn-primary" name="btnAdd" id="btnAdd">Add</button>
            	</div>
            </form>
        </div>
    </div>
</div>
<?php include 'controllers/includes/footer.php'; ?>
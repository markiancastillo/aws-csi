<?php include 'controllers/add_proj_controller.php'; ?>
<div class="row">
	<div class="col-md-12">
		<?php echo $msgDisplay; ?>
		<div class="card mb-3">
			<div class="card-header">
				<h5>Projects
					<button class="btn btn-primary float-right" data-toggle="modal" data-target="#addProjModal">
						<span>Add a Project</span>
					</button>
				</h5>
			</div>
			<div class="card-body">
				<div class="table table-responsive table-hover">
					<table class="table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Project Name</th>
								<th>Description</th>
								<th>Action/s</th>
							</tr>
						</thead>
						<tbody>
							<?php echo $list_proj; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal for creating a new team -->
<div class="modal fade" id="addProjModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title" id="addModalLabel">New Project</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <form class="form-horizontal" method="POST">
              	<div class="modal-body">
                	<div class="form-group">
                		<label for="inpName">Project Name</label>
                		<input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" required="true">
                	</div>
                	<div class="form-group">
                		<label for="inpDesc">Project Description</label>
                		<textarea class="form-control" rows="5" name="inpDesc" id="inpDesc" maxlength="250" placeholder="Short description of the project..." required="true"></textarea>
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
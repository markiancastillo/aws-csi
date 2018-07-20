<?php include 'controllers/user_controller.php'; ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<div class="card-header">
				<h5>Edit Access</h5>
			</div>
			<div class="card-body">
				<h1 class="display-4">John Doe</h1>
				<div class="row">
					<div class="col-sm-12 col-lg-4">
						<div class="form-group">
							<label for="dispTeam">Journey Team</label>
							<input type="text" id="dispTeam" name="dispTeam" class="form-control" value="" readonly="true">
						</div>
					</div>
					<div class="col-sm-12 col-lg-4">
						<div class="form-group">
							<label for="dispEnv">Environment</label>
							<input type="text" id="dispEnv" name="dispEnv" class="form-control" value="" readonly="true">
						</div>
					</div>
					<div class="col-sm-12 col-lg-4">
						<div class="form-group">
							<label for="dispTech">Cloud/Dev Ops Technology</label>
							<input type="text" id="dispTech" name="dispTech" class="form-control" value="" readonly="true">
						</div>
					</div>
				</div>
				<hr />
				<br />
				<div class="row">
					<div class="col-lg-12">
						<div class="card-deck">
							<div class="card">
								<div class="card-body">
									<form method="POST">
										<div class="form-group">
											<label for="inpAccess">Access Level</label>
											<select class="form-control" id="inpAccess" name="inpAccess">
												<option value="">Value</option>
											</select>
										</div>
										<div class="form-group">
											<button class="btn btn-primary float-right" id="btnSave" name="btnSave">Save Changes</button>
										</div>
									</form>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="form-group">
										<label for="inpStatus">Account Status</label>
										<input type="text" id="dispStatus" name="dispStatus" class="form-control" value="" readonly="true">
									</div>
									<div class="form-group">
										<button class="btn btn-danger float-right" data-toggle="modal" data-target="#archiveModal" id="btnModal" name="btnModal">Archive Account</button>
									</div>
								</div>
							</div>
						</div>						
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal for the archive confirmation prompt -->
<div class="modal fade" id="archiveModal" tabindex="-1" role="dialog" aria-labelledby="archiveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveModalLabel">Confirm Action</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST">
                <div class="modal-body">
                    <div class="row">
                    	<div class="col-sm-12 col-md-10 offset-md-1">
                    		<p class="text-center">
                    			Archiving an account will disable its access to the system until reactivated. 
                    			<br /><br />
                    			Please enter your password to confirm:
                    		</p>
                    		<input type="password" class="form-control" id="inpConfirm" name="inpConfirm" />
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" name="btnArchive" id="btnArchive">Archive Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
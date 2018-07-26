<?php
	include 'controllers/user_controller.php'; 

	# HTML content for the popover
	$content = "
		<dl>
			<dt>Administrator</dt>
			<dd>Access to all pages.</dd>
			<dt>User (Elevated)</dt>
			<dd>User access + <i class='fa fa-folder-open'></i> Manage Data page/s.</dd>
			<dt>User</dt>
			<dd>Access to <i class='fa fa-chart-pie'></i> Dashboard and <i class='fa fa-piggy-bank'></i> Cost Savings Initiatives only.</dd>
		</dl>
	";
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card mb-3">
			<div class="card-header">
				<h5>Edit Access</h5>
			</div>
			<div class="card-body">
				<h1 class="display-4"><?php echo $userName; ?></h1>
				<?php echo $msgDisplay; ?>
<!--				<div class="row">
					<div class="col-sm-12 col-lg-4">
						<div class="form-group">
							<label for="dispTeam">Journey Team</label>
							<input type="text" id="dispTeam" name="dispTeam" class="form-control" value="<?php echo $teamName; ?>" readonly="true">
						</div>
					</div>
					<div class="col-sm-12 col-lg-4">
						<div class="form-group">
							<label for="dispEnv">Environment</label>
							<input type="text" id="dispEnv" name="dispEnv" class="form-control" value="<?php echo $envName; ?>" readonly="true">
						</div>
					</div>
					<div class="col-sm-12 col-lg-4">
						<div class="form-group">
							<label for="dispTech">Cloud/Dev Ops Technology</label>
							<input type="text" id="dispTech" name="dispTech" class="form-control" value="<?php echo $techName; ?>" readonly="true">
						</div>
					</div>
				</div>
				<hr />-->
				<br />
				<div class="row">
					<div class="col-lg-12">
						<div class="card-deck">
							<div class="card">
								<div class="card-body">
									<form method="POST">
										<div class="form-group">
											<label for="inpAccess">
												Access Level 
												<span rel="popover" data-placement="right" data-trigger="hover" data-toggle="popover" data-html="true" data-content="<?php echo $content; ?>"><i class="far fa-question-circle fa-fw" style="color: #007bff;"></i></span>
											</label>
											<select class="form-control" id="inpAccess" name="inpAccess">
												<?php echo listAccess($con, $def_access); ?>
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
										<input type="text" id="dispStatus" name="dispStatus" class="form-control" value="<?php echo listStatus($con, $def_status); ?>" readonly="true">
									</div>
									<div class="form-group">
										<?php echo $displayButton; ?>
									</div>
								</div>
							</div>
						</div>						
					</div>					
				</div>
			</div>
			<div class="card-footer">
				<a href="manage.php" class="btn btn-secondary"><i class="fa fa-angle-left fa-fw"></i> Back to List</a>
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
                    		<input type="password" class="form-control text-center" id="inpConfirm" name="inpConfirm" />
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
<!-- Modal for the confirmation of account activation prompt -->
<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activateModalLabel">Confirm Action</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST">
                <div class="modal-body">
                    <div class="row">
                    	<div class="col-sm-12 col-md-10 offset-md-1">
                    		<p class="text-center">
                    			You are about to activate/re-activate an account. 
                    			<br />
                    			This will enable it to have access to the system and its features.
                    			<br /><br />
                    			Please enter your password to confirm:
                    		</p>
                    		<input type="password" class="form-control text-center" id="inpConfirm" name="inpConfirm" />
                    	</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" name="btnActivate" id="btnActivate">Activate Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'controllers/includes/footer.php'; ?>
<script type="text/javascript">
	// Initialization of popover
	// Ref: https://stackoverflow.com/questions/30051283/
	$(function () {
    	$('[data-toggle="popover"]').popover()
	});
</script>
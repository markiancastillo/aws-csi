<?php
	include 'controllers/edit_proj_controller.php';
?>
<div class="row">
	<div class="col-md-12">
		<?php echo $msgDisplay; ?>
		<div class="card mb-3">
			<div class="card-header">
				Edit Project Details
			</div>
			<form class="form-horizontal" method="POST">
				<div class="card-body">
					<div class="form-group">
            	    	<label for="inpName">Project Name</label>
            	    	<input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" value="<?php echo $projectName; ?>" required="true">
            	    </div>
            	    <div class="form-group">
                		<label for="inpDesc">Project Description</label>
                		<textarea class="form-control" rows="5" name="inpDesc" id="inpDesc" maxlength="250" placeholder="Short description of the project..." required="true"><?php echo $projectDescription; ?></textarea>
                	</div>	
				</div>
				<div class="card-footer">
					<button class="btn btn-primary float-right" id="btnSave" name="btnSave">Save Changes</button>
					<a href="add_env.php" class="btn btn-secondary"><i class="fa fa-angle-left fa-fw"></i> Back to List</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include 'controllers/includes/footer.php'; ?>
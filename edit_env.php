<?php
	include 'controllers/edit_env_controller.php';
?>
<div class="row">
	<div class="col-md-12">
		<?php echo $msgDisplay; ?>
		<div class="card mb-3">
			<div class="card-header">
				Edit Environment Name
			</div>
			<form class="form-horizontal" method="POST">
				<div class="card-body">
					<div class="form-group">
            	    	<label for="inpName">Environment Name</label>
            	    	<input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" value="<?php echo $envName; ?>" required="true">
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
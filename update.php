<?php
	include 'controllers/update_controller.php';
?>
<div class="row">
	<div class="col-md-6">
		<div class="card mb-3">
			<div class="card-header">
				<h5>Update Table Data</h5>
			</div>
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="card-body">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 350px; height: 250px; border: 1px solid lightgrey; border-radius: .25rem;"><p>Upload Final Screenshot</p></div>
		  				<div>
			    			<span class="btn btn-secondary btn-file">
			    				<span class="fileinput-new">Select image</span>
			    				<span class="fileinput-exists">Change</span>
			    				<input type="file" class="form-control" name="inpPhoto" id="inpPhoto" accept="image/*" required="true">
			    			</span>
			    			<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			  			</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="form-group">
						<button class="btn btn-primary float-right" name="btnSubmit" id="btnSubmit">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
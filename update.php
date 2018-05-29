<?php
	include 'controllers/update_controller.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">
				<a href="view.php" class="btn btn-primary">
					<span><i class="fa fa-fw fa-angle-left"></i></span>
				</a>
				 Update Row Data
			</div>
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
                                <label for="inpTeam">Journey Team</label>
                                <select class="form-control" name="inpTeam" id="inpTeam" required="true" disabled="true">
                                    <?php echo $list_teams; ?>
                                </select>
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="form-group">
                                <label for="inpTech">Cloud/DevOps Technology</label>
                                <select class="form-control" name="inpTech" id="inpTech" required="true" disabled="true">
                                    <?php echo $list_tech; ?>
                                </select>
                            </div>
						</div>
						<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpEnv">Environment</label>
                                <select class="form-control" name="inpEnv" id="inpEnv" required="true" disabled="true">
        							<?php echo $list_env; ?>
                                </select>
                            </div>
                        </div>
					</div>
					<div class="row">
                    	<div class="col-sm-12 col-md-6">
                            <label for="inpInitial"></label>
                            <img src="images/<?php echo $csInitial; ?>" style="max-width: 100%; height: 320px; border: 1px solid lightgrey; border-radius: .25rem;">
                    	</div>
                    	<div class="col-sm-12 col-md-6">
                    		<label for="inpFinal"></label>
                    		<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 300px; border: 1px solid lightgrey; border-radius: .25rem;">
									<img src="images/placeholder.jpg" alt="img" />
								</div>
		  						<div>
			    					<span class="btn btn-secondary btn-file">
			    						<span class="fileinput-new">Select image</span>
			    						<span class="fileinput-exists">Change</span>
			    						<input type="file" class="form-control" name="inpFinal" id="inpFinal" accept="image/*" required="true">
			    					</span>
			    					<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			  					</div>
							</div>
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-12">
                    		<div class="form-group">
                    		    <label for="inpDesc">Description</label>
                    		    <textarea class="form-control" rows="5" name="inpDesc" id="inpDesc" maxlength="500" placeholder="Brief description of the task/action performed..." required="true" disabled="true"><?php echo $csDesc; ?></textarea>
                    		</div>
                    	</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpName">Action Executed By</label>
                                <input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" placeholder="Enter a name..." value="<?php $csActor; ?>" required="true" disabled="true">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDate">Date Executed</label>
                                <input class="form-control" type="date" name="inpDate" id="inpDate" min="2018-01-01" max="<?php echo date('Y-m-d'); ?>" required="true" value="<?php echo $csDate; ?>" disabled="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpType">Cost Savings Type</label>
                                <select class="form-control" name="inpType" id="inpType" required="true" disabled="true">
                                    <?php echo $list_type; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpSave">Estimated Monthly Savings</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpSave" id="inpSave" value="<?php echo $csSavings; ?>" required="true" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
				<div class="card-footer">
					<button type="button" class="btn btn-primary float-right" name="btnSubmit" id="btnSubmit">Update Record</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
      $(function() {
    $('#inpSave').maskMoney({allowZero: true});
  })
</script>
<?php include 'controllers/includes/footer.php'; ?>
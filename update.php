<?php
	include 'controllers/update_controller.php';
?>
<div class="row">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">
				
				 Row Details
			</div>
			<form class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
                                <label for="inpTeam">Journey Team</label>
                                <select class="form-control" name="inpTeam" id="inpTeam" required="true" disabled="true">
                                    <?php echo $list_teams; ?>
                                </select>
                            </div>
						</div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpEnv">Environment</label>
                                <select class="form-control" name="inpEnv" id="inpEnv" required="true" disabled="true">
                                    <?php echo $list_env; ?>
                                </select>
                            </div>
                        </div>
						<div class="col-sm-12 col-md-4">
							<div class="form-group">
                                <label for="inpTech">Cloud/DevOps Technology</label>
                                <select class="form-control" name="inpTech" id="inpTech" required="true" disabled="true">
                                    <?php echo $list_tech; ?>
                                </select>
                            </div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="inpType">Cost Savings Type</label>
                                <select class="form-control" name="inpType" id="inpType" required="true" disabled="true">
                                    <?php echo $list_type; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpInitial">Initial Cost</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpInitial" id="inpInitial" value="<?php echo $csInitial; ?>" required="true" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpFinal">Final Cost</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpFinal" id="inpFinal" value="<?php echo $csFinal; ?>" required="true" disabled="true" />
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                    	<div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpCause">Root Cause</label>
                                <textarea class="form-control" rows="10" name="inpCause" id="inpCause" maxlength="800" placeholder="Details of the problem encountered..." required="true" disabled="true"><?php echo $csCause; ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpSteps">Solution/s Implemented</label>
                                <textarea class="form-control" rows="10" name="inpSteps" id="inpSteps" maxlength="800" placeholder="Steps taken in order to resolve the issue/s encountered..." required="true" disabled="true"><?php echo $csSteps; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpName">Action Executed By</label>
                                <input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" placeholder="Enter a name..." value="Mark Castillo*" required="true" disabled="true">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDate">Completion Date</label>
                                <input class="form-control" type="test" name="inpDate" id="inpDate" min="2018-01-01" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $displayDate->format('Y-m-d'); ?>" required="true" disabled="true">
                            </div>
                        </div>
                    </div>
            	</div>
				<div class="card-footer">
                    <a href="view.php" class="btn btn-primary">
                    <span><i class="fa fa-fw fa-angle-left"></i></span>
                </a>
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
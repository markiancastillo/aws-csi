<?php
	include 'controllers/details_controller.php';
?>
<script type="text/javascript" src="js/html2canvas.min.js"></script>
<div class="row" id="formDiv">
	<div class="col-lg-12">
		<?php echo $msgDisplay; ?>
		<h4 class="display-4">Details</h4>
		<form class="form-horizontal" method="POST">
			<div class="row">
				<div class="col-lg-6"">
					<div class="col-lg-12">
						<div class="form-group row">
							<label for="displayTeam" class="col-lg-4 col-form-label">Team</label>
							<div class="col-lg-8">
								<input type="text" readonly class="form-control" id="displayTeam" name="displayTeam" value="<?php echo $teamName; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="displayEnv" class="col-lg-4 col-form-label">Environment</label>
							<div class="col-lg-8">
								<input type="text" readonly class="form-control" id="displayEnv" name="displayEnv" value="<?php echo $envName; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="displayTech" class="col-lg-4 col-form-label">AWS/DevOps Technology</label>
							<div class="col-lg-8">
								<input type="text" readonly class="form-control" id="displayTech" name="displayTech" value="<?php echo $techName; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="displayType" class="col-lg-4 col-form-label">Cost Savings Type</label>
							<div class="col-lg-8">
								<input type="text" readonly class="form-control" id="displayType" name="displayType" value="<?php echo $typeName; ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6"">
					<div class="col-lg-12">
						<div class="form-group row">
							<label for="displayDate" class="col-lg-4 col-form-label">Completion Date</label>
							<div class="col-lg-8">
								<input type="text" readonly class="form-control" id="displayDate" name="displayDate" value="<?php echo $displayDate; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group row">
							<label for="displayActor" class="col-lg-4 col-form-label">Executed By</label>
							<div class="col-lg-8">
								<input type="text" readonly class="form-control" id="displayActor" name="displayActor" value="<?php echo $userName; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>	
			<hr />
			<div class="row">
				<div class="col-lg-6">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="displayCause" class="col-form-label">Root Cause/Problem to Solve</label>
							<div>
								<textarea <?php echo $readonly; ?> class="form-control" rows="10" id="inpCause" name="inpCause" style="resize: none;" required="true"><?php echo $csCause; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group row">
							<label for="displayInitial" class="col-lg-4 col-form-label">Initial Cost</label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input type="text" <?php echo $readonly; ?> class="form-control" id="inpInitial" name="inpInitial" value="<?php echo $csInitial; ?>" required="true">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="col-lg-12">
						<div class="form-group">
							<label for="displaySteps" class="col-form-label">Solution/s Implemented</label>
							<div>
								<textarea <?php echo $readonly; ?> class="form-control" rows="10" id="inpSteps" name="inpSteps" style="resize: none;" required="true"><?php echo $csSteps; ?></textarea>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group row">
							<label for="displayFinal" class="col-lg-4 col-form-label">Final Cost</label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input type="text" <?php echo $readonly; ?> class="form-control" id="inpFinal" name="inpFinal" value="<?php echo $csFinal; ?>" required="true">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 offset-lg-6">
					<div class="col-lg-12">
						<div class="form-group row">
							<label for="displaySavings" class="col-lg-4 col-form-label">Total Savings</label>
							<div class="col-lg-8">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input type="text" readonly class="form-control" id="displaySavings" name="displaySavings" value="<?php echo $csSavings; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" id="formButtons">
				<div class="col-lg-6">
					<div class="form-group">
						<a href="view.php" class="btn btn-secondary" name="btnBack"><i class="fa fa-fw fa-angle-left"></i>Back to List</a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="col-lg-12" <?php echo $showButton; ?>>
						<div class="row">
							<div class="col-lg-12">
								<button class="btn btn-primary float-right" id="btnUpdate" name="btnUpdate">Save Changes</button>
							</div>
						</div>
					</div>
					<br <?php echo $showButton; ?>>
					<div class="col-lg-12">
						<div class="row">
							<!--<label for="buttonGroup" class="col-lg-4 col-form-label">Share</label>-->					
							<div class="col-lg-7">
								<div class="addthis_inline_share_toolbox"></div>
							</div>
							<div class="col-lg-5">
								<a href="<?php echo $_SERVER['REQUEST_URI'] . '&viewonly=1'; ?>" class="btn btn-outline-dark float-right" target="_blank"><i class="fa fa-fw fa-camera fa-lg"></i> Take a Screenshot</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
// Input masking for the money input
$(function() {
    $('#inpInitial').maskMoney({allowZero: true});
});

$(function() {
    $('#inpFinal').maskMoney({allowZero: true});
})
</script>
<?php include 'controllers/includes/footer.php'; ?>
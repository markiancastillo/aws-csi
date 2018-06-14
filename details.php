<?php
	include 'controllers/details_controller.php';
?>
<div class="row">
	<div class="col-lg-12">
		<h4 class="display-4">Details</h4>
		<div class="row">
			<div class="col-lg-6"">
				<div class="col-lg-12">
					<div class="form-group row">
						<label for="displayTeam" class="col-lg-4 col-form-label">Team</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayTeam" name="displayTeam" value="Team Testing">
						</div>
					</div>
					<div class="form-group row">
						<label for="displayEnv" class="col-lg-4 col-form-label">Environment</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayEnv" name="displayEnv" value="Production">
						</div>
					</div>
					<div class="form-group row">
						<label for="displayTech" class="col-lg-4 col-form-label">AWS/DevOps Technology</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayTech" name="displayTech" value="Amazon Web Services">
						</div>
					</div>
					<div class="form-group row">
						<label for="displayType" class="col-lg-4 col-form-label">Cost Savings Type</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayType" name="displayType" value="Reconfiguration">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6"">
				<div class="col-lg-12">
					<div class="form-group row">
						<label for="displayDate" class="col-lg-4 col-form-label">Completion Date</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayDate" name="displayDate" value="06/14/2018">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group row">
						<label for="displayActor" class="col-lg-4 col-form-label">Executed By</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayActor" name="displayActor" value="Antonio Akyatpanaog">
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
							<textarea readonly class="form-control" rows="10" id="displayCause" name="displayCause" style="resize: none;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ullamcorper in mauris et gravida. Etiam fermentum tellus eu placerat pharetra. In aliquam ut neque eget molestie. Aliquam vitae viverra felis. Aenean mollis turpis at erat venenatis, a mollis magna aliquet. Aenean facilisis odio ac neque aliquet tempor.</textarea>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group row">
						<label for="displayInitial" class="col-lg-4 col-form-label">Initial Cost</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayInitial" name="displayInitial" value="$ 2,200.00">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="col-lg-12">
					<div class="form-group">
						<label for="displaySteps" class="col-form-label">Solution/s Implemented</label>
						<div>
							<textarea readonly class="form-control" rows="10" id="displaySteps" name="displaySteps" style="resize: none;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ullamcorper in mauris et gravida. Etiam fermentum tellus eu placerat pharetra. In aliquam ut neque eget molestie. Aliquam vitae viverra felis. Aenean mollis turpis at erat venenatis, a mollis magna aliquet. Aenean facilisis odio ac neque aliquet tempor.</textarea>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group row">
						<label for="displayFinal" class="col-lg-4 col-form-label">Final Cost</label>
						<div class="col-lg-8">
							<input type="text" readonly class="form-control" id="displayFinal" name="displayFinal" value="$ 1,200.00">
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
							<input type="text" readonly class="form-control" id="displaySavings" name="displaySavings" value="$ 1,000.00">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<a href="view.php" class="btn btn-secondary" name="btnBack"><i class="fa fa-fw fa-angle-left"></i>Back to List</a>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="col-lg-12">
					<div class="form-group row">
						<label for="buttonGroup" class="col-lg-4 col-form-label">Share</label>
						<div class="col-lg-8">							
							<div class="addthis_inline_share_toolbox"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
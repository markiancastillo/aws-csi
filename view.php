<?php
    include 'controllers/view_controller.php';
?>
<div class="row">
    <div class="col-md-12">
        <?php echo $msgDisplay; ?>
        <div class="card mb-3">
            <div class="card-header">
                <h4>Cost Savings Initiatives
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addCSModal">
                    Add a New Record
                </button>
            </h4>
            </div>
            <div class="card-body">
                <div class="table table-responsive table-hover">
                    <table class="table-bordered display pageResize" id="savingsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Journey Team</th>
                                <th class="text-center">Cloud/DevOps Technology</th>
                                <th class="text-center">Environment</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Executed By</th>
                                <th class="text-center">Inital Cost</th>
                                <th class="text-center">Solution/s Implemented</th>
                                <th class="text-center">Final Cost</th>
                                <th class="text-center">Total Savings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $cs_list; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Journey Team</th>
                                <th class="text-center">Cloud/DevOps Technology</th>
                                <th class="text-center">Environment</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Executed By</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal for creating a new record -->
<div class="modal fade" id="addCSModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	        <div class="modal-header">
	            <h5 class="modal-title" id="addModalLabel">New Cost Savings Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
              	<div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpTeam">Journey Team</label>
                                <select class="form-control" name="inpTeam" id="inpTeam" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTeams($con, $def_teamID); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpEnv">Environment</label>
                                <select class="form-control" name="inpEnv" id="inpEnv" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listEnvironments($con, $def_envID); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="inpTech">Cloud/DevOps Technology</label>
                                <select class="form-control" name="inpTech" id="inpTech" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTech($con, $def_techID); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpType">Cost Savings Type</label>
                                <select class="form-control" name="inpType" id="inpType" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listTypes($con); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpProj">Project Group</label>
                                <select class="form-control" name="inpProj" id="inpProj" required="true">
                                    <option selected="true" disabled="true">Choose one...</option>
                                    <?php echo listProjects($con); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpInitial">Inital Cost</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input class="form-control" type="text" name="inpInitial" id="inpInitial" required="true"  />
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
                                    <input class="form-control" type="text" name="inpFinal" id="inpFinal" required="true" onkeyup="getTotal()" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpCause">Root Cause</label>
                                <textarea class="form-control" rows="10" name="inpCause" id="inpCause" maxlength="800" placeholder="Details of the problem encountered..." required="true"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpSteps">Solution/s Implemented</label>
                                <textarea class="form-control" rows="10" name="inpSteps" id="inpSteps" maxlength="800" placeholder="Steps taken in order to resolve the issue/s encountered..." required="true"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6" style="display: none">
                            <div class="form-group">
                                <label for="inpName">Action Executed By</label>
                                <input class="form-control" type="text" name="inpName" id="inpName" maxlength="50" placeholder="Enter a name..." value="John Doe" required="true">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDate">Completion Date</label>
                                <input class="form-control" type="date" name="inpDate" id="inpDate" min="2018-01-01" max="<?php echo $dateToday->format('Y-m-d'); ?>" required="true">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="inpDate">Total Savings</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="sampledisp" name="sampledisp" readonly="true" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
            	<div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                	<button type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd">Add Record</button>
            	</div>
            </form>
        </div>
    </div>
</div>
<!-- Update: as of 06/01/2018, image input is replaced with cost input
Modal for the image zoom on click 
<div class="modal" tabindex="-1" role="dialog" id="imgModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="images/<?#php echo $displayInitial; ?>" width="100%" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->

<?php #echo $imgModal; ?>

<!-- Some custom js for the input masking, default input values, etc. -->
<script type="text/javascript" src="js/custom.js"></script>

<?php include 'controllers/includes/footer.php'; ?>